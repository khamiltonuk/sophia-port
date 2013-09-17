<?php
/*
# Copyright Stanisław Skonieczny 2010
#
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
# 
# The above copyright notice and this permission notice shall be included in
# all copies or substantial portions of the Software.
# 
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
# THE SOFTWARE.

# This file was written for PHP 5.2.12
*/

// provides functionality of the captcha service
class CaptchaService {

    // this characters are used to generate long hash value
    private static $characters = 'qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDGHJKLZXCVBNM';

    public function CaptchaService($siteID, $privateKey, $proxyServer=null, $proxyPort=null) {
	$this->siteID = $siteID;
	$this->privateKey = $privateKey;
	$this->proxyServer = $proxyServer;
	$this->proxyPort = $proxyPort;
	$this->tid = '';
    }

    private function download($url, &$result) {
        $host = 'www.securecaptcha.net';
	$port = 80;
        $nl = "\r\n";
	$result = array();

	if ($this->proxyServer != null) {
	    $url = 'http://' . $host . $url;
	    $host = $this->proxyServer;
	    $port = $this->proxyPort;
	}

	$socket = fsockopen($host, $port);
	if (!$socket) {
	    $result['error'] = 'No connection. ';
	    return null;
	}
	fwrite($socket, "GET $url HTTP/1.0" . $nl . "Host: www.securecaptcha.net" . $nl . "Connection: close" . $nl . $nl);
	$response = stream_get_contents($socket);
	fclose($socket);

	$pos = strpos($response, $nl . $nl);
	if($pos === false) {
	    $result['error'] = 'Wrong response. ';
	    return null;
	}
	$status = substr($response, 9, 13);
	$result['response_code'] = $status;
        $headers = substr($response, 0, $pos);
	$body = substr($response, $pos + 2 * strlen($nl)); 
	return $body;
    }

    // returns true if succeded
    // $ret is (hash, mac, timestamp, htmlFragment) or errorCode
    public function getCaptcha(&$ret) {

	$hash = '';
	for ($i = 0; $i < 24; $i++) {
	    $hash .= CaptchaService::$characters[rand(0, strlen(CaptchaService::$characters) - 1)];
	}

	$questionURL = '/captcha/generateResponse?auth=' . urlencode($this->siteID) . '&hash=' . urlencode($hash);
	if ($this->tid != '') {
		$questionURL = $questionURL . '&tid=' . urlencode($this->tid);
	}
	$responseText = $this->download($questionURL, $result);
	if ($responseText == null) {
            $ret = 'Error. No connection. ';
            return False;
	}
	if ($result['response_code'] != 200) {
	    $ret = 'Error. Response status = ' . $result['response_code'];
	    return False;
        }

	$lst = explode("\n", $responseText, 3);
	$mac = $lst[0];
	$timestamp = $lst[1];
	$fragment = $lst[2];
	$ret = array('hash' => $hash, 'mac' => $mac, 'timestamp' => $timestamp, 'fragment' => $fragment);
        return True;
    }

    // returns True if captcha answer is valid
    public function validateOffline($hash, $mac, $timestamp, $answer) {
	$value = $hash . $answer . $timestamp;
	$digest = hash_hmac('md5', $value, $this->privateKey);
	return $mac == $digest;
    }

    // returns true if answer validated and valid
    // error is set to null on no errors, or to error value
    public function validateOnline($hash, $timestamp, $answer, &$error) {
	$error = null;
        $onlineValidationURL = '/captcha/validate?auth=' . urlencode($this->siteID) . '&hash=' . urlencode($hash) . '&timestamp=' . urlencode($timestamp) . '&code=' . urlencode($answer);
        $responseText = $this->download($onlineValidationURL, $result);
        if ($responseText == null) {
            $error = 'No connection. ';
            return False;
        }
        if ($result['response_code'] != 200) {
            $error = 'Wrong response code: ' . $result['response_code'];
            return False;
	}
	$lines = explode("\n", $responseText);
	$line = $lines[0];
	return $line == '1';
    }

}
?>

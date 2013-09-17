<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

get_header(); ?>

		<div id="main" role="main">

			<article id="post-0" class="post error404 not-found">

				<div class="entry-content">
				
					<blockquote>
<pre>
Midway upon the journey of our life
 I found myself within a forest dark,
 For the straightforward pathway had been lost. 
</pre>
	
	<cite>Dante Alighieri, The Divine Comedy - Inferno, Canto I </cite>
	
	</blockquote>
	
	<hr />
	
	<h1 class="entry-title"><?php _e( 'Page not found', 'runo' ); ?></h1>
				
				
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'runo' ); ?></p>


					<?php get_search_form(); ?>


				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #main -->

<?php get_footer(); ?>
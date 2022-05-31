<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>


			<div id="content" role="main">


	<?php if ( have_posts() ) : ?>

	<h1><?php printf( __( 'Search Results for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div class="single-result">	<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		<p><?php the_excerpt(); ?></p>
	    </div><?php endwhile; ?>

<?php else : ?>

	<h1><?php _e( 'OOPS, Nothing Found', 'twentyten' ); ?></h1>
	<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>

<?php endif; ?>
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>

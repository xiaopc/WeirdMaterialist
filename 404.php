<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Materialist
 */

get_header(); ?>

	
<div class="card  yellow lighten-3">
 <div class="card-content">
   <span class="card-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'materialist' ); ?></span>
    	<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below?', 'materialist' ); ?></p>
 </div>
 <div class="card-action">
   <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Homepage</a>
 </div>
</div>

<?php get_footer(); ?>

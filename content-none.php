<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Materialist
 */
?>

<div class="card  yellow lighten-3">
 <div class="card-content">
   <span class="card-title"><?php _e( 'Nothing Found', 'materialist' ); ?></span>
    	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
    
    		<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'materialist' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
    
    	<?php elseif ( is_search() ) : ?>
    
    		<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'materialist' ); ?></p>
    		<?php get_search_form(); ?>
    
    	<?php else : ?>
    
    		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'materialist' ); ?></p>
    		<?php get_search_form(); ?>
    
    	<?php endif; ?>
 </div>
</div>
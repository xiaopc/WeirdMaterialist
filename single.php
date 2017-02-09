<?php
/**
 * The template for displaying all single posts.
 *
 * @package Materialist
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class("card"); ?>>
    <?php materialist_entry_thumbnail(); ?>

	<div class="card-content"><?php the_content(); ?></div>

    <div class="card-action">
        <?php materialist_entry_footer(); ?>
    </div>

</article><!-- #post-## -->
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links"><span class="page-links-title">'. __( 'Pages:', 'materialist' ) .'</span>',
				'after'  => '</div>',
				'pagelink' => '<span class="page-link">%</span>'
			) );
		?>

			<?php materialist_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>

<?php
/**
 * @package Materialist
 */
?>

<div class="hentry-separator">
	<?php materialist_posted_on(); ?>
</div><!-- .entry-meta -->

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php materialist_entry_thumbnail(); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links"><span class="page-links-title">'. __( 'Pages:', 'materialist' ) .'</span>',
				'after'  => '</div>',
				'pagelink' => '<span class="page-link">%</span>'
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php materialist_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

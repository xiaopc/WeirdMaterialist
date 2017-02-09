<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Materialist
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class("card"); ?>>
    <?php materialist_entry_thumbnail(); ?>

	<div class="card-content"><?php the_content(); ?></div>

    <div class="card-action"><?php materialist_entry_footer(); ?></div>

</article><!-- #post-## -->
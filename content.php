<?php
/**
 * @package Materialist
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("card"); ?>>
    <?php materialist_entry_thumbnail(); ?>

	<div class="card-content"><?php the_excerpt(); ?></div>

    <div class="card-action hide-on-small-only">
        <?php materialist_entry_footer(); ?>
    </div>

	
</article><!-- #post-## -->
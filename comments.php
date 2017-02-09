<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Materialist
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="card comments-area">
    <div class="card-content">
    <?php if ( have_comments() ) : ?>
    	<span class="card-title">
    		<?php
    			printf( _nx( '只有一条评论', '有 %1$s 条评论', get_comments_number(), 'comments title', 'materialist' ),
    				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
    		?>
    	</span>
    <?php endif; ?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<ul class="collection comment-list">
			<?php
				wp_list_comments( array(
					'short_ping' => true,
					'callback' 	 => 'materialist_comment'
				) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    	<div class="comment-pagination">
    		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'materialist' ); ?></h1>
    		<span class="btn btn-floating btn-large waves-effect waves-light blue lighten-1 left"><?php previous_comments_link('<i class="material-icons">chevron_left</i>'); ?></span>
            <span class="btn btn-floating btn-large waves-effect waves-light blue lighten-1 right"><?php next_comments_link('<i class="material-icons">chevron_right</i>'); ?></span>
    	</div>
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'materialist' ); ?></p>
	<?php endif; ?>

	<?php 
		comment_form( array(
		    'fields' => array(
		        'author' => '<div class="row">
                              <div class="input-field col s12 l4">
                                <input id="author" name="author" type="text" class="validate" value="' . esc_attr( $commenter['comment_author'] ) . '" length="32"' . $aria_req . '>
                                <label for="first_name">'.__( 'Name*', 'materialize' ).'</label>
                             </div>',
                'email' => '  <div class="input-field col s12 l4">
                                <input id="email" name="email" type="text" class="validate" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" length="64"' . $aria_req . '>
                                <label for="last_name">' . __( 'Email*', 'materialize' ) . '</label>
                              </div>',
                'url' => '    <div class="input-field col s12 l4">
                                <input id="url" name="url" type="text" class="validate" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" length="64">
                                <label for="last_name">' . __( 'Website', 'materialize' ) . '</label>
                              </div>
                            </div>'
		        ),
		    'comment_field' => '<div class="row"><div class="input-field col s12"><textarea id="comment" class="materialize-textarea" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea><label for="comment">' . __( 'Comment', 'materialize' ) . '</label></div></div>',
		    'title_reply_before' => '<span class="card-title">',
		    'title_reply_after' => '</span>',
		    'class_form' => 'col s12',
		    'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="btn btn-large btn-floating waves-effect waves-light blue right %3$s""><i class="material-icons">send</i></button>',
			'comment_notes_before' 	=> false,
			'comment_notes_after' 	=> false
		) ); 
	?>
    </div>
</div><!-- #comments -->

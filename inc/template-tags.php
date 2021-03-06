<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Materialist
 */

if ( ! function_exists( 'materialist_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function materialist_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<div class="post-navigation" role="navigation">
	    <div class="row">
        	<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'materialist' ); ?></h1>
        	<div class="btn waves-effect waves-light btn-large btn-flat nav-previous col s12 l6 left"><?php previous_post_link( '%link', __( '<i class="material-icons">chevron_left</i><span class="title">%title</span>', 'materialist' ) ); ?></div>
        	<div class="btn waves-effect waves-light btn-large btn-flat nav-next col s12 l6 right"><?php next_post_link('%link', __( '<span class="title">%title</span><i class="material-icons">chevron_right</i>', 'materialist' ) ); ?></div>
    	</div>
	</div><!-- .navigation -->
	<?php
}
endif;

if( ! function_exists( 'materialist_paging_nav' ) ) :
/**
 * Display navigation to newer set of posts when applicable.
 */
function materialist_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>

	<div class="index-pagination">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'materialist' ); ?></h1>
		<?php if ( get_previous_posts_link() ) : ?><span class="btn btn-floating btn-large waves-effect waves-light blue lighten-1 left"><?php previous_posts_link('<i class="material-icons">chevron_left</i>'); ?></span><?php endif; ?>
        <?php if ( get_next_posts_link() ) : ?><span class="btn btn-floating btn-large waves-effect waves-light blue lighten-1 right"><?php next_posts_link('<i class="material-icons">chevron_right</i>'); ?></span><?php endif; ?>
	</div>

	<?php
}
endif; 

if ( ! function_exists( 'materialist_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function materialist_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	echo '<span class="posted-on">' . $posted_on . '</span>';

}
endif;

if ( ! function_exists( 'materialist_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function materialist_entry_footer() {

    printf( '<span class="postmeta postmeta-date"><i class="material-icons">date_range</i><span id="postmeta-text">%1$s</span></span>', get_the_time("Y-m-d") );
    printf( '<span class="postmeta postmeta-time"><i class="material-icons">access_time</i><span id="postmeta-text">%1$s</span></span>', get_the_time(get_option(’date_format’)) );
	
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ', ','');
		if ( $categories_list && materialist_categorized_blog() ) {
			printf( '<span class="postmeta postmeta-cate"><i class="material-icons">folder_open</i><span id="postmeta-text">%1$s</span></span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'materialist' ) );
		if ( $tags_list ) {
			printf( '<span class="postmeta postmeta-cate"><i class="material-icons">label_outline</i><span id="postmeta-text">%1$s</span></span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="postmeta postmeta-comments">';
		comments_popup_link( "", '<i class="material-icons">comment</i><span id="postmeta-text">1</span>', '<i class="material-icons">comment</i><span id="postmeta-text">%</span>' );
		echo '</span>';
	}
	
	edit_post_link( '<i class="material-icons">mode_edit</i>', '<span class="postmeta-edit right">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'materialist' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'materialist' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'materialist' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'materialist' ), get_the_date( _x( 'Y', 'yearly archives date format', 'materialist' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'materialist' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'materialist' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'materialist' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'materialist' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'materialist' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'materialist' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'materialist' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'materialist' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'materialist' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'materialist' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'materialist' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'materialist' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'materialist' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'materialist' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'materialist' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'materialist' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function materialist_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'materialist_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'materialist_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so materialist_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so materialist_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in materialist_categorized_blog.
 */
function materialist_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'materialist_categories' );
}
add_action( 'edit_category', 'materialist_category_transient_flusher' );
add_action( 'save_post',     'materialist_category_transient_flusher' );

/**
 * Post thumbnail
 */
if( ! function_exists( 'materialist_entry_thumbnail' ) ) :
function materialist_entry_thumbnail( $post_id = false ){

	if( ! $post_id ){
		$post_id = get_the_ID();
	}

	if( has_post_thumbnail() ){
		echo '<div class="card-image"><a href="'. esc_url( get_permalink( $post_id ) ) .'" title="'. esc_attr( get_the_title( $post_id ) ) .'">';
        echo get_the_post_thumbnail( $post_id, 'large' );
        if (is_page() or is_single()) {
            the_title( '<span class="card-title">', '</span>');
        } else {
            the_title( '<span class="card-title">', '<span class="btn-floating btn-large waves-effect waves-light blue lighten-2 right hide-on-small-only"><i class="material-icons">chevron_right</i></span></span>');
        }
        echo '</a></div>';
	} else {
	    echo '<div class="card-head">';
        if (is_page() or is_single()) {
            the_title('<span class="card-title""><h1>', '</h1></span>' );
        } else {
            the_title( sprintf( '<span class="card-title""><a href="%s" rel="bookmark"><h1>', esc_url( get_permalink() ) ), '</h1><span class="btn-floating btn-large waves-effect waves-light blue lighten-2 right hide-on-small-only"><i class="material-icons">chevron_right</i></span></a></span>' );
        }
	    echo '</div>';
	}
}
endif;

/**
 * Custom callback for displaying comment
 */
if( ! function_exists( 'materialist_comment' ) ) :
function materialist_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'materialist' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'materialist' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class("collection-item avatar"); ?> id="comment-<?php comment_ID(); ?>">
	    <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'], '', '', Array( "class" => "circle" )); ?>
		<span class="title"><?php printf( get_comment_author_link() ); ?><span class="comment-meta"> @ <?php echo get_comment_date(); ?> </span></span>
		<span class="secondary-content">
		    <?php edit_comment_link( '<i class="material-icons">edit</i>' ); ?>
			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'reply_text' => '<i class="material-icons">reply</i>'
				) ) );
			?>
			<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>"><i class="material-icons">link</i></a>
		</span>
		
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">

			<?php if ( '0' == $comment->comment_approved ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'materialist' ) ?></em>
			<br />
			<?php endif; ?>

			<?php comment_text( get_comment_id(), array_merge( $args, array( 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

		</div><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
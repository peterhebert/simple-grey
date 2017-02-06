<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Simple Grey
 */

if ( ! function_exists( 'simple_grey_get_the_category_list' ) ) :
/**
 * get a list of categories by post id.
 */
function simple_grey_get_the_category_list( $id )
 {

    $categories = get_the_category( $id );
    $category_list = array();
    foreach ($categories as $category) {
      // exclude Uncategorized from lists
      if($category->name != 'Uncategorized') {
        $category_list[] = '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s", 'simple-grey' ), $category->name ) ) . '" rel="category tag">'. $category->name.'</a>';
      }
    }

	return $category_list;
}
endif;

if ( ! function_exists( 'simple_grey_list_categories_without_uncategorized' ) ) :
/**
 * list post categories without 'Uncategorized' category.
 */
function simple_grey_list_categories_without_uncategorized($args=array())
 {
    if(get_category_by_slug('uncategorized')) {
      $uncatObj = get_category_by_slug('uncategorized');
    	$args['exclude'] = strval($uncatObj->term_id);
    }
    $args['title_li'] = '';
  	return wp_list_categories($args);

}
endif;


if ( ! function_exists( 'get_the_modified_author_id' ) ) :
/**
 * get the modified author id and meta
 */
function get_the_modified_author_id() {
    if ( $last_id = get_post_meta( get_post()->ID, '_edit_last', true) ) {
      return $last_id;
    }
}
endif; // get_the_modified_author_id


if ( ! function_exists( 'simple_grey_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function simple_grey_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'simple-grey' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>%title', 'Previous post link', 'simple-grey' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title<span class="meta-nav">&rarr;</span>', 'Next post link',     'simple-grey' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'simple_grey_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function simple_grey_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'simple-grey' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'simple-grey' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'simple-grey' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'simple-grey' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'simple-grey' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'simple-grey' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for simple_grey_comment()

if ( ! function_exists( 'simple-grey_posted_on' ) ) :
/**
* Prints HTML with meta information for the current post-date/time, author and taxonomy.
*/
function simple_grey_posted_on() {
	$time_published_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_published_string = sprintf(
		$time_published_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_updated_string = '<time class="updated" datetime="%1$s">%2$s</time>';

		$time_updated_string = sprintf(
			$time_updated_string,
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

	}

	/* print posted date and time */
	echo '<span class="posted-on">';
	printf( __( 'Posted on %1$s by %2$s', 'simple-grey' ).' ',
		sprintf(
			'<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_published_string
		),
		sprintf(
			'<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)

	);

	// taxonomy
	$category_list = simple_grey_get_the_category_list( get_the_ID() );

	/* translators: used between list items, there is a space after the comma */
	$category_list_filtered = implode( __( ', ', 'simple-grey' ), $category_list );

	/* translators: used between list items, there is a space after the comma */
	$tag_list = get_the_tag_list( '', __( ', ', 'simple-grey' ) );

	if ( count($category_list) == 0 ) {

		// This post only has no categories so we just need to worry about tags in the meta text
		if ( '' != $tag_list ) {
			$meta_text = __( 'and tagged %2$s.', 'simple-grey' );
		} else {
			$meta_text = '';
		}

	} else {
		// But this post has categories so we should probably display them here
		if ( '' != $tag_list ) {
			$meta_text = __( 'in %1$s and tagged %2$s.', 'simple-grey' );
		} else {
			$meta_text = __( 'in %1$s.', 'simple-grey' );
		}

	} // end check for categories on this blog

	if ( '' != $meta_text && 'post' == get_post_type() ) :
		echo ' <span class="post-taxonomy">';
		printf(
			$meta_text,
			$category_list_filtered,
			$tag_list
		);
		echo '</span>';
	endif;
	echo "</span>\r";

	// print updated time and date
	if ( isset($time_updated_string) && get_theme_mod( 'simple_grey_show_updated' ) == 1 ) {
		echo '<span class="post-updated">';
		printf(
			__( 'Last updated on %1$s by %2$s.', 'simple-grey' ).' ',
			$time_updated_string,
			sprintf(
				'<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
				esc_url( get_author_posts_url( get_the_modified_author_id() ) ),
				esc_html( get_the_modified_author() )
			)
		);
		echo "</span>\r";
	}

}
endif;

if ( ! function_exists( 'simple_grey_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function simple_grey_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'simple-grey' ) );
		if ( $categories_list && simple_grey_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'simple-grey' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'simple-grey' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'simple-grey' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'simple-grey' ), __( '1 Comment', 'simple-grey' ), __( '% Comments', 'simple-grey' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'simple-grey' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function simple_grey_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'simple_grey_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'simple_grey_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so simple_grey_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so simple_grey_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in simple_grey_categorized_blog.
 */
function simple_grey_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'simple_grey_categories' );
}
add_action( 'edit_category', 'simple_grey_category_transient_flusher' );
add_action( 'save_post',     'simple_grey_category_transient_flusher' );

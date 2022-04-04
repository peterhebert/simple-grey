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
	 * Get a list of categories by post id.
	 *
	 * @param int $id Category ID.
	 *
	 * @return string List of categories.
	 */
	function simple_grey_get_the_category_list( $id ) {

		$categories    = get_the_category( $id );
		$category_list = array();
		foreach ( $categories as $category ) {
			// exclude Uncategorized from lists.
			if ( 'Uncategorized' !== $category->name ) {
				// translators: category name.
				$category_list[] = '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( 'View all posts in %s', 'simple-grey' ), $category->name ) ) . '" rel="category tag">' . $category->name . '</a>';
			}
		}

		return $category_list;
	}
endif;

if ( ! function_exists( 'simple_grey_list_categories_without_uncategorized' ) ) :

	/**
	 * List post categories without 'Uncategorized' category.
	 *
	 * @param array $args Arguments to pass to wp_list_categories().
	 *
	 * @return string List of categories.
	 */
	function simple_grey_list_categories_without_uncategorized( $args = array() ) {
		if ( get_category_by_slug( 'uncategorized' ) ) {
			$uncat_obj       = get_category_by_slug( 'uncategorized' );
			$args['exclude'] = strval( $uncat_obj->term_id );
		}
		$args['title_li'] = '';
		return wp_list_categories( $args );

	}
endif;


if ( ! function_exists( 'get_the_modified_author_id' ) ) :

	/**
	 * Get the modified author id and meta
	 *
	 * @return mixed Author meta and ID if found
	 */
	function get_the_modified_author_id() {
		$last_id = get_post_meta( get_post()->ID, '_edit_last', true );

		if ( $last_id ) {
			return $last_id;
		}
	}
endif;

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
		<h1 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'simple-grey' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>%title', 'Previous post link', 'simple-grey' ) );
				next_post_link( '<div class="nav-next">%link</div>', _x( '%title<span class="meta-nav">&rarr;</span>', 'Next post link', 'simple-grey' ) );
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
	 *
	 * @param string $comment Comment text.
	 * @param array  $args Arguments.
	 * @param int    $depth Nested depth of comment.
	 * @return void
	 */
	function simple_grey_comment( $comment, $args, $depth ) {

		if ( 'pingback' === $comment->comment_type || 'trackback' === $comment->comment_type ) :
			?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php esc_html_e( 'Pingback:', 'simple-grey' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'simple-grey' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
					if ( 0 !== $args['avatar_size'] ) {
						echo get_avatar( $comment, $args['avatar_size'] ); }
					?>
					<?php
					// translators: author name.
					printf( esc_html__( '%s <span class="says">says:</span>', 'simple-grey' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) );
					?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php
							// translators: 1. date. 2. time.
							printf( esc_html_x( '%1$s at %2$s', '1: date, 2: time', 'simple-grey' ), esc_html( get_comment_date() ), esc_html( get_comment_time() ) );
							?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'simple-grey' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' === $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'simple-grey' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply">',
							'after'     => '</div>',
						)
					)
				);
			?>
		</article><!-- .comment-body -->

		<?php
		endif;
	}
endif;

if ( ! function_exists( 'simple_grey_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time, author and taxonomy.
	 *
	 * @return void
	 */
	function simple_grey_posted_on() {
		$time_published_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

		$time_published_string = sprintf(
			$time_published_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		/* print posted date and time */
		echo '<span class="posted-on">';
		printf(
			// translators: 1. published date. 2. Author name.
			wp_kses( __( 'Posted on %1$s by %2$s ', 'simple-grey' ), simple_grey_basic_allowed_html() ),
			sprintf(
				'<a href="%1$s" rel="bookmark">%2$s</a>',
				esc_url( get_permalink() ),
				wp_kses( $time_published_string, simple_grey_basic_allowed_html() ),
			),
			sprintf(
				'<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			)
		);
		echo "</span>\r";

	}
endif;

if ( ! function_exists( 'simple_grey_post_updated' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time, author and taxonomy.
	 *
	 * @return void
	 */
	function simple_grey_post_updated() {

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_updated_string = '<time class="updated" datetime="%1$s">%2$s</time>';

			$time_updated_string = sprintf(
				$time_updated_string,
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

		}

		// print updated time and date.
		if ( isset( $time_updated_string ) && 1 === get_theme_mod( 'simple_grey_show_updated' ) ) {
			echo '<span class="post-updated">';
			printf(
				// translators: 1. Updated date. 2. Updated author.
				wp_kses( __( 'Last updated on %1$s by %2$s ', 'simple-grey' ), simple_grey_basic_allowed_html() ),
				wp_kses( $time_updated_string, simple_grey_basic_allowed_html() ),
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

if ( ! function_exists( 'simple_grey_post_taxonomy' ) ) :
	/**
	 * Prints categories and terms associated with post.
	 *
	 * @return void
	 */
	function simple_grey_post_taxonomy() {

		// taxonomy.
		$category_list = simple_grey_get_the_category_list( get_the_ID() );

		/* translators: used between list items, there is a space after the comma */
		$category_list_filtered = implode( __( ', ', 'simple-grey' ), $category_list );

		/* translators: used between list items, there is a space after the comma */
		$tag_list = get_the_tag_list( '', __( ', ', 'simple-grey' ) );

		if ( 0 === count( $category_list ) ) {

			// This post only has no categories so we just need to worry about tags in the meta text.
			if ( '' !== $tag_list ) {
				// translators: tag.
				$meta_text = __( 'and tagged %2$s.', 'simple-grey' );
			} else {
				$meta_text = '';
			}
		} else {

			// But this post has categories so we should probably display them here.
			if ( '' !== $tag_list ) {
				// translators: 1. category. 2. tags.
				$meta_text = __( 'in %1$s and tagged %2$s.', 'simple-grey' );
			} else {
				// translators: category.
				$meta_text = __( 'in %1$s.', 'simple-grey' );
			}
		}
		// end check for categories on this blog.

		if ( '' !== $meta_text && 'post' === get_post_type() ) :
			echo ' <span class="post-taxonomy">';
			printf(
				esc_html( $meta_text ),
				wp_kses( $category_list_filtered, wp_kses_allowed_html( 'post' ) ),
				wp_kses( $tag_list, wp_kses_allowed_html( 'post' ) )
			);
			echo '</span>';
		endif;

	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function simple_grey_categorized_blog() {

	$all_the_categories = get_transient( 'simple_grey_categories' );

	if ( false === $all_the_categories ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_categories = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_categories = count( $all_the_categories );

		set_transient( 'simple_grey_categories', $all_the_categories );
	}

	if ( $all_the_categories > 1 ) {
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
add_action( 'save_post', 'simple_grey_category_transient_flusher' );



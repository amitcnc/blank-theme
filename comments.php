<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage CNC_Theme
 * @since 1.0
 * @version 1.0
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
<div id="comments" class="comments-area">
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h3 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Comment to &ldquo;%s&rdquo;', 'comments title', 'CNC_Theme' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Comment to &ldquo;%2$s&rdquo;',
						'%1$s Comments to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'CNC_Theme'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h3>
		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'callback' => 'advanced_comment',
						'avatar_size' => 100,
						'style'       => 'ol',
						'short_ping'  => true,
					)
				);
			?>
		</ol>
		<?php
		the_comments_pagination(
			array(
				'prev_text' => '<span class="screen-reader-text">' . __( 'Previous', 'CNC_Theme' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'CNC_Theme' ) . '</span>',
			)
		);

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'CNC_Theme' ); ?></p>
		<?php
	endif;

	$comments_args = array(
        'title_reply' => __( 'Write a Comment', 'CNC_Theme' ),
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'comment_field' => '<textarea id="comment" name="comment" aria-required="true" placeholder=" '.__( 'Enter your Comment*', 'CNC_Theme').'"></textarea>',

		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<div class="df"><input type="text" placeholder="Name*" id="author" name="author" placeholder="'.__( 'Name*', 'CNC_Theme').'" value="' . esc_attr( $commenter['comment_author'] ) .
			'">',
			'email' => '<input type="email" name="email" id="email" placeholder="'.__( 'Email*', 'CNC_Theme').'" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			'"></div>',
			))
	);
	comment_form($comments_args);
	?>

</div><!-- #comments -->
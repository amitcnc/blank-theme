<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, cnc
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage CNC_Theme
 * @since 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					if ( is_day() ) {
						/* translators: %s: Date. */
						printf( __( 'Daily archive:', 'CNC_Theme' ), get_the_date() );
					} elseif ( is_month() ) {
						/* translators: %s: Date. */
						printf( __( 'Monthly archive:', 'CNC_Theme' ), get_the_date( _x( 'F Y', 'Monthly archive date format', 'CNC_Theme' ) ) );
					} elseif ( is_year() ) {
						/* translators: %s: Date. */
						printf( __( 'Annual archive:', 'CNC_Theme' ), get_the_date( _x( 'Y', 'Annual archive date format', 'CNC_Theme' ) ) );
					} else {
						_e( 'Archive', 'CNC_Theme' );
					}
					?>
				</h1>
			</header><!-- .page-header -->

				<?php
				// Start the Loop.
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the post format-specific template for the content. If you want
					 * to use this in a child theme, then include a file called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

					endwhile;
					// Previous/next page navigation.
					//twentyfourteen_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
				?>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
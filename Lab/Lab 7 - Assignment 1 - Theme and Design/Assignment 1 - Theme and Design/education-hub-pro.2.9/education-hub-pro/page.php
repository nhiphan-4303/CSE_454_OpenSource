<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Education_Hub
 */

get_header(); ?>

<?php if ( class_exists( 'LearnPress' ) || class_exists( 'bbPress' ) ) : ?>

	<?php if ( ! is_front_page() || true === education_hub_get_option( 'home_content_status' ) ) : ?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'page' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
						endif;
					?>

				<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
			/**
			 * Hook - education_hub_action_sidebar.
			 *
			 * @hooked: education_hub_add_sidebar - 10
			 */
			do_action( 'education_hub_action_sidebar' );
		?>

	<?php endif; // End if show home content. ?>

<?php else : ?>

	<?php if ( ( is_page() && ! is_front_page() ) || ( true === education_hub_get_option( 'home_content_status' ) && is_front_page() ) ) : ?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'page' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
						endif;
					?>

				<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
			/**
			 * Hook - education_hub_action_sidebar.
			 *
			 * @hooked: education_hub_add_sidebar - 10
			 */
			do_action( 'education_hub_action_sidebar' );
		?>

	<?php endif; // End if show home content. ?>

<?php endif; // End if Learnpress. ?>

<?php get_footer();

<?php
/**
 * Custom theme functions.
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Education_Hub
 */

if ( ! function_exists( 'education_hub_skip_to_content' ) ) :
	/**
	 * Add Skip to content.
	 *
	 * @since 1.0.0
	 */
	function education_hub_skip_to_content() {
	?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'education-hub' ); ?></a><?php
	}
endif;

add_action( 'education_hub_action_before', 'education_hub_skip_to_content', 15 );

if ( ! function_exists( 'education_hub_header_top_content' ) ) :
	/**
	 * Header Top Start.
	 *
	 * @since 1.0.0
	 */
	function education_hub_header_top_content() {
		$contact_number = education_hub_get_option( 'contact_number' );
		$contact_email  = education_hub_get_option( 'contact_email' );
	?>
	<div id="tophead">
		<div class="container">
			<div id="quick-contact">
				<?php if ( ! empty( $contact_number ) || ! empty( $contact_email ) ): ?>
					<ul>
						<?php if ( ! empty( $contact_number ) ) : ?>
							<li class="quick-call"><a href="tel:<?php echo preg_replace( '/\D+/', '', esc_attr( $contact_number ) ); ?>"><?php echo esc_attr( $contact_number ); ?></a></li>
						<?php endif ?>
						<?php if ( ! empty( $contact_email ) ) : ?>
							<li class="quick-email"><a href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_attr( antispambot( $contact_email ) ); ?></a></li>
						<?php endif ?>
					</ul>
				<?php endif ?>
				<?php if ( true === education_hub_get_option( 'show_notice' ) ): ?>
					<div class="top-news">
						<span class="top-news-title">
						<?php $notice_title = education_hub_get_option( 'notice_title' );  ?>
						<?php if ( ! empty( $notice_title ) ) : ?>
							<?php echo esc_html( $notice_title ); ?>
						<?php endif; ?>
						</span>
						<?php $notice_type = education_hub_get_option( 'notice_type' ); ?>
						<?php if ( 'static' === $notice_type ) : ?>
							<?php $notice_link_text = education_hub_get_option( 'notice_link_text' );  ?>
							<?php if ( ! empty( $notice_link_text ) ): ?>
								<p><a href="<?php echo esc_url( education_hub_get_option( 'notice_link_url' ) ); ?>"><?php echo esc_html( $notice_link_text ); ?>
								</a></p>
							<?php endif; ?>
						<?php else: ?>

							<?php echo education_hub_get_notice_ticker_content(); ?>

						<?php endif; // End if. ?>

					</div>
				<?php endif ?>
			</div>

			<?php if ( true === education_hub_get_option( 'show_quick_links' )  ): ?>
				<div class="quick-links">
					<a href="#" class="links-btn"><?php echo esc_html( education_hub_get_option( 'quick_links_text' ) ); ?></a>
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'quick-links',
								'container'      => false,
								'depth'          => 1,
								'fallback_cb'    => 'education_hub_quick_links_fallback',
							)
						);
					 ?>
				</div>
			<?php endif ?>

			<?php if ( true === education_hub_get_option( 'show_social_in_header' )  ) : ?>
				<div class="header-social-wrapper">
					<?php the_widget( 'Education_Hub_Social_Widget' ); ?>
				</div><!-- .header-social-wrapper -->
			<?php endif; ?>

		</div> <!-- .container -->
	</div><!--  #tophead -->

	<?php
	}

endif;
add_action( 'education_hub_action_before_header', 'education_hub_header_top_content', 5 );

if ( ! function_exists( 'education_hub_site_branding' ) ) :

	/**
	 * Site branding.
	 *
	 * @since 1.0.0
	 */
	function education_hub_site_branding() {

	?>
    <div class="site-branding">

	    <?php education_hub_the_custom_logo(); ?>

		<?php $show_title = education_hub_get_option( 'show_title' ); ?>
		<?php $show_tagline = education_hub_get_option( 'show_tagline' ); ?>
		<?php if ( true === $show_title || true === $show_tagline ) :  ?>
        <div id="site-identity">
			<?php if ( true === $show_title ) :  ?>
            <?php if ( is_front_page() && is_home() ) : ?>
              <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php else : ?>
              <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php endif; ?>
			<?php endif; ?>

			<?php if ( true === $show_tagline ) :  ?>
            <p class="site-description"><?php bloginfo( 'description' ); ?></p>
			<?php endif ?>
        </div><!-- #site-identity -->
		<?php endif; ?>

    </div><!-- .site-branding -->

    <?php $show_search_form = education_hub_get_option( 'show_search_form' ); ?>
    <?php if ( true === $show_search_form ) : ?>
	    <div class="search-section">
	    	<?php get_search_form(); ?>
	    </div>
    <?php endif ?>
    <?php

	}

endif;

add_action( 'education_hub_action_header', 'education_hub_site_branding' );


if ( ! function_exists( 'education_hub_add_primary_navigation' ) ) :

	/**
	 * Site branding.
	 *
	 * @since 1.0.0
	 */
	function education_hub_add_primary_navigation() {
	?>
    <div id="main-nav" class="clear-fix">
        <div class="container">
        <nav id="site-navigation" class="main-navigation" role="navigation">
          <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars"></i><?php esc_html_e( 'Menu', 'education-hub' ); ?></button>
            <div class="wrap-menu-content">
				<?php
				wp_nav_menu(
					array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'fallback_cb'    => 'education_hub_primary_menu_fallback',
					)
				);
				?>
            </div><!-- .menu-content -->
        </nav><!-- #site-navigation -->
       </div> <!-- .container -->
    </div> <!-- #main-nav -->
    <?php
	}

endif;

add_action( 'education_hub_action_after_header', 'education_hub_add_primary_navigation', 20 );

if ( ! function_exists( 'education_hub_footer_copyright' ) ) :

	/**
	 * Footer copyright
	 *
	 * @since 1.0.0
	 */
	function education_hub_footer_copyright() {

		// Check if footer is disabled.
		$footer_status = apply_filters( 'education_hub_filter_footer_status', true );
		if ( true !== $footer_status ) {
			return;
		}

		// Footer Menu.
		$footer_menu_content = wp_nav_menu( array(
			'theme_location' => 'footer',
			'container'      => 'div',
			'container_id'   => 'footer-navigation',
			'depth'          => 1,
			'fallback_cb'    => false,
			'echo'           => false,
		) );

		// Copyright content.
		$copyright_text = education_hub_get_option( 'copyright_text' );
		$copyright_text = apply_filters( 'education_hub_filter_copyright_text', $copyright_text );
		if ( ! empty( $copyright_text ) ) {
			$copyright_text = wp_kses_data( $copyright_text );
			$copyright_text = education_hub_apply_theme_shortcode( $copyright_text );
		}
		// Powered by content.
		$powered_by_text = education_hub_get_option( 'powered_by_text' );
		$powered_by_text = apply_filters( 'education_hub_filter_powered_by_text', $powered_by_text );
		if ( ! empty( $powered_by_text ) ) {
			$powered_by_text = wp_kses_data( $powered_by_text );
			$powered_by_text = education_hub_apply_theme_shortcode( $powered_by_text );
		}
	?>

    <?php if ( ! empty( $footer_menu_content ) ) :  ?>
		<?php echo $footer_menu_content; ?>
    <?php endif ?>
    <?php if ( ! empty( $copyright_text ) ) :  ?>
      <div class="copyright">
        <?php echo $copyright_text; ?>
      </div><!-- .copyright -->
    <?php endif; ?>
    <?php if ( ! empty( $powered_by_text ) ) :  ?>
    <div class="site-info">
		<?php echo $powered_by_text; ?>
    </div><!-- .site-info -->
    <?php endif; ?>
    <?php
	}

endif;

add_action( 'education_hub_action_footer', 'education_hub_footer_copyright', 10 );


if ( ! function_exists( 'education_hub_add_sidebar' ) ) :

	/**
	 * Add sidebar.
	 *
	 * @since 1.0.0
	 */
	function education_hub_add_sidebar() {

		global $post;

		$global_layout = education_hub_get_option( 'global_layout' );
		$global_layout = apply_filters( 'education_hub_filter_theme_global_layout', $global_layout );

		// Check if single.
		if ( $post && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'theme_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$global_layout = $post_options['post_layout'];
			}
		}

		// Include Primary sidebar.
		if ( 'no-sidebar' !== $global_layout ) {
			get_sidebar();
		}
		// Include Secondary sidebar.
		switch ( $global_layout ) {
		  case 'three-columns':
		  case 'three-columns-pcs':
		  case 'three-columns-cps':
		  case 'three-columns-psc':
		  case 'three-columns-pcs-equal':
		  case 'three-columns-scp-equal':
		    get_sidebar( 'secondary' );
		    break;

		  default:
		    break;
		}


	}

endif;

add_action( 'education_hub_action_sidebar', 'education_hub_add_sidebar' );


if ( ! function_exists( 'education_hub_custom_posts_navigation' ) ) :
	/**
	 * Posts navigation.
	 *
	 * @since 1.0.0
	 */
	function education_hub_custom_posts_navigation() {

		$pagination_type = education_hub_get_option( 'pagination_type' );

		switch ( $pagination_type ) {

			case 'default':
				the_posts_navigation();
			break;

			case 'numeric':
				if ( function_exists( 'wp_pagenavi' ) ) {
					wp_pagenavi();
				} else {
					the_posts_pagination();
				}
			break;

			default:
			break;
		}

	}
endif;

add_action( 'education_hub_action_posts_navigation', 'education_hub_custom_posts_navigation' );


if ( ! function_exists( 'education_hub_add_image_in_single_display' ) ) :

	/**
	 * Add image in single post.
	 *
	 * @since 1.0.0
	 */
	function education_hub_add_image_in_single_display() {

		global $post;

		if ( has_post_thumbnail() ) {

			$values = get_post_meta( $post->ID, 'theme_settings', true );
			$theme_settings_single_image = isset( $values['single_image'] ) ? esc_attr( $values['single_image'] ) : '';
			$theme_settings_single_image_alignment = isset( $values['single_image_alignment'] ) ? esc_attr( $values['single_image_alignment'] ) : '';

			if ( ! $theme_settings_single_image ) {
				$theme_settings_single_image = education_hub_get_option( 'single_image' );
			}
			if ( ! $theme_settings_single_image_alignment ) {
				$theme_settings_single_image_alignment = education_hub_get_option( 'single_image_alignment' );
			}

			if ( 'disable' !== $theme_settings_single_image ) {
				$args = array(
				'class' => 'align' . esc_attr( $theme_settings_single_image_alignment ),
				);
				the_post_thumbnail( esc_attr( $theme_settings_single_image ), $args );
			}
		}

	}

endif;

add_action( 'education_hub_single_image', 'education_hub_add_image_in_single_display' );

if ( ! function_exists( 'education_hub_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function education_hub_add_breadcrumb() {

		// Bail if Breadcrumb disabled.
		$breadcrumb_type = education_hub_get_option( 'breadcrumb_type' );
		if ( 'disabled' === $breadcrumb_type ) {
			return;
		}
		// Bail if plugin not active.
		// Bail if Home Page.
		if ( is_front_page() || is_home() ) {
			return;
		}

		echo '<div id="breadcrumb"><div class="container">';
		switch ( $breadcrumb_type ) {
			case 'simple':
				$breadcrumb_separator = education_hub_get_option( 'breadcrumb_separator' );
				$args = array(
				'separator' => $breadcrumb_separator,
				);
				education_hub_simple_breadcrumb( $args );
			break;

			case 'advanced':
				if ( function_exists( 'bcn_display' ) ) {
					bcn_display();
				}
			break;

			default:
			break;
		}
		echo '</div><!-- .container --></div><!-- #breadcrumb -->';
		return;

	}

endif;

add_action( 'education_hub_action_before_content', 'education_hub_add_breadcrumb' , 7 );


if ( ! function_exists( 'education_hub_footer_goto_top' ) ) :

	/**
	 * Go to top.
	 *
	 * @since 1.0.0
	 */
	function education_hub_footer_goto_top() {

		$go_to_top = education_hub_get_option( 'go_to_top' );
		if ( true !== $go_to_top ) {
			return;
		}
		echo '<a href="#page" class="scrollup" id="btn-scrollup"><i class="fa fa-chevron-up"></i></a>';

	}

endif;

add_action( 'education_hub_action_after', 'education_hub_footer_goto_top', 20 );

if ( ! function_exists( 'education_hub_add_home_news_event' ) ) :

	/**
	 * Display News Events section in home page.
	 *
	 * @since 1.0.0
	 */
	function education_hub_add_home_news_event() {
		if ( is_front_page() ) {

			$home_news_section_status = education_hub_get_option( 'home_news_section_status' );
			$home_events_section_status = education_hub_get_option( 'home_events_section_status' );

			if ( true === $home_news_section_status || true === $home_events_section_status ) {
				get_template_part( 'template-parts/home-news-events' );
			}

		}
	}

endif;

add_action( 'education_hub_action_before_content', 'education_hub_add_home_news_event', 8 );

if ( ! function_exists( 'education_hub_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since 1.0.0
	 */
	function education_hub_custom_content_width() {

		global $post, $wp_query, $content_width;

		$global_layout = education_hub_get_option( 'global_layout' );
		$global_layout = apply_filters( 'education_hub_filter_theme_global_layout', $global_layout );

		// Check if single.
		if ( $post  && is_singular() ) {
		  $post_options = get_post_meta( $post->ID, 'theme_settings', true );
		  if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
		    $global_layout = esc_attr( $post_options['post_layout'] );
		  }
		}
		switch ( $global_layout ) {

			case 'no-sidebar':
				$content_width = 1220;
				break;

			case 'three-columns':
			case 'three-columns-pcs':
			case 'three-columns-cps':
			case 'three-columns-psc':
			case 'no-sidebar-centered':
				$content_width = 570;
				break;

			case 'three-columns-pcs-equal':
			case 'three-columns-scp-equal':
				$content_width = 353;
				break;

			case 'left-sidebar':
			case 'right-sidebar':
				$content_width = 895;
				break;

			default:
				break;
		}

	}
endif;

add_filter( 'template_redirect', 'education_hub_custom_content_width' );


if ( ! function_exists( 'education_hub_add_front_page_widget_area' ) ) :

	/**
	 * Add Front Page Widget area.
	 *
	 * @since 1.0.0
	 */
	function education_hub_add_front_page_widget_area() {

		if ( is_front_page() && is_active_sidebar( 'sidebar-front-page-widget-area' ) ) {
		  echo '<div id="sidebar-front-page-widget-area" class="widget-area">';
		  echo '<div class="container">';
		    dynamic_sidebar( 'sidebar-front-page-widget-area' );
		  echo '</div><!-- .container -->';
		  echo '</div><!-- #sidebar-front-page-widget-area -->';
		}

	}
endif;
add_action( 'education_hub_action_before_content', 'education_hub_add_front_page_widget_area', 7 );

if ( ! function_exists( 'education_hub_add_front_page_widget_area_lower' ) ) :

	/**
	 * Add Front Page Widget area lower.
	 *
	 * @since 1.0.0
	 */
	function education_hub_add_front_page_widget_area_lower() {

		if ( is_front_page() && is_active_sidebar( 'sidebar-front-page-widget-area-lower' ) ) {
		  echo '<div id="sidebar-front-page-widget-area-lower" class="widget-area">';
		  echo '<div class="container">';
		    dynamic_sidebar( 'sidebar-front-page-widget-area-lower' );
		  echo '</div><!-- .container -->';
		  echo '</div><!-- #sidebar-front-page-widget-area-lower -->';
		}

	}
endif;
add_action( 'education_hub_action_before_content', 'education_hub_add_front_page_widget_area_lower', 9 );

if ( ! function_exists( 'education_hub_add_author_bio_in_single' ) ) :

	/**
	 * Display Author bio.
	 *
	 * @since 1.0.0
	 */
	function education_hub_add_author_bio_in_single() {

		$author_bio_in_single = education_hub_get_option( 'author_bio_in_single' );
		if ( true !== $author_bio_in_single ) {
			return;
		}
		get_template_part( 'template-parts/author-bio', 'single' );

	}
endif;

add_action( 'education_hub_author_bio', 'education_hub_add_author_bio_in_single' );

<?php
/**
 * DJ Franco theme bootstrap.
 *
 * A full-site-editing block theme. Most presentation is handled by
 * theme.json + templates/ + parts/ + patterns/. This file only wires up
 * enqueues, pattern categories, and a handful of supports.
 *
 * @package DJFranco
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DJFRANCO_VERSION', '1.0.0' );
define( 'DJFRANCO_DIR', get_stylesheet_directory() );
define( 'DJFRANCO_URI', get_stylesheet_directory_uri() );

/**
 * Theme supports. Most are opt-in via theme.json but a few still need PHP.
 */
add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'html5', [
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	] );
	add_editor_style( 'assets/css/editor.css' );

	register_nav_menus( [
		'primary' => __( 'Primary', 'djfranco' ),
		'footer'  => __( 'Footer',  'djfranco' ),
		'social'  => __( 'Social',  'djfranco' ),
	] );
} );

/**
 * Front-end enqueues. Theme stylesheet is the WP-required style.css (mostly
 * empty — real styling lives in theme.json + assets/css/theme.css).
 */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'djfranco-style',
		get_stylesheet_uri(),
		[],
		DJFRANCO_VERSION
	);

	wp_enqueue_style(
		'djfranco-theme',
		DJFRANCO_URI . '/assets/css/theme.css',
		[ 'djfranco-style' ],
		DJFRANCO_VERSION
	);

	wp_enqueue_script(
		'djfranco-theme',
		DJFRANCO_URI . '/assets/js/theme.js',
		[],
		DJFRANCO_VERSION,
		true
	);
}, 20 );

/**
 * Register pattern categories so our patterns show up grouped in the inserter.
 */
add_action( 'init', function () {
	if ( ! function_exists( 'register_block_pattern_category' ) ) {
		return;
	}
	register_block_pattern_category( 'djfranco-hero', [
		'label'       => __( 'DJ Franco · Hero', 'djfranco' ),
		'description' => __( 'Hero sections for DJ Franco Live.', 'djfranco' ),
	] );
	register_block_pattern_category( 'djfranco-section', [
		'label'       => __( 'DJ Franco · Sections', 'djfranco' ),
		'description' => __( 'Reusable content sections.', 'djfranco' ),
	] );
	register_block_pattern_category( 'djfranco-page', [
		'label'       => __( 'DJ Franco · Pages', 'djfranco' ),
		'description' => __( 'Full-page patterns.', 'djfranco' ),
	] );
} );

/**
 * Expose the site logo URL known from the WP media library as a fallback,
 * in case a site logo hasn't been set in the Customizer yet.
 */
add_filter( 'djfranco_fallback_logo_url', function ( $url ) {
	if ( $url ) {
		return $url;
	}
	return home_url( '/wp-content/uploads/2023/04/DJFrancoLogo.png' );
} );

/**
 * Helper: output the site logo URL (custom logo if set, else media fallback).
 *
 * @return string
 */
function djfranco_logo_url() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( $custom_logo_id ) {
		$src = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		if ( $src ) {
			return $src[0];
		}
	}
	return apply_filters( 'djfranco_fallback_logo_url', '' );
}

/**
 * Auto-load all patterns in /patterns/ so we can keep them as PHP files with
 * richer templating than .html block templates allow.
 */
add_action( 'init', function () {
	$dir = DJFRANCO_DIR . '/patterns';
	if ( ! is_dir( $dir ) ) {
		return;
	}
	// WordPress core auto-registers PHP files in /patterns/ since 6.0,
	// but we also give them a cache-busting filter hook for future use.
} );

/**
 * Tiny accessibility helper: skip-link target.
 */
add_action( 'wp_body_open', function () {
	echo '<a class="skip-link screen-reader-text" href="#wp--skip-link--target">' . esc_html__( 'Skip to content', 'djfranco' ) . '</a>';
} );

/* ============================================================
 * Google Analytics 4
 * ----------------------------------------------------------------
 * Paste your GA4 Measurement ID (looks like "G-XXXXXXXXXX") in
 *   Appearance → Customize → Analytics → GA4 Measurement ID.
 * Snippet is only output on the public front-end (not admin, not
 * for logged-in admins so internal traffic doesn't pollute data),
 * and only when an ID is set.
 *
 * Auto-tracks these lead events:
 *   - generate_lead  (Contact form submit)
 *   - cta_click      (Book / Check date / Listen buttons)
 *   - phone_click    (tel: links)
 *   - email_click    (mailto: links)
 *   - social_click   (footer + contact social icons)
 *   - file_download  (EPK / press downloads)
 * ============================================================ */

add_action( 'customize_register', function ( $wp_customize ) {
	$wp_customize->add_section( 'djfranco_analytics', [
		'title'    => __( 'Analytics', 'djfranco' ),
		'priority' => 200,
	] );
	$wp_customize->add_setting( 'djfranco_ga4_id', [
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	] );
	$wp_customize->add_control( 'djfranco_ga4_id', [
		'label'       => __( 'GA4 Measurement ID', 'djfranco' ),
		'description' => __( 'Format: G-XXXXXXXXXX. Find this in your GA4 property under Admin → Data Streams → Web → your stream.', 'djfranco' ),
		'section'     => 'djfranco_analytics',
		'type'        => 'text',
	] );
	$wp_customize->add_setting( 'djfranco_ga4_track_admins', [
		'default'           => '0',
		'sanitize_callback' => function ( $v ) { return $v ? '1' : '0'; },
	] );
	$wp_customize->add_control( 'djfranco_ga4_track_admins', [
		'label'       => __( 'Also track logged-in admins (not recommended)', 'djfranco' ),
		'section'     => 'djfranco_analytics',
		'type'        => 'checkbox',
	] );
} );

function djfranco_ga4_id() {
	$id = trim( (string) get_theme_mod( 'djfranco_ga4_id', '' ) );
	if ( ! preg_match( '/^G-[A-Z0-9]{6,}$/', $id ) ) {
		return '';
	}
	return $id;
}

function djfranco_ga4_should_track() {
	if ( is_admin() ) {
		return false;
	}
	if ( ! djfranco_ga4_id() ) {
		return false;
	}
	if ( ! get_theme_mod( 'djfranco_ga4_track_admins', '0' ) && current_user_can( 'manage_options' ) ) {
		return false;
	}
	return true;
}

add_action( 'wp_head', function () {
	if ( ! djfranco_ga4_should_track() ) {
		return;
	}
	$id = djfranco_ga4_id();
	?>
<!-- DJ Franco · Google Analytics 4 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $id ); ?>"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', '<?php echo esc_js( $id ); ?>', { 'anonymize_ip': true });
</script>
	<?php
}, 1 );

add_action( 'wp_footer', function () {
	if ( ! djfranco_ga4_should_track() ) {
		return;
	}
	?>
<!-- DJ Franco · GA4 event auto-tracking -->
<script>
(function(){
  if (typeof gtag !== 'function') return;
  var on = function(sel, ev, fn){ document.querySelectorAll(sel).forEach(function(el){ el.addEventListener(ev, fn); }); };

  // Lead — contact form submit
  on('.djf-form-grid', 'submit', function(e){
    var form = e.currentTarget;
    var type = form.querySelector('[name="type"]')?.value || '';
    var date = form.querySelector('[name="date"]')?.value || '';
    gtag('event', 'generate_lead', {
      event_category: 'contact',
      event_label: type || 'contact_form',
      event_type: type,
      event_date: date,
      page_path: location.pathname,
      value: 1
    });
  });

  // CTA — primary booking / listen buttons
  on('.djf-btn--primary, .djf-btn--ghost, .djf-mix-card__play, .djf-pkg__footer a', 'click', function(e){
    var el = e.currentTarget;
    gtag('event', 'cta_click', {
      event_category: 'cta',
      event_label: (el.textContent || '').trim().slice(0, 60),
      destination: el.getAttribute('href') || '',
      location: el.closest('section')?.className?.split(' ')[0] || ''
    });
  });

  // Phone / Email taps
  on('a[href^="tel:"]', 'click', function(e){
    gtag('event', 'phone_click', { event_category: 'contact', event_label: e.currentTarget.getAttribute('href') });
  });
  on('a[href^="mailto:"]', 'click', function(e){
    gtag('event', 'email_click', { event_category: 'contact', event_label: e.currentTarget.getAttribute('href') });
  });

  // Social icon clicks
  on('.djf-socials a', 'click', function(e){
    var label = e.currentTarget.getAttribute('aria-label') || '';
    gtag('event', 'social_click', { event_category: 'social', event_label: label, destination: e.currentTarget.href });
  });

  // EPK / press-kit downloads
  on('a[href$=".pdf"], a[href$=".zip"], a[href$=".png"], a[href$=".jpg"]', 'click', function(e){
    var href = e.currentTarget.getAttribute('href') || '';
    gtag('event', 'file_download', { event_category: 'download', event_label: href.split('/').pop(), file_url: href });
  });

  // Scroll-depth — 25 / 50 / 75 / 100
  var hit = {25:false, 50:false, 75:false, 100:false};
  window.addEventListener('scroll', function(){
    var h = document.documentElement;
    var pct = Math.round(((h.scrollTop + window.innerHeight) / h.scrollHeight) * 100);
    [25,50,75,100].forEach(function(t){
      if (!hit[t] && pct >= t) { hit[t] = true; gtag('event', 'scroll_depth', { event_category: 'engagement', event_label: t + '%', value: t }); }
    });
  }, { passive: true });
})();
</script>
	<?php
}, 99 );

/**
 * Admin notice nudging the site owner to set the GA4 ID until they do.
 */
add_action( 'admin_notices', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( djfranco_ga4_id() ) {
		return;
	}
	echo '<div class="notice notice-info"><p><strong>DJ Franco theme:</strong> Google Analytics isn\'t configured yet. <a href="' . esc_url( admin_url( 'customize.php?autofocus[section]=djfranco_analytics' ) ) . '">Paste your GA4 Measurement ID</a> to start tracking leads.</p></div>';
} );

/**
 * Bootstrap the site's pages on theme activation.
 *
 * Mirrors djfrancolive.com's structure (About, Mixes, Booking, Gallery,
 * Press/EPK, Contact). If a page with the slug already exists it is left
 * alone — only the template assignment is added/refreshed. Also assigns
 * a static front page once an "Home" page is present.
 */
add_action( 'after_switch_theme', 'djfranco_bootstrap_pages' );
function djfranco_bootstrap_pages() {
	$pages = [
		[ 'slug' => 'about',   'title' => 'About',       'template' => 'page-about',
		  'content' => "DJ Franco is a Tampa-based open-format DJ. Over a decade behind the decks across luxury weddings, brand activations, corporate galas, and arena game-days has sharpened a polished, high-energy style — built live, never pre-rendered. His sound fuses Afrobeats, Amapiano, Dancehall, Hip-Hop, R&B, and timeless classics into something at once luxurious and electrifying." ],
		[ 'slug' => 'mixes',   'title' => 'Mixes',       'template' => 'page-mixes',
		  'content' => "Recent mixes — Sunset Heat live from Bouzy in Hyde Park (Tampa), Open Format and Jersey Club, 989Jamz 4th of July Mix (Parts 1 &amp; 2), and a Smooth R&amp;B Mix. Built live, mixed open-format." ],
		[ 'slug' => 'booking', 'title' => 'Booking',     'template' => 'page-booking',
		  'content' => "Private events, luxury weddings, brand activations, arena game-days. Choose a package or request a custom quote. 25% retainer locks the date." ],
		[ 'slug' => 'gallery', 'title' => 'Gallery',     'template' => 'page-gallery',
		  'content' => "Selected work behind the decks — live sets, brand activations, weddings." ],
		[ 'slug' => 'press',   'title' => 'Press / EPK', 'template' => 'page-press',
		  'content' => "Electronic Press Kit — bio, photos, logos, and downloadable assets for press, venues, and brand partners." ],
		[ 'slug' => 'contact', 'title' => 'Contact',     'template' => 'page-contact',
		  'content' => "Tell me the date, venue, guest count, and vibe. Response within 24 hours. bookings@djfrancolive.com · (561) 294-3587 · Tampa, FL · Worldwide travel." ],
		[ 'slug' => 'home',    'title' => 'Home',        'template' => 'front-page',
		  'content' => "" ],
	];

	$home_id = 0;
	$blog_id = 0;

	foreach ( $pages as $page ) {
		$existing = get_page_by_path( $page['slug'] );
		if ( $existing instanceof WP_Post ) {
			$page_id = $existing->ID;
		} else {
			$page_id = wp_insert_post( [
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => $page['title'],
				'post_name'    => $page['slug'],
				'post_content' => $page['content'],
			] );
		}

		if ( $page_id && ! is_wp_error( $page_id ) ) {
			update_post_meta( $page_id, '_wp_page_template', $page['template'] );
			if ( 'home' === $page['slug'] ) {
				$home_id = $page_id;
			}
		}
	}

	// Create a "Blog" page for posts if missing, then wire Reading settings.
	$blog = get_page_by_path( 'blog' );
	if ( $blog instanceof WP_Post ) {
		$blog_id = $blog->ID;
	} else {
		$blog_id = wp_insert_post( [
			'post_type'   => 'page',
			'post_status' => 'publish',
			'post_title'  => 'Blog',
			'post_name'   => 'blog',
		] );
	}

	if ( $home_id ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
		if ( $blog_id && ! is_wp_error( $blog_id ) ) {
			update_option( 'page_for_posts', $blog_id );
		}
	}

	// Primary nav menu — create + assign if missing.
	$menu_name = 'Primary';
	$menu = wp_get_nav_menu_object( $menu_name );
	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $menu_name );
		if ( ! is_wp_error( $menu_id ) ) {
			$nav_items = [
				[ 'title' => 'Home',    'slug' => 'home' ],
				[ 'title' => 'About',   'slug' => 'about' ],
				[ 'title' => 'Mixes',   'slug' => 'mixes' ],
				[ 'title' => 'Booking', 'slug' => 'booking' ],
				[ 'title' => 'Gallery', 'slug' => 'gallery' ],
				[ 'title' => 'EPK',     'slug' => 'press' ],
				[ 'title' => 'Contact', 'slug' => 'contact' ],
			];
			foreach ( $nav_items as $item ) {
				$p = get_page_by_path( $item['slug'] );
				if ( $p instanceof WP_Post ) {
					wp_update_nav_menu_item( $menu_id, 0, [
						'menu-item-title'     => $item['title'],
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $p->ID,
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
					] );
				}
			}
			$locations = get_theme_mod( 'nav_menu_locations', [] );
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}
}

/**
 * Allow the bootstrap to also run when the theme files have just been
 * deployed onto an already-active theme (e.g. SFTP push). Runs once.
 */
add_action( 'init', function () {
	if ( get_option( 'djfranco_bootstrapped' ) === DJFRANCO_VERSION . '.2' ) {
		return;
	}
	djfranco_bootstrap_pages();
	update_option( 'djfranco_bootstrapped', DJFRANCO_VERSION . '.2' );
}, 99 );

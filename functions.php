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

define( 'DJFRANCO_VERSION', '1.0.4' );
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

/* ============================================================
 * Custom Post Type: Mix
 * ----------------------------------------------------------------
 * Each mix is a post in WP admin → "Mixes" so you can add / edit /
 * reorder from your phone's browser. Fields per mix:
 *   - Title              (post title)
 *   - Subtitle           (post excerpt) — the small description
 *   - SoundCloud URL     (custom field: djfranco_soundcloud_url)
 *   - Mixcloud/Spotify URL (optional: djfranco_alt_url)
 *   - Length             (custom field: djfranco_length, e.g. "78 min")
 *   - Plays              (custom field: djfranco_plays, e.g. "12.4k")
 *   - Tags               (built-in tags)
 *   - Featured image     (cover art — falls back to gradient if none)
 * ============================================================ */
add_action( 'init', function () {
	register_post_type( 'djf_mix', [
		'labels' => [
			'name'               => __( 'Mixes', 'djfranco' ),
			'singular_name'      => __( 'Mix', 'djfranco' ),
			'add_new'            => __( 'Add New Mix', 'djfranco' ),
			'add_new_item'       => __( 'Add New Mix', 'djfranco' ),
			'edit_item'          => __( 'Edit Mix', 'djfranco' ),
			'new_item'           => __( 'New Mix', 'djfranco' ),
			'view_item'          => __( 'View Mix', 'djfranco' ),
			'search_items'       => __( 'Search Mixes', 'djfranco' ),
			'not_found'          => __( 'No mixes yet — add your first one.', 'djfranco' ),
			'menu_name'          => __( 'Mixes', 'djfranco' ),
		],
		'public'              => true,
		'show_in_rest'        => true,
		'has_archive'         => false,
		'rewrite'             => [ 'slug' => 'mix' ],
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-audio',
		'supports'            => [ 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ],
		'taxonomies'          => [ 'post_tag' ],
	] );
} );

/**
 * Mix meta box — SoundCloud URL, length, plays.
 */
add_action( 'add_meta_boxes', function () {
	add_meta_box(
		'djf_mix_details',
		__( 'Mix Details', 'djfranco' ),
		'djfranco_mix_meta_box',
		'djf_mix',
		'normal',
		'high'
	);
} );

function djfranco_mix_meta_box( $post ) {
	wp_nonce_field( 'djfranco_mix_save', 'djfranco_mix_nonce' );
	$audio = get_post_meta( $post->ID, 'djfranco_audio_url',      true );
	$sc    = get_post_meta( $post->ID, 'djfranco_soundcloud_url', true );
	$alt   = get_post_meta( $post->ID, 'djfranco_alt_url',        true );
	$len   = get_post_meta( $post->ID, 'djfranco_length',         true );
	$plays = get_post_meta( $post->ID, 'djfranco_plays',          true );
	$media_url = admin_url( 'upload.php?mode=list&attachment-filter=post_mime_type:audio' );
	?>
	<p>
		<label style="display:block;font-weight:600;margin-bottom:4px;">Audio file URL (.mp3, .m4a, .wav)</label>
		<input type="url" name="djfranco_audio_url" id="djfranco_audio_url" value="<?php echo esc_attr( $audio ); ?>" style="width:calc(100% - 200px); margin-right: 8px;" placeholder="https://djfrancolive.com/wp-content/uploads/.../your-mix.mp3" />
		<button type="button" class="button" id="djfranco_pick_audio">Choose from Media Library</button>
		<br><span class="description">If set, the card's play button plays inline. Find your existing audio at <a href="<?php echo esc_url( $media_url ); ?>" target="_blank">Media Library → Audio</a>.</span>
	</p>
	<p>
		<label style="display:block;font-weight:600;margin-bottom:4px;">SoundCloud URL (optional fallback)</label>
		<input type="url" name="djfranco_soundcloud_url" value="<?php echo esc_attr( $sc ); ?>" style="width:100%;" placeholder="https://soundcloud.com/djfrancolive/your-mix" />
		<span class="description">Used only when the audio file URL above is empty.</span>
	</p>
	<p>
		<label style="display:block;font-weight:600;margin-bottom:4px;">Alternate URL (optional)</label>
		<input type="url" name="djfranco_alt_url" value="<?php echo esc_attr( $alt ); ?>" style="width:100%;" placeholder="https://www.mixcloud.com/... or Spotify, YouTube, etc." />
	</p>
	<p style="display:flex;gap:1rem;">
		<span style="flex:1;">
			<label style="display:block;font-weight:600;margin-bottom:4px;">Length</label>
			<input type="text" name="djfranco_length" value="<?php echo esc_attr( $len ); ?>" style="width:100%;" placeholder="78 min" />
		</span>
		<span style="flex:1;">
			<label style="display:block;font-weight:600;margin-bottom:4px;">Plays</label>
			<input type="text" name="djfranco_plays" value="<?php echo esc_attr( $plays ); ?>" style="width:100%;" placeholder="12.4k plays" />
		</span>
	</p>
	<script>
	(function(){
		var btn = document.getElementById('djfranco_pick_audio');
		var input = document.getElementById('djfranco_audio_url');
		if (!btn || !input || typeof wp === 'undefined' || !wp.media) return;
		btn.addEventListener('click', function(e){
			e.preventDefault();
			var frame = wp.media({ title: 'Choose mix audio', library: { type: 'audio' }, button: { text: 'Use this audio' }, multiple: false });
			frame.on('select', function(){
				var att = frame.state().get('selection').first().toJSON();
				input.value = att.url;
			});
			frame.open();
		});
	})();
	</script>
	<?php
}

add_action( 'save_post_djf_mix', function ( $post_id ) {
	if ( ! isset( $_POST['djfranco_mix_nonce'] ) || ! wp_verify_nonce( $_POST['djfranco_mix_nonce'], 'djfranco_mix_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( [ 'djfranco_audio_url', 'djfranco_soundcloud_url', 'djfranco_alt_url', 'djfranco_length', 'djfranco_plays' ] as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
} );

/* ============================================================
 * Custom Post Type: Kit File (EPK downloads)
 * ----------------------------------------------------------------
 * Each kit file is a post under wp-admin → Kit Files. Fields:
 *   - Title              (e.g. "Full EPK", "Press Portrait 01")
 *   - Excerpt            short description shown under the title
 *   - File URL           media library pick (PDF, PNG, ZIP, …)
 *   - File type label    e.g. ".pdf · 12 pages"
 *   - File size          e.g. "3.4 MB"
 *   - Order              the EPK lives at #1 via menu_order=1
 * ============================================================ */
add_action( 'init', function () {
	register_post_type( 'djf_kit', [
		'labels' => [
			'name'          => __( 'Kit Files', 'djfranco' ),
			'singular_name' => __( 'Kit File', 'djfranco' ),
			'add_new_item'  => __( 'Add Kit File', 'djfranco' ),
			'edit_item'     => __( 'Edit Kit File', 'djfranco' ),
			'menu_name'     => __( 'Kit Files', 'djfranco' ),
			'not_found'     => __( 'No kit files yet — add your EPK first.', 'djfranco' ),
		],
		'public'        => false,
		'show_ui'       => true,
		'show_in_rest'  => true,
		'menu_position' => 6,
		'menu_icon'     => 'dashicons-download',
		'supports'      => [ 'title', 'excerpt', 'page-attributes' ],
	] );
} );

add_action( 'add_meta_boxes', function () {
	add_meta_box( 'djf_kit_details', __( 'Kit File Details', 'djfranco' ), 'djfranco_kit_meta_box', 'djf_kit', 'normal', 'high' );
} );

function djfranco_kit_meta_box( $post ) {
	wp_nonce_field( 'djfranco_kit_save', 'djfranco_kit_nonce' );
	$url   = get_post_meta( $post->ID, 'djfranco_file_url',  true );
	$label = get_post_meta( $post->ID, 'djfranco_file_label', true );
	$size  = get_post_meta( $post->ID, 'djfranco_file_size', true );
	?>
	<p>
		<label style="display:block;font-weight:600;margin-bottom:4px;">File URL</label>
		<input type="url" id="djfranco_file_url" name="djfranco_file_url" value="<?php echo esc_attr( $url ); ?>" style="width:calc(100% - 200px); margin-right: 8px;" placeholder="https://djfrancolive.com/wp-content/uploads/…/your-epk.pdf" />
		<button type="button" class="button" id="djfranco_pick_file">Choose from Media Library</button>
		<br><span class="description">Upload your EPK PDF via Media Library, then pick it here.</span>
	</p>
	<p style="display:flex;gap:1rem;">
		<span style="flex:1;">
			<label style="display:block;font-weight:600;margin-bottom:4px;">Type label</label>
			<input type="text" name="djfranco_file_label" value="<?php echo esc_attr( $label ); ?>" style="width:100%;" placeholder=".pdf · 12 pages" />
		</span>
		<span style="flex:1;">
			<label style="display:block;font-weight:600;margin-bottom:4px;">File size</label>
			<input type="text" name="djfranco_file_size" value="<?php echo esc_attr( $size ); ?>" style="width:100%;" placeholder="3.4 MB" />
		</span>
	</p>
	<script>
	(function(){
		var btn = document.getElementById('djfranco_pick_file');
		var input = document.getElementById('djfranco_file_url');
		if (!btn || !input || typeof wp === 'undefined' || !wp.media) return;
		btn.addEventListener('click', function(e){
			e.preventDefault();
			var frame = wp.media({ title: 'Choose kit file', button: { text: 'Use this file' }, multiple: false });
			frame.on('select', function(){
				var att = frame.state().get('selection').first().toJSON();
				input.value = att.url;
			});
			frame.open();
		});
	})();
	</script>
	<?php
}

add_action( 'save_post_djf_kit', function ( $post_id ) {
	if ( ! isset( $_POST['djfranco_kit_nonce'] ) || ! wp_verify_nonce( $_POST['djfranco_kit_nonce'], 'djfranco_kit_save' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	foreach ( [ 'djfranco_file_url', 'djfranco_file_label', 'djfranco_file_size' ] as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
} );

function djfranco_get_kit_files() {
	$q = new WP_Query( [
		'post_type'      => 'djf_kit',
		'post_status'    => 'publish',
		'orderby'        => [ 'menu_order' => 'ASC', 'date' => 'DESC' ],
		'posts_per_page' => -1,
	] );
	$out = [];
	foreach ( $q->posts as $p ) {
		$out[] = [
			'title' => get_the_title( $p ),
			'sub'   => $p->post_excerpt,
			'url'   => get_post_meta( $p->ID, 'djfranco_file_url',  true ),
			'label' => get_post_meta( $p->ID, 'djfranco_file_label', true ),
			'size'  => get_post_meta( $p->ID, 'djfranco_file_size', true ),
		];
	}
	return $out;
}

/* ============================================================
 * Custom Post Type: Gallery Item
 * ----------------------------------------------------------------
 * Each gallery item is a post under wp-admin → Gallery. Fields:
 *   - Title              (hover label)
 *   - Media URL          (image OR video — picker filters to both)
 *   - Span class         (grid layout tile size)
 *   - Background position (optional)
 *   - menu_order         (display order, drag to reorder via "Order" field)
 * Videos (.mp4/.webm/.mov) auto-render as muted autoplay loops.
 * ============================================================ */
add_action( 'init', function () {
	register_post_type( 'djf_gallery', [
		'labels' => [
			'name'          => __( 'Gallery', 'djfranco' ),
			'singular_name' => __( 'Gallery Item', 'djfranco' ),
			'add_new_item'  => __( 'Add Gallery Item', 'djfranco' ),
			'edit_item'     => __( 'Edit Gallery Item', 'djfranco' ),
			'menu_name'     => __( 'Gallery', 'djfranco' ),
			'not_found'     => __( 'No gallery items yet.', 'djfranco' ),
		],
		'public'        => false,
		'show_ui'       => true,
		'show_in_rest'  => true,
		'menu_position' => 7,
		'menu_icon'     => 'dashicons-format-gallery',
		'supports'      => [ 'title', 'page-attributes' ],
	] );
} );

add_action( 'add_meta_boxes', function () {
	add_meta_box( 'djf_gallery_details', __( 'Gallery Item Details', 'djfranco' ), 'djfranco_gallery_meta_box', 'djf_gallery', 'normal', 'high' );
} );

function djfranco_gallery_meta_box( $post ) {
	wp_nonce_field( 'djfranco_gallery_save', 'djfranco_gallery_nonce' );
	$url  = get_post_meta( $post->ID, 'djfranco_media_url', true );
	$span = get_post_meta( $post->ID, 'djfranco_span',      true ) ?: 'span-4-2';
	$pos  = get_post_meta( $post->ID, 'djfranco_bg_pos',    true );
	$spans = [
		'span-6-2' => 'Wide (6 cols × 2 rows) — big feature',
		'span-8-2' => 'Extra wide (8 × 2)',
		'span-4-2' => 'Tall (4 × 2)',
		'span-3-2' => 'Tall narrow (3 × 2)',
		'span-4-1' => 'Wide short (4 × 1)',
		'span-3-1' => 'Square (3 × 1)',
	];
	?>
	<p>
		<label style="display:block;font-weight:600;margin-bottom:4px;">Media URL (image or video)</label>
		<input type="url" id="djfranco_media_url" name="djfranco_media_url" value="<?php echo esc_attr( $url ); ?>" style="width:calc(100% - 220px); margin-right: 8px;" placeholder="https://djfrancolive.com/wp-content/uploads/…/photo.jpg" />
		<button type="button" class="button" id="djfranco_pick_media">Choose from Media Library</button>
		<br><span class="description">Images (.jpg/.png/.webp) → still tile. Videos (.mp4/.webm/.mov) → silent autoplay loop.</span>
	</p>
	<p style="display:flex; gap: 1rem;">
		<span style="flex: 2;">
			<label style="display:block;font-weight:600;margin-bottom:4px;">Tile size</label>
			<select name="djfranco_span" style="width:100%;">
				<?php foreach ( $spans as $val => $label ) : ?>
					<option value="<?php echo esc_attr( $val ); ?>" <?php selected( $span, $val ); ?>><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</span>
		<span style="flex: 1;">
			<label style="display:block;font-weight:600;margin-bottom:4px;">Image position (optional)</label>
			<input type="text" name="djfranco_bg_pos" value="<?php echo esc_attr( $pos ); ?>" style="width:100%;" placeholder="center 20%" />
		</span>
	</p>
	<script>
	(function(){
		var btn = document.getElementById('djfranco_pick_media');
		var input = document.getElementById('djfranco_media_url');
		if (!btn || !input || typeof wp === 'undefined' || !wp.media) return;
		btn.addEventListener('click', function(e){
			e.preventDefault();
			var frame = wp.media({ title: 'Choose gallery media', library: { type: ['image','video'] }, button: { text: 'Use this media' }, multiple: false });
			frame.on('select', function(){
				var att = frame.state().get('selection').first().toJSON();
				input.value = att.url;
			});
			frame.open();
		});
	})();
	</script>
	<?php
}

add_action( 'save_post_djf_gallery', function ( $post_id ) {
	if ( ! isset( $_POST['djfranco_gallery_nonce'] ) || ! wp_verify_nonce( $_POST['djfranco_gallery_nonce'], 'djfranco_gallery_save' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	foreach ( [ 'djfranco_media_url', 'djfranco_span', 'djfranco_bg_pos' ] as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
} );

function djfranco_get_gallery() {
	$q = new WP_Query( [
		'post_type'      => 'djf_gallery',
		'post_status'    => 'publish',
		'orderby'        => [ 'menu_order' => 'ASC', 'date' => 'ASC' ],
		'posts_per_page' => -1,
	] );
	$out = [];
	foreach ( $q->posts as $p ) {
		$url = get_post_meta( $p->ID, 'djfranco_media_url', true );
		if ( ! $url ) continue;
		$ext = strtolower( pathinfo( wp_parse_url( $url, PHP_URL_PATH ), PATHINFO_EXTENSION ) );
		$is_video = in_array( $ext, [ 'mp4', 'webm', 'mov', 'm4v' ], true );
		$out[] = [
			'title'    => get_the_title( $p ),
			'url'      => $url,
			'span'     => get_post_meta( $p->ID, 'djfranco_span',  true ) ?: 'span-4-2',
			'pos'      => get_post_meta( $p->ID, 'djfranco_bg_pos', true ),
			'is_video' => $is_video,
		];
	}
	return $out;
}

/**
 * Helper used by the mix-grid pattern.
 * Returns an array of mix data shaped like the old JS array.
 * @param int|null $limit  Cap results; null = no cap.
 */
function djfranco_get_mixes( $limit = null ) {
	$args = [
		'post_type'      => 'djf_mix',
		'post_status'    => 'publish',
		'orderby'        => [ 'menu_order' => 'ASC', 'date' => 'DESC' ],
		'posts_per_page' => $limit ? (int) $limit : -1,
	];
	$q = new WP_Query( $args );
	$out = [];
	$i = 1;
	foreach ( $q->posts as $p ) {
		$audio = get_post_meta( $p->ID, 'djfranco_audio_url',      true );
		$sc    = get_post_meta( $p->ID, 'djfranco_soundcloud_url', true );
		$alt   = get_post_meta( $p->ID, 'djfranco_alt_url',        true );
		$out[] = [
			'id'      => $p->ID,
			'n'       => str_pad( (string) $i, 3, '0', STR_PAD_LEFT ),
			'title'   => get_the_title( $p ),
			'sub'     => $p->post_excerpt ?: wp_trim_words( wp_strip_all_tags( $p->post_content ), 18 ),
			'audio'   => $audio,
			'url'     => $sc ?: $alt ?: '#',
			'source'  => $audio ? 'Listen now' : ( $sc ? 'SoundCloud' : ( $alt ? 'Listen' : '' ) ),
			'length'  => get_post_meta( $p->ID, 'djfranco_length', true ),
			'plays'   => get_post_meta( $p->ID, 'djfranco_plays', true ),
			'date'    => get_the_date( 'M Y', $p ),
			'thumb'   => get_the_post_thumbnail_url( $p, 'large' ),
		];
		$i++;
	}
	return $out;
}

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

	// Seed Gallery — start with the existing photos so the page isn't empty.
	$existing_gallery = get_posts( [ 'post_type' => 'djf_gallery', 'posts_per_page' => 1, 'fields' => 'ids' ] );
	if ( empty( $existing_gallery ) ) {
		$theme_img = get_template_directory_uri() . '/assets/img';
		$tiles = [
			[ 'title' => 'Behind the decks',   'url' => $theme_img . '/franco-dj-1.jpg',       'span' => 'span-6-2', 'pos' => '' ],
			[ 'title' => 'Live set',           'url' => $theme_img . '/franco-dj-2.jpg',       'span' => 'span-3-2', 'pos' => '' ],
			[ 'title' => 'Portrait',           'url' => $theme_img . '/franco-official.jpg',   'span' => 'span-3-2', 'pos' => 'center 20%' ],
			[ 'title' => 'Mixing the night',   'url' => $theme_img . '/franco-dj-3.jpg',       'span' => 'span-4-1', 'pos' => '' ],
			[ 'title' => 'Booth detail',       'url' => $theme_img . '/franco-dj-4.jpg',       'span' => 'span-4-1', 'pos' => '' ],
			[ 'title' => 'On the floor',       'url' => $theme_img . '/franco-official-2.jpg', 'span' => 'span-4-1', 'pos' => 'center 20%' ],
			[ 'title' => 'Open-format energy', 'url' => $theme_img . '/franco-dj-1.jpg',       'span' => 'span-8-2', 'pos' => '' ],
			[ 'title' => 'In the mix',         'url' => $theme_img . '/franco-dj-2.jpg',       'span' => 'span-4-2', 'pos' => '' ],
			[ 'title' => 'Set in motion',      'url' => $theme_img . '/franco-dj-3.jpg',       'span' => 'span-3-1', 'pos' => '' ],
			[ 'title' => 'Reading the room',   'url' => $theme_img . '/franco-dj-4.jpg',       'span' => 'span-3-1', 'pos' => '' ],
			[ 'title' => 'DJ Franco · Tampa',  'url' => $theme_img . '/franco-official.jpg',   'span' => 'span-6-2', 'pos' => '' ],
		];
		$order = 1;
		foreach ( $tiles as $t ) {
			$gid = wp_insert_post( [
				'post_type'   => 'djf_gallery',
				'post_status' => 'publish',
				'post_title'  => $t['title'],
				'menu_order'  => $order++,
			] );
			if ( $gid && ! is_wp_error( $gid ) ) {
				update_post_meta( $gid, 'djfranco_media_url', $t['url'] );
				update_post_meta( $gid, 'djfranco_span',      $t['span'] );
				update_post_meta( $gid, 'djfranco_bg_pos',    $t['pos'] );
			}
		}
	}

	// Seed Kit Files — EPK at position #1 if none exist yet.
	$existing_kits = get_posts( [ 'post_type' => 'djf_kit', 'posts_per_page' => 1, 'fields' => 'ids' ] );
	if ( empty( $existing_kits ) ) {
		$kits = [
			[ 'title' => 'Full EPK',          'sub' => 'Bio, photos, press, technical rider — everything in one PDF.', 'label' => '.pdf',     'size' => '' ],
			[ 'title' => 'Press Portrait 01', 'sub' => 'Booth shot, vertical, color graded.',                          'label' => '.png',     'size' => '' ],
			[ 'title' => 'Press Portrait 02', 'sub' => 'Stage-side, horizontal, low-light.',                           'label' => '.png',     'size' => '' ],
			[ 'title' => 'Logo Pack',         'sub' => 'Full mark, monogram, wordmark. Light & dark.',                  'label' => '.svg + .png', 'size' => '' ],
			[ 'title' => 'Technical Rider',   'sub' => 'PA, mics, power, booth specs.',                                 'label' => '.pdf',     'size' => '' ],
			[ 'title' => 'Bios (EN / ES)',    'sub' => '50, 150, and 300-word versions.',                               'label' => '.txt',     'size' => '' ],
		];
		$order = 1;
		foreach ( $kits as $k ) {
			$kid = wp_insert_post( [
				'post_type'    => 'djf_kit',
				'post_status'  => 'publish',
				'post_title'   => $k['title'],
				'post_excerpt' => $k['sub'],
				'menu_order'   => $order++,
			] );
			if ( $kid && ! is_wp_error( $kid ) ) {
				update_post_meta( $kid, 'djfranco_file_label', $k['label'] );
				update_post_meta( $kid, 'djfranco_file_size',  $k['size'] );
			}
		}
	}

	// Seed initial mixes from djfrancolive.com if none exist yet.
	$existing_mixes = get_posts( [ 'post_type' => 'djf_mix', 'posts_per_page' => 1, 'fields' => 'ids' ] );
	if ( empty( $existing_mixes ) ) {
		$seeds = [
			[ 'title' => 'Sunset Heat — Live at Bouzy, Hyde Park', 'sub' => 'Live recording from Bouzy in Hyde Park, Tampa.', 'url' => 'https://soundcloud.com/djfrancolive', 'len' => '60 min', 'plays' => '' ],
			[ 'title' => 'Open Format & Jersey Club',              'sub' => 'High-energy open format meets Jersey club.',     'url' => 'https://soundcloud.com/djfrancolive', 'len' => '55 min', 'plays' => '' ],
			[ 'title' => '989Jamz 4th of July Mix · Part 1',       'sub' => 'On-air mix for 98.9 Jamz · Independence Day.',   'url' => 'https://soundcloud.com/djfrancolive', 'len' => '45 min', 'plays' => '' ],
			[ 'title' => '989Jamz 4th of July Mix · Part 2',       'sub' => 'Part 2 of the 98.9 Jamz Independence Day set.', 'url' => 'https://soundcloud.com/djfrancolive', 'len' => '45 min', 'plays' => '' ],
			[ 'title' => 'Smooth R&B Mix',                          'sub' => 'Slow burners and R&B classics.',                 'url' => 'https://soundcloud.com/djfrancolive', 'len' => '50 min', 'plays' => '' ],
		];
		$order = 1;
		foreach ( $seeds as $m ) {
			$mid = wp_insert_post( [
				'post_type'    => 'djf_mix',
				'post_status'  => 'publish',
				'post_title'   => $m['title'],
				'post_excerpt' => $m['sub'],
				'menu_order'   => $order++,
			] );
			if ( $mid && ! is_wp_error( $mid ) ) {
				update_post_meta( $mid, 'djfranco_soundcloud_url', $m['url'] );
				update_post_meta( $mid, 'djfranco_length',         $m['len'] );
				update_post_meta( $mid, 'djfranco_plays',          $m['plays'] );
			}
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
	if ( get_option( 'djfranco_bootstrapped' ) === DJFRANCO_VERSION . '.5' ) {
		return;
	}
	djfranco_bootstrap_pages();
	update_option( 'djfranco_bootstrapped', DJFRANCO_VERSION . '.5' );
}, 99 );

<?php
/**
 * Title: Featured Video
 * Slug: djfranco/video-feature
 * Categories: djfranco-section
 * Description: Embedded YouTube video. URL editable at Customize → Featured Video.
 */
$raw   = get_theme_mod( 'djfranco_featured_video_url',     'https://youtu.be/uCOR0RqwC7s' );
$embed = function_exists( 'djfranco_youtube_embed_url' ) ? djfranco_youtube_embed_url( $raw ) : '';
if ( ! $embed ) return; // hide section if no valid URL set

$eyebrow = get_theme_mod( 'djfranco_featured_video_eyebrow', 'Watch' );
$title   = get_theme_mod( 'djfranco_featured_video_title',   'Live cut.' );
?>
<!-- wp:html -->
<section class="djf-section djf-section--surface djfranco-reveal djf-video-feature">
  <div class="djf-container djf-container--wide">
    <div class="djf-section-head">
      <div class="djf-section-head__title">
        <?php if ( $eyebrow ) : ?><p class="djf-eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
        <?php if ( $title )   : ?><h2 class="djf-display djf-h-3xl"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
      </div>
    </div>
    <div class="djf-video-frame">
      <iframe
        src="<?php echo esc_url( $embed ); ?>?rel=0&modestbranding=1&playsinline=1"
        title="<?php echo esc_attr( $title ); ?>"
        loading="lazy"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        allowfullscreen
        referrerpolicy="strict-origin-when-cross-origin"></iframe>
    </div>
  </div>
</section>
<!-- /wp:html -->

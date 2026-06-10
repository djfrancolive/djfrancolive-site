<?php
/**
 * Title: Gallery Grid
 * Slug: djfranco/gallery-grid
 * Categories: djfranco-section
 * Description: Masonry gallery rendered from the Gallery CPT. Manage at wp-admin → Gallery.
 */
$tiles = function_exists( 'djfranco_get_gallery' ) ? djfranco_get_gallery() : [];
?>
<!-- wp:html -->
<section class="djf-section djfranco-reveal" style="padding-top:1rem;">
  <div class="djf-container djf-container--wide">
    <?php if ( empty( $tiles ) ) : ?>
      <p class="djf-muted">No gallery items yet. <?php if ( current_user_can( 'edit_posts' ) ) : ?><a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=djf_gallery' ) ); ?>">Add the first one →</a><?php endif; ?></p>
    <?php else : ?>
      <div class="djf-gallery">
        <?php foreach ( $tiles as $t ) :
          $span_class = esc_attr( $t['span'] );
          $label      = esc_attr( $t['title'] );
          if ( $t['is_video'] ) : ?>
            <div class="djf-gallery__item djf-gallery__item--video <?php echo $span_class; ?>" data-label="<?php echo $label; ?>">
              <video src="<?php echo esc_url( $t['url'] ); ?>" autoplay muted loop playsinline preload="metadata"></video>
            </div>
          <?php else :
            $style = "background-image:url('" . esc_url( $t['url'] ) . "')";
            if ( ! empty( $t['pos'] ) ) {
              $style .= "; background-position:" . esc_attr( $t['pos'] );
            }
          ?>
            <div class="djf-gallery__item <?php echo $span_class; ?>" style="<?php echo $style; ?>" data-label="<?php echo $label; ?>"></div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
<!-- /wp:html -->

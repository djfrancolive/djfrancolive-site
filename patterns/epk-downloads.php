<?php
/**
 * Title: EPK Downloads
 * Slug: djfranco/epk-downloads
 * Categories: djfranco-section
 * Description: Press kit asset grid rendered from the Kit Files CPT. Manage at wp-admin → Kit Files.
 */
$kits = function_exists( 'djfranco_get_kit_files' ) ? djfranco_get_kit_files() : [];
// "Full kit (.zip)" button — points at whichever kit file's title contains "full" or "all kit"/"bundle",
// otherwise falls back to the very first item (which the bootstrap reserves for the EPK).
$bundle_url = '';
foreach ( $kits as $k ) {
  if ( ! empty( $k['url'] ) && preg_match( '/full|all|bundle|kit/i', $k['title'] ) ) { $bundle_url = $k['url']; break; }
}
if ( ! $bundle_url && ! empty( $kits[0]['url'] ) ) { $bundle_url = $kits[0]['url']; }
?>
<!-- wp:html -->
<section class="djf-section djf-section--surface djfranco-reveal">
  <div class="djf-container djf-container--wide">
    <div class="djf-section-head">
      <div class="djf-section-head__title">
        <p class="djf-eyebrow">Downloads</p>
        <h2 class="djf-display djf-h-3xl">Kit files.</h2>
      </div>
      <?php if ( $bundle_url ) : ?>
        <a href="<?php echo esc_url( $bundle_url ); ?>" target="_blank" rel="noopener" class="djf-btn djf-btn--primary" download>Download EPK ↓</a>
      <?php endif; ?>
    </div>

    <?php if ( empty( $kits ) ) : ?>
      <p class="djf-muted">No kit files yet. <?php if ( current_user_can( 'edit_posts' ) ) : ?><a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=djf_kit' ) ); ?>">Add your EPK →</a><?php endif; ?></p>
    <?php else : ?>
      <div class="djf-epk-grid">
        <?php foreach ( $kits as $idx => $k ) :
          $has_file = ! empty( $k['url'] );
          $is_epk   = ( $idx === 0 );
        ?>
        <div class="djf-epk-card<?php echo $is_epk ? ' djf-epk-card--featured' : ''; ?>">
          <?php if ( $k['label'] ) : ?>
            <span class="djf-epk-card__ext"><?php echo esc_html( $k['label'] ); ?></span>
          <?php endif; ?>
          <h4 class="djf-epk-card__title"><?php echo esc_html( $k['title'] ); ?></h4>
          <?php if ( $k['sub'] ) : ?>
            <p class="djf-muted" style="font-size:.9rem; margin:0;"><?php echo esc_html( $k['sub'] ); ?></p>
          <?php endif; ?>
          <div class="djf-epk-card__meta">
            <span><?php echo esc_html( $k['size'] ?: ( $has_file ? '' : 'Awaiting upload' ) ); ?></span>
            <?php if ( $has_file ) : ?>
              <a class="djf-dl" href="<?php echo esc_url( $k['url'] ); ?>" target="_blank" rel="noopener" download>Download ↓</a>
            <?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
              <a class="djf-dl" href="<?php echo esc_url( admin_url( 'edit.php?post_type=djf_kit' ) ); ?>">Add file →</a>
            <?php else : ?>
              <span class="djf-muted" style="font-size:.78rem;">Coming soon</span>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
<!-- /wp:html -->

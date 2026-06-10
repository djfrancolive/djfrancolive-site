<?php
/**
 * Title: Mix Grid
 * Slug: djfranco/mix-grid
 * Categories: djfranco-section
 * Description: Mix cards rendered from the "Mixes" custom post type. Manage at wp-admin → Mixes.
 */

// Detect: is this the home featured-mixes section or the full /mixes/ page?
// Home shows 3 (featured); the mixes page shows all.
$is_home  = is_front_page() || is_home();
$limit    = $is_home ? 3 : null;
$mixes    = function_exists( 'djfranco_get_mixes' ) ? djfranco_get_mixes( $limit ) : [];
$show_all = ! $is_home;
?>
<!-- wp:html -->
<section class="djf-section djf-section--surface djfranco-reveal">
  <div class="djf-container djf-container--wide">
    <div class="djf-section-head">
      <div class="djf-section-head__title">
        <p class="djf-eyebrow">Listen</p>
        <h2 class="djf-display djf-h-3xl"><?php echo $show_all ? 'All mixes' : 'Featured mixes'; ?></h2>
      </div>
      <?php if ( ! $show_all ) : ?>
        <a href="/mixes/" class="djf-btn djf-btn--ghost">All mixes →</a>
      <?php endif; ?>
    </div>

    <?php if ( empty( $mixes ) ) : ?>
      <p class="djf-muted">No mixes yet. <?php if ( current_user_can( 'edit_posts' ) ) : ?><a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=djf_mix' ) ); ?>">Add the first one →</a><?php endif; ?></p>
    <?php else : ?>
      <div class="djf-mix-grid">
        <?php foreach ( $mixes as $i => $m ) :
          $art_style = $m['thumb']
            ? 'background-image:url(' . esc_url( $m['thumb'] ) . '); background-size:cover; background-position:center;'
            : '';
        ?>
        <article class="djf-mix-card" data-djf-mix-id="<?php echo esc_attr( $m['id'] ); ?>">
          <div class="djf-mix-card__art" style="<?php echo $art_style; ?>">
            <?php if ( ! $m['thumb'] ) : ?>
              <div class="djf-waveform" aria-hidden="true">
                <?php
                $seed = ( $i + 3 ) * 9301 + 49297;
                for ( $b = 0; $b < 60; $b++ ) {
                  $seed = ( $seed * 9301 + 49297 ) % 233280;
                  $h    = 20 + ( $seed % 75 );
                  echo '<i style="height:' . (int) $h . '%"></i>';
                }
                ?>
              </div>
            <?php endif; ?>
            <?php if ( ! empty( $m['audio'] ) ) : ?>
              <button type="button" class="djf-mix-card__play" data-djf-play="<?php echo esc_url( $m['audio'] ); ?>" aria-label="Play <?php echo esc_attr( $m['title'] ); ?>">▶</button>
            <?php else : ?>
              <a href="<?php echo esc_url( $m['url'] ); ?>" target="_blank" rel="noopener" class="djf-mix-card__play" aria-label="Open <?php echo esc_attr( $m['title'] ); ?>">▶</a>
            <?php endif; ?>
            <span class="djf-mix-card__num"><?php echo esc_html( $m['n'] ); ?></span>
          </div>
          <div class="djf-mix-card__body">
            <div class="djf-mix-card__meta">
              <?php if ( $m['source'] ) : ?>
                <span class="djf-mix-card__tag"><?php echo esc_html( $m['source'] ); ?></span>
              <?php endif; ?>
              <?php if ( $m['length'] ) : ?>
                <span class="djf-mix-card__tag"><?php echo esc_html( $m['length'] ); ?></span>
              <?php endif; ?>
            </div>
            <h3 class="djf-mix-card__title">
              <?php if ( ! empty( $m['audio'] ) ) : ?>
                <?php echo esc_html( $m['title'] ); ?>
              <?php else : ?>
                <a href="<?php echo esc_url( $m['url'] ); ?>" target="_blank" rel="noopener" style="color:inherit;text-decoration:none;"><?php echo esc_html( $m['title'] ); ?></a>
              <?php endif; ?>
            </h3>
            <?php if ( $m['sub'] ) : ?>
              <p class="djf-mix-card__sub"><?php echo esc_html( $m['sub'] ); ?></p>
            <?php endif; ?>
            <?php if ( ! empty( $m['audio'] ) ) : ?>
              <audio class="djf-mix-card__audio" preload="none" src="<?php echo esc_url( $m['audio'] ); ?>" aria-hidden="true"></audio>
            <?php endif; ?>
          </div>
          <div class="djf-mix-card__footer">
            <span><?php echo esc_html( $m['date'] ); ?></span>
            <?php if ( $m['plays'] ) : ?>
              <span class="djf-plays"><?php echo esc_html( $m['plays'] ); ?></span>
            <?php endif; ?>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
<!-- /wp:html -->

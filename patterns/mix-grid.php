<?php
/**
 * Title: Mix Grid
 * Slug: djfranco/mix-grid
 * Categories: djfranco-section
 * Description: Featured mixes grid — replace the embed URLs with your own SoundCloud / Mixcloud / Spotify tracks.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"djfranco-reveal","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained","wideSize":"1280px"}} -->
<section class="wp-block-group alignfull djfranco-reveal" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--40)">

  <!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap","verticalAlignment":"bottom"}} -->
  <div class="wp-block-group alignwide">
    <!-- wp:group {"layout":{"type":"default"}} -->
    <div class="wp-block-group">
      <!-- wp:paragraph {"className":"djfranco-eyebrow","style":{"typography":{"fontFamily":"var(--wp--preset--font-family--mono)","fontSize":"0.8rem","letterSpacing":"0.3em","textTransform":"uppercase"}},"textColor":"accent"} -->
      <p class="djfranco-eyebrow has-accent-color has-text-color" style="font-family:var(--wp--preset--font-family--mono);font-size:0.8rem;letter-spacing:0.3em;text-transform:uppercase">— Listen</p>
      <!-- /wp:paragraph -->
      <!-- wp:heading {"level":2,"style":{"typography":{"fontFamily":"var(--wp--preset--font-family--display)","fontSize":"var(--wp--preset--font-size--3xl)","textTransform":"uppercase","lineHeight":"0.95","fontWeight":"400"}}} -->
      <h2 class="wp-block-heading" style="font-family:var(--wp--preset--font-family--display);font-size:var(--wp--preset--font-size--3xl);font-weight:400;line-height:0.95;text-transform:uppercase">Featured mixes</h2>
      <!-- /wp:heading -->
    </div>
    <!-- /wp:group -->

    <!-- wp:buttons -->
    <div class="wp-block-buttons">
      <!-- wp:button {"className":"is-style-outline","textColor":"contrast","style":{"border":{"width":"1px","color":"#26262E","radius":"999px"},"color":{"background":"transparent"},"typography":{"fontSize":"0.8rem","letterSpacing":"0.14em"}}} -->
      <div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-contrast-color has-text-color has-background has-border-color wp-element-button" href="/mixes" style="border-color:#26262E;border-width:1px;border-radius:999px;background:transparent;font-size:0.8rem;letter-spacing:0.14em">All mixes →</a></div>
      <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
  </div>
  <!-- /wp:group -->

  <!-- wp:spacer {"height":"var:preset|spacing|40"} /-->

  <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
  <div class="wp-block-columns alignwide">

    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:group {"className":"djfranco-card","style":{"border":{"radius":"18px","color":"var:preset|color|line","width":"1px"},"spacing":{"padding":"var:preset|spacing|30"}},"backgroundColor":"surface","layout":{"type":"default"}} -->
      <div class="wp-block-card djfranco-card has-border-color has-surface-background-color has-background" style="border-color:var(--wp--preset--color--line);border-width:1px;border-radius:18px;padding:var(--wp--preset--spacing--30)">
        <!-- wp:embed {"url":"https://soundcloud.com/djfrancolive","type":"rich","providerNameSlug":"soundcloud","responsive":true,"className":"wp-embed-aspect-16-9 wp-has-aspect-ratio"} -->
        <figure class="wp-block-embed is-type-rich is-provider-soundcloud wp-block-embed-soundcloud wp-embed-aspect-16-9 wp-has-aspect-ratio"><div class="wp-block-embed__wrapper">https://soundcloud.com/djfrancolive</div></figure>
        <!-- /wp:embed -->
        <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"var(--wp--preset--font-size--lg)"},"spacing":{"margin":{"top":"1rem"}}}} -->
        <h3 class="wp-block-heading" style="margin-top:1rem;font-size:var(--wp--preset--font-size--lg)">Open Format Vol. 01</h3>
        <!-- /wp:heading -->
        <!-- wp:paragraph {"textColor":"muted","style":{"typography":{"fontSize":"0.9rem"}}} -->
        <p class="has-muted-color has-text-color" style="font-size:0.9rem">Peak-hour energy. Hip-hop × house × afrobeats.</p>
        <!-- /wp:paragraph -->
      </div>
      <!-- /wp:group -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:group {"className":"djfranco-card","style":{"border":{"radius":"18px","color":"var:preset|color|line","width":"1px"},"spacing":{"padding":"var:preset|spacing|30"}},"backgroundColor":"surface","layout":{"type":"default"}} -->
      <div class="wp-block-card djfranco-card has-border-color has-surface-background-color has-background" style="border-color:var(--wp--preset--color--line);border-width:1px;border-radius:18px;padding:var(--wp--preset--spacing--30)">
        <!-- wp:embed {"url":"https://www.mixcloud.com/djfrancolive/","type":"rich","providerNameSlug":"mixcloud","responsive":true,"className":"wp-embed-aspect-16-9 wp-has-aspect-ratio"} -->
        <figure class="wp-block-embed is-type-rich is-provider-mixcloud wp-block-embed-mixcloud wp-embed-aspect-16-9 wp-has-aspect-ratio"><div class="wp-block-embed__wrapper">https://www.mixcloud.com/djfrancolive/</div></figure>
        <!-- /wp:embed -->
        <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"var(--wp--preset--font-size--lg)"},"spacing":{"margin":{"top":"1rem"}}}} -->
        <h3 class="wp-block-heading" style="margin-top:1rem;font-size:var(--wp--preset--font-size--lg)">Wedding Showcase</h3>
        <!-- /wp:heading -->
        <!-- wp:paragraph {"textColor":"muted","style":{"typography":{"fontSize":"0.9rem"}}} -->
        <p class="has-muted-color has-text-color" style="font-size:0.9rem">How a reception is built track by track.</p>
        <!-- /wp:paragraph -->
      </div>
      <!-- /wp:group -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:group {"className":"djfranco-card","style":{"border":{"radius":"18px","color":"var:preset|color|line","width":"1px"},"spacing":{"padding":"var:preset|spacing|30"}},"backgroundColor":"surface","layout":{"type":"default"}} -->
      <div class="wp-block-card djfranco-card has-border-color has-surface-background-color has-background" style="border-color:var(--wp--preset--color--line);border-width:1px;border-radius:18px;padding:var(--wp--preset--spacing--30)">
        <!-- wp:embed {"url":"https://open.spotify.com/artist/","type":"rich","providerNameSlug":"spotify","responsive":true,"className":"wp-embed-aspect-16-9 wp-has-aspect-ratio"} -->
        <figure class="wp-block-embed is-type-rich is-provider-spotify wp-block-embed-spotify wp-embed-aspect-16-9 wp-has-aspect-ratio"><div class="wp-block-embed__wrapper">https://open.spotify.com/artist/</div></figure>
        <!-- /wp:embed -->
        <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"var(--wp--preset--font-size--lg)"},"spacing":{"margin":{"top":"1rem"}}}} -->
        <h3 class="wp-block-heading" style="margin-top:1rem;font-size:var(--wp--preset--font-size--lg)">Playlists</h3>
        <!-- /wp:heading -->
        <!-- wp:paragraph {"textColor":"muted","style":{"typography":{"fontSize":"0.9rem"}}} -->
        <p class="has-muted-color has-text-color" style="font-size:0.9rem">Spotify · curated by vibe, not genre.</p>
        <!-- /wp:paragraph -->
      </div>
      <!-- /wp:group -->
    </div>
    <!-- /wp:column -->

  </div>
  <!-- /wp:columns -->

</section>
<!-- /wp:group -->

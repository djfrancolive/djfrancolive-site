<?php
/**
 * Title: About Split
 * Slug: djfranco/about-split
 * Categories: djfranco-section
 * Description: Two-column about section: image left, copy + stats right.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"djfranco-reveal","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained","wideSize":"1280px"}} -->
<section class="wp-block-group alignfull djfranco-reveal" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--40)">

  <!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|60"}}}} -->
  <div class="wp-block-columns alignwide are-vertically-aligned-center">

    <!-- wp:column {"width":"45%","verticalAlignment":"center"} -->
    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
      <!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"20px"},"shadow":"var:preset|shadow|lg"},"className":"djfranco-image-tilt"} -->
      <figure class="wp-block-image size-large djfranco-image-tilt has-custom-border" style="border-radius:20px;box-shadow:var(--wp--preset--shadow--lg)"><img src="https://djfrancolive.com/wp-content/uploads/2023/04/DJFrancoLogo.png" alt="DJ Franco" style="border-radius:20px"/></figure>
      <!-- /wp:image -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column {"verticalAlignment":"center"} -->
    <div class="wp-block-column is-vertically-aligned-center">

      <!-- wp:paragraph {"className":"djfranco-eyebrow","style":{"typography":{"fontFamily":"var(--wp--preset--font-family--mono)","fontSize":"0.8rem","letterSpacing":"0.3em","textTransform":"uppercase"}},"textColor":"accent"} -->
      <p class="djfranco-eyebrow has-accent-color has-text-color" style="font-family:var(--wp--preset--font-family--mono);font-size:0.8rem;letter-spacing:0.3em;text-transform:uppercase">— About</p>
      <!-- /wp:paragraph -->

      <!-- wp:heading {"level":2,"style":{"typography":{"fontFamily":"var(--wp--preset--font-family--display)","fontSize":"var(--wp--preset--font-size--3xl)","textTransform":"uppercase","lineHeight":"0.95","fontWeight":"400"}}} -->
      <h2 class="wp-block-heading" style="font-family:var(--wp--preset--font-family--display);font-size:var(--wp--preset--font-size--3xl);font-weight:400;line-height:0.95;text-transform:uppercase">The set doesn't start when the music does — it starts when the room feels it.</h2>
      <!-- /wp:heading -->

      <!-- wp:paragraph {"textColor":"muted","style":{"typography":{"fontSize":"1.05rem","lineHeight":"1.7"},"spacing":{"margin":{"top":"1.25rem"}}}} -->
      <p class="has-muted-color has-text-color" style="margin-top:1.25rem;font-size:1.05rem;line-height:1.7">For more than a decade, DJ Franco has been reading dancefloors from weddings in ballrooms to festivals on main stages. Open-format, crate-deep, and relentlessly tuned to the crowd in front of him — every set is built live, never pre-rendered.</p>
      <!-- /wp:paragraph -->

      <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"2rem"}}}} -->
      <div class="wp-block-buttons" style="margin-top:2rem">
        <!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/about">Read the story</a></div><!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->

    </div>
    <!-- /wp:column -->

  </div>
  <!-- /wp:columns -->

</section>
<!-- /wp:group -->

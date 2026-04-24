<?php
/**
 * Title: Contact Form
 * Slug: djfranco/contact-form
 * Categories: djfranco-section
 * Description: Two-column contact: left info + right Contact Form 7 shortcode slot.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"djfranco-reveal","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained","wideSize":"1280px"}} -->
<section class="wp-block-group alignfull djfranco-reveal" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--40)">

  <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
  <div class="wp-block-columns alignwide">

    <!-- wp:column {"width":"40%"} -->
    <div class="wp-block-column" style="flex-basis:40%">
      <!-- wp:paragraph {"className":"djfranco-eyebrow","style":{"typography":{"fontFamily":"var(--wp--preset--font-family--mono)","fontSize":"0.8rem","letterSpacing":"0.3em","textTransform":"uppercase"}},"textColor":"accent"} --><p class="djfranco-eyebrow has-accent-color has-text-color" style="font-family:var(--wp--preset--font-family--mono);font-size:0.8rem;letter-spacing:0.3em;text-transform:uppercase">— Contact</p><!-- /wp:paragraph -->
      <!-- wp:heading {"level":2,"style":{"typography":{"fontFamily":"var(--wp--preset--font-family--display)","fontSize":"var(--wp--preset--font-size--3xl)","textTransform":"uppercase","lineHeight":"0.95","fontWeight":"400"}}} --><h2 class="wp-block-heading" style="font-family:var(--wp--preset--font-family--display);font-size:var(--wp--preset--font-size--3xl);font-weight:400;line-height:0.95;text-transform:uppercase">Tell me about your night.</h2><!-- /wp:heading -->
      <!-- wp:paragraph {"textColor":"muted","style":{"typography":{"fontSize":"1.05rem","lineHeight":"1.6"},"spacing":{"margin":{"top":"1.25rem"}}}} --><p class="has-muted-color has-text-color" style="margin-top:1.25rem;font-size:1.05rem;line-height:1.6">Date, venue, headcount, vibe — the more context, the better the pitch. I respond within 24 hours, usually faster.</p><!-- /wp:paragraph -->

      <!-- wp:spacer {"height":"var:preset|spacing|40"} /-->

      <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","letterSpacing":"0.18em","textTransform":"uppercase"}},"textColor":"muted"} --><p class="has-muted-color has-text-color" style="font-size:0.75rem;letter-spacing:0.18em;text-transform:uppercase">Email</p><!-- /wp:paragraph -->
      <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.1rem"}}} --><p style="font-size:1.1rem"><a href="mailto:djfrancolive@gmail.com">djfrancolive@gmail.com</a></p><!-- /wp:paragraph -->

      <!-- wp:spacer {"height":"var:preset|spacing|30"} /-->

      <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","letterSpacing":"0.18em","textTransform":"uppercase"}},"textColor":"muted"} --><p class="has-muted-color has-text-color" style="font-size:0.75rem;letter-spacing:0.18em;text-transform:uppercase">Follow</p><!-- /wp:paragraph -->
      <!-- wp:social-links {"iconColor":"contrast","iconColorValue":"#F5F5F7","openInNewTab":true,"className":"is-style-logos-only"} -->
      <ul class="wp-block-social-links has-icon-color is-style-logos-only">
        <!-- wp:social-link {"url":"#","service":"instagram"} /-->
        <!-- wp:social-link {"url":"#","service":"soundcloud"} /-->
        <!-- wp:social-link {"url":"#","service":"spotify"} /-->
        <!-- wp:social-link {"url":"#","service":"youtube"} /-->
      </ul>
      <!-- /wp:social-links -->

    </div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:group {"className":"djfranco-formwrap","style":{"border":{"radius":"18px","color":"var:preset|color|line","width":"1px"},"spacing":{"padding":"var:preset|spacing|50"}},"backgroundColor":"surface","layout":{"type":"default"}} -->
      <div class="wp-block-group djfranco-formwrap has-border-color has-surface-background-color has-background" style="border-color:var(--wp--preset--color--line);border-width:1px;border-radius:18px;padding:var(--wp--preset--spacing--50)">
        <!-- wp:shortcode -->
[contact-form-7 id="booking" title="Booking Inquiry"]
<!-- /wp:shortcode -->
        <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8rem"}},"textColor":"muted"} -->
        <p class="has-muted-color has-text-color" style="font-size:0.8rem">Replace the shortcode above with your Contact Form 7 form ID, e.g. <code>[contact-form-7 id="123"]</code>.</p>
        <!-- /wp:paragraph -->
      </div>
      <!-- /wp:group -->
    </div>
    <!-- /wp:column -->

  </div>
  <!-- /wp:columns -->

</section>
<!-- /wp:group -->

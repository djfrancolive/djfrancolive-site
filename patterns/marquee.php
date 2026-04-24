<?php
/**
 * Title: Marquee Ticker
 * Slug: djfranco/marquee
 * Categories: djfranco-section
 * Description: Infinite-scroll marquee with display text, separators, and accent color.
 * Keywords: marquee, ticker, motion
 */
?>
<!-- wp:html -->
<div class="djfranco-marquee" aria-hidden="true">
  <div class="djfranco-marquee__track">
    <?php
    $items = [ 'Book Now', 'Weddings', 'Clubs', 'Festivals', 'Corporate', 'Private Events', 'Mind Blowing Sets' ];
    $loop  = array_merge( $items, $items, $items );
    foreach ( $loop as $label ) : ?>
      <span class="djfranco-marquee__item"><?php echo esc_html( $label ); ?></span>
      <span class="djfranco-marquee__dot">●</span>
    <?php endforeach; ?>
  </div>
</div>
<!-- /wp:html -->

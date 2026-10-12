<?php
/**
 * Title: Home Hero
 * Slug: djfranco/hero-home
 * Categories: djfranco-hero
 * Description: Full-bleed home hero with portrait, status pulse, display type.
 * Keywords: hero, home, headline
 * Viewport Width: 1440
 */
$portrait = esc_url( get_template_directory_uri() . '/assets/img/franco-official.jpg' );
?>
<!-- wp:html -->
<section class="djf-hero djfranco-reveal" aria-label="DJ Franco — Live">
  <div class="djf-hero__portrait" aria-hidden="true" style="background-image:url('<?php echo $portrait; ?>');"></div>
  <div class="djf-hero__inner">
    <div>
      <span class="djf-hero__status"><span class="djf-pulse"></span>Booking 2026 · Select dates open · Travel-ready</span>
      <h1 class="djf-display djf-h-hero djf-hero__title">
        <span class="djf-visually-hidden">Tampa Wedding &amp; Event DJ &mdash; </span>
        <span>DJ Franco</span>
        <span class="djfranco-gradient-text">Live.</span>
      </h1>
      <p class="djf-hero__lede">
        <strong>Tampa open-format DJ &amp; MC</strong> for luxury weddings, brand activations, and private affairs.
        Afrobeats, Amapiano, Hip-Hop, R&amp;B, Dancehall &mdash; built live, never pre-rendered.
      </p>
      <div class="djf-hero__ctas">
        <a href="/book/" class="djf-btn djf-btn--primary"><span class="djf-btn__dot"></span>Book a Call</a>
        <a href="/press-kit/" class="djf-btn djf-btn--ghost">Press Kit</a>
      </div>
      <dl class="djf-hero__meta">
        <div><dt>Based</dt><dd>Tampa, FL</dd></div>
        <div><dt>Style</dt><dd>Open-Format · World Sounds</dd></div>
        <div><dt>Since</dt><dd>2016</dd></div>
        <div><dt>Travel</dt><dd>Worldwide</dd></div>
      </dl>
    </div>
  </div>
</section>
<!-- /wp:html -->

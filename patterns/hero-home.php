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
        <span>DJ Franco</span>
        <span class="djfranco-gradient-text">Live.</span>
      </h1>
      <p class="djf-hero__lede">
        There are people that play music — and there are DJs that <strong>blow minds</strong>.
        Tampa-based, open-format, and built for luxury weddings, brand activations, and private affairs.
      </p>
      <div class="djf-hero__ctas">
        <a href="/contact" class="djf-btn djf-btn--primary"><span class="djf-btn__dot"></span>Book a date</a>
        <a href="/mixes" class="djf-btn djf-btn--ghost">▶ Listen to mixes</a>
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

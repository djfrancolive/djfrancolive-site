<?php
/**
 * Title: Thank You — Cal.com + EPK CTA
 * Slug: djfranco/thank-you-cal
 * Categories: djfranco-section
 * Description: Post-form confirmation page with inline Cal.com booking + EPK download.
 */
?>
<!-- wp:html -->
<section class="djf-thankyou">
  <div class="djf-container djf-container--wide">
    <div class="djf-thankyou__head">
      <p class="djf-eyebrow">Got it</p>
      <h2 class="djf-display djf-h-3xl">You're in. 🎧</h2>
      <p class="djf-thankyou__lede">
        Franco personally reviews every inquiry within 24 hours.
        Want to lock in a 15-min discovery call right now?
      </p>
    </div>
    <div class="djf-cal-embed">
      <iframe src="https://cal.com/djfranco/discovery?embed=true"
              title="Book a 15-minute discovery call"
              loading="lazy"
              allow="camera; microphone; payment"
              allowfullscreen></iframe>
    </div>
    <div class="djf-thankyou__cta">
      <a href="/press/" class="djf-btn djf-btn--ghost">Download the EPK ↓</a>
      <a href="/mixes/" class="djf-btn djf-btn--ghost">▶ Listen to recent mixes</a>
    </div>
  </div>
</section>
<!-- /wp:html -->

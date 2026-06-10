<?php
/**
 * Title: About Split
 * Slug: djfranco/about-split
 * Categories: djfranco-section
 * Description: Two-column split: image left with color wash, copy right.
 */
$img = esc_url( get_template_directory_uri() . '/assets/img/franco-dj-1.jpg' );
?>
<!-- wp:html -->
<section class="djf-section djfranco-reveal">
  <div class="djf-container djf-container--wide">
    <div class="djf-split">
      <figure class="djf-split__figure" style="background-image:url('<?php echo $img; ?>'); background-position: center 22%;">
        <span class="djf-tag-badge">The booth · 2025</span>
      </figure>
      <div class="djf-split__body">
        <p class="djf-eyebrow">The artist</p>
        <h2 class="djf-display djf-h-2xl">A polished, global sound.</h2>
        <p>
          DJ Franco is a <strong>Tampa-based open-format DJ</strong> with a reputation for polished, high-energy
          performances and a global influence to every stage he touches. Over a decade behind the decks across
          luxury weddings, brand activations, corporate galas, and Gator Nation arenas has sharpened a style
          that's equal parts technical and emotional — built live, never pre-rendered.
        </p>
        <p>
          His sound fuses <strong>Afrobeats, Amapiano, Dancehall, Hip-Hop, and timeless classics</strong> into
          something at once luxurious and electrifying.
        </p>
        <div style="margin-top:1.75rem; display:flex; gap:.75rem; flex-wrap:wrap;">
          <a href="/about" class="djf-btn djf-btn--ghost">Full bio →</a>
          <a href="/press" class="djf-btn djf-btn--ghost">Download EPK</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /wp:html -->

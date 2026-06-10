<?php
/**
 * Title: Contact Form
 * Slug: djfranco/contact-form
 * Categories: djfranco-section
 * Description: Two-column contact: form-grid left, side info right.
 */
?>
<!-- wp:html -->
<section class="djf-section djfranco-reveal" style="padding-top:1rem;">
  <div class="djf-container">
    <div class="djf-contact-wrap">
      <form class="djf-form-grid" method="post" action="#">
        <div class="djf-field">
          <label for="djf-name">Your name</label>
          <input id="djf-name" name="name" type="text" placeholder="First &amp; last" required>
        </div>
        <div class="djf-field">
          <label for="djf-email">Email</label>
          <input id="djf-email" name="email" type="email" placeholder="you@somewhere.com" required>
        </div>
        <div class="djf-field">
          <label for="djf-date">Event date</label>
          <input id="djf-date" name="date" type="date">
        </div>
        <div class="djf-field">
          <label for="djf-type">Event type</label>
          <select id="djf-type" name="type">
            <option>Luxury wedding</option>
            <option>Private affair / birthday</option>
            <option>Brand activation / corporate</option>
            <option>Sports / arena</option>
            <option>Club / festival</option>
            <option>Other</option>
          </select>
        </div>
        <div class="djf-field djf-full">
          <label for="djf-venue">Venue &amp; city</label>
          <input id="djf-venue" name="venue" type="text" placeholder="Oxford Exchange, Tampa FL">
        </div>
        <div class="djf-field djf-full">
          <label for="djf-msg">Tell me about the night</label>
          <textarea id="djf-msg" name="message" placeholder="Guest count, hours, vibe, any must-plays…"></textarea>
        </div>
        <div class="djf-full" style="display:flex; align-items:center; gap:1rem; flex-wrap:wrap;">
          <button type="submit" class="djf-btn djf-btn--primary">Send inquiry</button>
          <p class="djf-muted" style="margin:0; font-size:.85rem;">Response within 24h · Mon–Sat</p>
        </div>
      </form>

      <aside class="djf-contact-side">
        <div class="djf-contact-side__block">
          <p class="djf-contact-side__label">Email</p>
          <p class="djf-contact-side__value"><a href="mailto:bookings@djfrancolive.com" style="color:var(--contrast)">bookings@djfrancolive.com</a></p>
        </div>
        <div class="djf-contact-side__block">
          <p class="djf-contact-side__label">Phone</p>
          <p class="djf-contact-side__value"><a href="tel:+15612943587" style="color:var(--contrast)">(561) 294-3587</a></p>
        </div>
        <div class="djf-contact-side__block">
          <p class="djf-contact-side__label">Based</p>
          <p class="djf-contact-side__value">Tampa, FL &middot; Worldwide travel</p>
        </div>
        <div class="djf-contact-side__block">
          <p class="djf-contact-side__label">Response time</p>
          <p class="djf-contact-side__value">Within 24 hours</p>
        </div>
        <div class="djf-contact-side__block">
          <p class="djf-contact-side__label">Follow</p>
          <div class="djf-socials" style="margin-top:.5rem;">
            <a href="https://www.instagram.com/francois561/" target="_blank" rel="noopener" aria-label="Instagram">IG</a>
            <a href="https://www.facebook.com/djfrancolive/" target="_blank" rel="noopener" aria-label="Facebook">FB</a>
            <a href="https://twitter.com/djfrancolive" target="_blank" rel="noopener" aria-label="Twitter">TW</a>
            <a href="https://soundcloud.com/djfrancolive" target="_blank" rel="noopener" aria-label="SoundCloud">SC</a>
            <a href="https://www.youtube.com/channel/UCv9q8QjpOsR_7xBMZH5NEvQ" target="_blank" rel="noopener" aria-label="YouTube">YT</a>
            <a href="https://twitch.tv/djfrancolive/home" target="_blank" rel="noopener" aria-label="Twitch">TV</a>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>
<!-- /wp:html -->

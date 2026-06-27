<?php
/**
 * Title: Book Form (Jotform 261647937338066)
 * Slug: djfranco/book-form
 * Categories: djfranco-section
 * Description: Booking inquiry form. Set Jotform's Thank You redirect to /thank-you/.
 */
?>
<!-- wp:html -->
<section class="djf-jotform-embed">
  <iframe id="JotFormIFrame-261647937338066"
          src="https://form.jotform.com/261647937338066"
          title="DJ Franco &mdash; Booking Inquiry"
          loading="lazy"
          allow="geolocation; microphone; camera; payment"
          allowfullscreen
          style="min-height:800px;"></iframe>
</section>
<script src="https://cdn.jotfor.ms/s/umd/latest/for-form-embed-handler.js"></script>
<script>
  window.jotformEmbedHandler && window.jotformEmbedHandler(
    "iframe[id='JotFormIFrame-261647937338066']",
    "https://form.jotform.com"
  );
</script>
<!-- /wp:html -->

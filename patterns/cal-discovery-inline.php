<?php
/**
 * Title: Cal.com Discovery (inline)
 * Slug: djfranco/cal-discovery-inline
 * Categories: djfranco-section
 * Description: Cal.com Discovery Call inline calendar (cal.com/djfrancolive/discovery). Snippet 1.
 */
?>
<!-- wp:html -->
<section class="djf-cal-section djfranco-reveal">
  <div class="djf-container djf-container--wide">
    <div class="djf-section-head">
      <div class="djf-section-head__title">
        <p class="djf-eyebrow">Or skip the form</p>
        <h2 class="djf-display djf-h-3xl">Grab a 15-min Discovery Call.</h2>
      </div>
    </div>
    <div class="djf-cal-embed" id="my-cal-inline-discovery"></div>
  </div>
</section>
<script type="text/javascript">
  (function (C, A, L) { let p = function (a, ar) { a.q.push(ar); }; let d = C.document; C.Cal = C.Cal || function () { let cal = C.Cal; let ar = arguments; if (!cal.loaded) { cal.ns = {}; cal.q = cal.q || []; d.head.appendChild(d.createElement("script")).src = A; cal.loaded = true; } if (ar[0] === L) { const api = function () { p(api, arguments); }; const namespace = ar[1]; api.q = api.q || []; if(typeof namespace === "string"){cal.ns[namespace] = cal.ns[namespace] || api;p(cal.ns[namespace], ar);p(cal, ["initNamespace", namespace]);} else p(cal, ar); return;} p(cal, ar); }; })(window, "https://app.cal.com/embed/embed.js", "init");
  Cal("init", "discovery", {origin:"https://app.cal.com"});
  Cal.config = Cal.config || {};
  Cal.config.forwardQueryParams = true;
  Cal.ns.discovery("inline", {
    elementOrSelector:"#my-cal-inline-discovery",
    config: {"layout":"month_view","useSlotsViewOnSmallScreen":"true"},
    calLink: "djfrancolive/discovery",
  });
  Cal.ns.discovery("ui", {"cssVarsPerTheme":{"light":{"cal-brand":"#292929"},"dark":{"cal-brand":"#A47148"}},"hideEventTypeDetails":false,"layout":"month_view"});
</script>
<!-- /wp:html -->

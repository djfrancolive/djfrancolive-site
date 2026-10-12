<?php
/**
 * Title: Booking FAQ
 * Slug: djfranco/booking-faq
 * Categories: djfranco-section
 * Description: FAQ accordion for /booking/ — also outputs FAQPage JSON-LD for rich-result eligibility.
 */
$faqs = [
	[
		'q' => 'How far do you travel?',
		'a' => 'Tampa Bay is home base, but DJ Franco regularly plays St. Petersburg, Clearwater, Sarasota, Orlando, South Florida, and destination events worldwide. Travel beyond Tampa Bay is quoted separately based on distance and overnight requirements.',
	],
	[
		'q' => 'Are you insured?',
		'a' => 'Yes — $1,000,000 general liability. A Certificate of Insurance (COI) naming your venue as additional insured is provided on request at no extra cost.',
	],
	[
		'q' => 'Do you MC?',
		'a' => 'Yes. MC services are included in the Luxury Wedding package and available as an add-on for Private Event and Brand & Arena packages. Timeline cues, introductions, and announcements are rehearsed in your planning session before the event.',
	],
	[
		'q' => 'What is the retainer?',
		'a' => 'A 50% retainer locks your date. The contract is signed digitally and the balance is due 14 days before the event. Dates aren\'t held without a signed contract and retainer.',
	],
	[
		'q' => 'How early do you arrive?',
		'a' => 'Standard arrival is two hours before guests for setup and sound check. For venues with early access windows (Oxford Exchange, JW Marriott Water Street, etc.) arrival is coordinated with your coordinator so the room is ready before cocktail hour.',
	],
	[
		'q' => 'Do you take requests?',
		'a' => 'Yes — and no. During planning you provide a must-play list, a do-not-play list, and preferred genres. Live requests from the floor are honored when they match the energy and don\'t clear it. The booth never becomes a jukebox.',
	],
	[
		'q' => 'What music genres do you specialize in?',
		'a' => 'Open-format: Afrobeats, Amapiano, Hip-Hop, R&B, Dancehall, Soca, Jersey Club, House, Latin, and timeless classics. The style is luxury-wedding-polished with brand-activation energy.',
	],
];
?>
<!-- wp:html -->
<section class="djf-section djf-section--surface djfranco-reveal">
  <div class="djf-container djf-container--wide">
    <div class="djf-section-head">
      <div class="djf-section-head__title">
        <p class="djf-eyebrow">FAQ</p>
        <h2 class="djf-display djf-h-3xl">Questions, answered.</h2>
      </div>
    </div>
    <div class="djf-faq">
      <?php foreach ( $faqs as $i => $faq ) : ?>
        <details class="djf-faq__item"<?php echo $i === 0 ? ' open' : ''; ?>>
          <summary class="djf-faq__q"><?php echo esc_html( $faq['q'] ); ?></summary>
          <div class="djf-faq__a"><p><?php echo esc_html( $faq['a'] ); ?></p></div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<script type="application/ld+json"><?php
echo wp_json_encode( [
	'@context' => 'https://schema.org',
	'@type'    => 'FAQPage',
	'mainEntity' => array_map( function ( $f ) {
		return [
			'@type' => 'Question',
			'name'  => $f['q'],
			'acceptedAnswer' => [
				'@type' => 'Answer',
				'text'  => $f['a'],
			],
		];
	}, $faqs ),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
?></script>
<!-- /wp:html -->

<?php
/**
 * Title: Gallery Grid
 * Slug: djfranco/gallery-grid
 * Categories: djfranco-section
 * Description: 12-col masonry gallery with hover labels. Update image URLs via media library.
 */
$img_base = get_template_directory_uri() . '/assets/img';
// Fallback to existing site media if theme images are missing.
$tiles = [
  [ 'img' => $img_base . '/franco-dj-1.jpg',          'span' => 'span-6-2', 'label' => 'Behind the decks',                'pos' => '' ],
  [ 'img' => $img_base . '/franco-dj-2.jpg',          'span' => 'span-3-2', 'label' => 'Live set',                        'pos' => '' ],
  [ 'img' => $img_base . '/franco-official.jpg',      'span' => 'span-3-2', 'label' => 'Portrait',                        'pos' => 'center 20%' ],
  [ 'img' => $img_base . '/franco-dj-3.jpg',          'span' => 'span-4-1', 'label' => 'Mixing the night',                'pos' => '' ],
  [ 'img' => $img_base . '/franco-dj-4.jpg',          'span' => 'span-4-1', 'label' => 'Booth detail',                    'pos' => '' ],
  [ 'img' => $img_base . '/franco-official-2.jpg',    'span' => 'span-4-1', 'label' => 'On the floor',                    'pos' => 'center 20%' ],
  [ 'img' => $img_base . '/franco-dj-1.jpg',          'span' => 'span-8-2', 'label' => 'Open-format energy',              'pos' => '' ],
  [ 'img' => $img_base . '/franco-dj-2.jpg',          'span' => 'span-4-2', 'label' => 'In the mix',                      'pos' => '' ],
  [ 'img' => $img_base . '/franco-dj-3.jpg',          'span' => 'span-3-1', 'label' => 'Set in motion',                   'pos' => '' ],
  [ 'img' => $img_base . '/franco-dj-4.jpg',          'span' => 'span-3-1', 'label' => 'Reading the room',                'pos' => '' ],
  [ 'img' => $img_base . '/franco-official.jpg',      'span' => 'span-6-2', 'label' => 'DJ Franco · Tampa',               'pos' => '' ],
];
?>
<!-- wp:html -->
<section class="djf-section djfranco-reveal" style="padding-top:1rem;">
  <div class="djf-container djf-container--wide">
    <div class="djf-gallery">
      <?php foreach ( $tiles as $t ) :
        $style = "background-image:url('" . esc_url( $t['img'] ) . "')";
        if ( ! empty( $t['pos'] ) ) $style .= "; background-position:" . esc_attr( $t['pos'] );
      ?>
        <div class="djf-gallery__item <?php echo esc_attr( $t['span'] ); ?>" style="<?php echo $style; ?>" data-label="<?php echo esc_attr( $t['label'] ); ?>"></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- /wp:html -->

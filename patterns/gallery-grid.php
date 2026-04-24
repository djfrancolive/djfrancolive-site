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
  [ 'img' => $img_base . '/franco-live-1.jpg',        'span' => 'span-6-2', 'label' => 'Florida Gators Basketball · Gainesville', 'pos' => '' ],
  [ 'img' => $img_base . '/franco-dj-1.jpg',          'span' => 'span-3-2', 'label' => 'Armature Works · Tampa',         'pos' => '' ],
  [ 'img' => $img_base . '/franco-clean-2.jpg',       'span' => 'span-3-2', 'label' => 'Studio · Edit session',           'pos' => '' ],
  [ 'img' => $img_base . '/franco-dj-2.jpg',          'span' => 'span-4-1', 'label' => 'Crowd · peak hour',               'pos' => '' ],
  [ 'img' => $img_base . '/franco-pro-2.jpg',         'span' => 'span-4-1', 'label' => 'Booth detail',                    'pos' => '' ],
  [ 'img' => $img_base . '/franco-official-2.jpg',    'span' => 'span-4-1', 'label' => 'Wedding · Oxford Exchange',       'pos' => 'center 20%' ],
  [ 'img' => $img_base . '/franco-dj-3.jpg',          'span' => 'span-8-2', 'label' => 'Brand activation · Coca-Cola',    'pos' => '' ],
  [ 'img' => $img_base . '/franco-clean-3.jpg',       'span' => 'span-4-2', 'label' => 'Portrait · 2024',                 'pos' => '' ],
  [ 'img' => $img_base . '/franco-dj-4.jpg',          'span' => 'span-3-1', 'label' => 'JW Marriott Water Street',        'pos' => '' ],
  [ 'img' => $img_base . '/franco-pro-3.jpg',         'span' => 'span-3-1', 'label' => 'Mexico · destination set',        'pos' => '' ],
  [ 'img' => $img_base . '/franco-clean-4.jpg',       'span' => 'span-6-2', 'label' => 'Private affair · Hotel Flor',     'pos' => '' ],
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

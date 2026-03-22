<?php
/**
 * Certificate section
 */

$section_num = $args['section_num'] ?? '';
$label       = vetapteka_get_option_value( 'certificate_label', '' );
$title       = vetapteka_get_option_value( 'certificate_title', '' );
$text        = vetapteka_get_option_value( 'certificate_text', '' );
$image       = get_field( 'certificate_image', 'option' );
$image_url   = vetapteka_get_image_url( $image, 'vetapteka-section' );
$image_alt   = vetapteka_get_image_alt( $image, wp_strip_all_tags( $title ) );
$zoom_hint   = vetapteka_get_option_value( 'certificate_zoom_hint', '' );
$details     = get_field( 'certificate_details', 'option' ) ?: [];
$button      = get_field( 'certificate_button', 'option' );
$button_url  = vetapteka_get_link_url( $button, '#contacts' );
$button_text = vetapteka_get_link_title( $button, '' );
$button_target = vetapteka_get_link_target( $button );
?>

<section class="certificate" id="certificate" aria-labelledby="certificate-title">
  <div class="container certificate-inner">
    <div class="certificate-img-col">
      <?php if ( $image_url ) : ?>
        <button
          class="cert-btn"
          id="cert-btn"
          type="button"
          aria-label="<?php echo esc_attr( $zoom_hint ?: wp_strip_all_tags( $title ) ); ?>"
          data-src="<?php echo esc_url( $image_url ); ?>"
          data-alt="<?php echo esc_attr( $image_alt ); ?>"
        >
          <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" loading="lazy" class="cert-img">
          <?php if ( $zoom_hint ) : ?>
            <div class="cert-zoom-hint" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                <line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line>
              </svg>
              <span><?php echo esc_html( $zoom_hint ); ?></span>
            </div>
          <?php endif; ?>
        </button>
      <?php endif; ?>
    </div>

    <div class="certificate-text-col">
      <div class="section-header"<?php echo $section_num ? ' data-num="' . esc_attr( $section_num ) . '"' : ''; ?>>
        <?php if ( $label ) : ?>
          <span class="label"><?php echo esc_html( $label ); ?></span>
        <?php endif; ?>
        <?php if ( $title ) : ?>
          <h2 class="section-title" id="certificate-title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>
      </div>

      <?php if ( $text ) : ?>
        <p class="cert-p"><?php echo vetapteka_format_multiline_text( $text ); ?></p>
      <?php endif; ?>

      <?php if ( ! empty( $details ) ) : ?>
        <dl class="cert-details">
          <?php foreach ( $details as $detail ) : ?>
            <?php if ( empty( $detail['label'] ) && empty( $detail['value'] ) ) : ?>
              <?php continue; ?>
            <?php endif; ?>
            <div class="cert-row">
              <dt><?php echo esc_html( $detail['label'] ?? '' ); ?></dt>
              <dd<?php echo ! empty( $detail['is_highlight'] ) ? ' class="cert-status"' : ''; ?>>
                <?php echo esc_html( $detail['value'] ?? '' ); ?>
              </dd>
            </div>
          <?php endforeach; ?>
        </dl>
      <?php endif; ?>

      <?php if ( $button_text ) : ?>
        <a class="btn btn-gold" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_text ); ?></a>
      <?php endif; ?>
    </div>
  </div>
</section>

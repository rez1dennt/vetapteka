<?php
/**
 * About section
 */

$section_num = $args['section_num'] ?? '';

$label       = vetapteka_get_option_value( 'about_label', '' );
$title       = vetapteka_get_option_value( 'about_title', '' );
$text_1      = vetapteka_get_option_value( 'about_text_primary', '' );
$text_2      = vetapteka_get_option_value( 'about_text_secondary', '' );
$image       = get_field( 'about_image', 'option' );
$image_url   = vetapteka_get_image_url( $image, 'vetapteka-section' );
$image_alt   = vetapteka_get_image_alt( $image, wp_strip_all_tags( $title ) );
$badge_num   = vetapteka_get_option_value( 'about_badge_number', '' );
$badge_text  = vetapteka_get_option_value( 'about_badge_text', '' );
$features    = get_field( 'about_features', 'option' ) ?: [];
?>

<section class="about" id="about" aria-labelledby="about-title">
  <div class="container about-inner">
    <div class="about-image-wrap">
      <?php if ( $image_url ) : ?>
        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" loading="lazy" class="about-img">
      <?php endif; ?>

      <?php if ( $badge_num || $badge_text ) : ?>
        <div class="about-badge" aria-hidden="true">
          <?php if ( $badge_num ) : ?>
            <span class="about-badge-num"><?php echo esc_html( $badge_num ); ?></span>
          <?php endif; ?>
          <?php if ( $badge_text ) : ?>
            <span class="about-badge-text"><?php echo esc_html( $badge_text ); ?></span>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="about-text-wrap">
      <div class="section-header"<?php echo $section_num ? ' data-num="' . esc_attr( $section_num ) . '"' : ''; ?>>
        <?php if ( $label ) : ?>
          <span class="label"><?php echo esc_html( $label ); ?></span>
        <?php endif; ?>
        <?php if ( $title ) : ?>
          <h2 class="section-title" id="about-title"><?php echo wp_kses_post( $title ); ?></h2>
        <?php endif; ?>
      </div>

      <?php if ( $text_1 ) : ?>
        <p class="about-p"><?php echo vetapteka_format_multiline_text( $text_1 ); ?></p>
      <?php endif; ?>

      <?php if ( $text_2 ) : ?>
        <p class="about-p"><?php echo vetapteka_format_multiline_text( $text_2 ); ?></p>
      <?php endif; ?>

      <?php if ( ! empty( $features ) ) : ?>
        <ul class="about-features" aria-label="<?php echo esc_attr( wp_strip_all_tags( $title ) ); ?>">
          <?php foreach ( $features as $feature ) : ?>
            <?php if ( empty( $feature['text'] ) ) : ?>
              <?php continue; ?>
            <?php endif; ?>
            <li class="about-feature">
              <span class="feature-dot" aria-hidden="true">✦</span>
              <?php echo esc_html( $feature['text'] ); ?>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php
/**
 * Hero section
 */

$eyebrow    = vetapteka_get_option_value( 'hero_eyebrow', '' );
$title      = vetapteka_get_option_value( 'hero_title', '' );
$subtitle   = vetapteka_get_option_value( 'hero_subtitle', '' );
$button     = get_field( 'hero_button', 'option' );
$bg_image   = get_field( 'hero_background', 'option' );
$bg_url     = vetapteka_get_image_url( $bg_image, 'vetapteka-hero' );
$bg_style   = $bg_url ? sprintf( ' style="background-image: url(\'%s\');"', esc_url( $bg_url ) ) : '';
$button_url = vetapteka_get_link_url( $button, '#contacts' );
$button_text = vetapteka_get_link_title( $button, '' );
$button_target = vetapteka_get_link_target( $button );
?>

<section class="hero" id="hero" aria-label="Главный экран">
  <div class="hero-bg" aria-hidden="true"<?php echo $bg_style; ?>></div>
  <div class="hero-overlay" aria-hidden="true"></div>
  <div class="container hero-content">
    <?php if ( $eyebrow ) : ?>
      <p class="hero-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
    <?php endif; ?>

    <?php if ( $title ) : ?>
      <h1 class="hero-title"><?php echo wp_kses_post( $title ); ?></h1>
    <?php endif; ?>

    <?php if ( $subtitle ) : ?>
      <p class="hero-subtitle"><?php echo vetapteka_format_multiline_text( $subtitle ); ?></p>
    <?php endif; ?>

    <?php if ( $button_text ) : ?>
      <a class="btn btn-gold hero-btn" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>">
        <?php echo vetapteka_phone_svg( 18 ); ?>
        <?php echo esc_html( $button_text ); ?>
      </a>
    <?php endif; ?>
  </div>
  <div class="hero-scroll" aria-hidden="true">
    <div class="hero-scroll-line"></div>
  </div>
</section>

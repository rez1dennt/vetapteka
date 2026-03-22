<?php
/**
 * CTA section
 */

$title        = vetapteka_get_option_value( 'cta_title', '' );
$text         = vetapteka_get_option_value( 'cta_text', '' );
$button       = get_field( 'cta_button', 'option' );
$button_url   = vetapteka_get_link_url( $button, '#contacts' );
$button_title = vetapteka_get_link_title( $button, '' );

if ( ! $title && ! $text ) {
    return;
}
?>

<section class="cta-banner" id="cta" aria-labelledby="cta-title">
  <div class="container cta-inner">
    <?php if ( $title ) : ?>
      <h2 class="cta-title" id="cta-title"><?php echo esc_html( $title ); ?></h2>
    <?php endif; ?>
    <?php if ( $text || $button_title ) : ?>
      <p class="cta-text">
        <?php echo vetapteka_format_multiline_text( $text ); ?>
        <?php if ( $button_title ) : ?>
          <a class="cta-link" href="<?php echo esc_url( $button_url ); ?>"><?php echo esc_html( $button_title ); ?></a>
        <?php endif; ?>
      </p>
    <?php endif; ?>
  </div>
</section>

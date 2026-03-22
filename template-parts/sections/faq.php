<?php
/**
 * FAQ section
 */

$section_num = $args['section_num'] ?? '';
$label       = vetapteka_get_option_value( 'faq_label', '' );
$title       = vetapteka_get_option_value( 'faq_title', '' );
$subtitle    = vetapteka_get_option_value( 'faq_subtitle', '' );
$items       = get_field( 'faq_items', 'option' ) ?: [];

if ( ! $title || empty( $items ) ) {
    return;
}
?>

<section class="faq section-dark" id="faq" aria-labelledby="faq-title">
  <div class="container">
    <div class="section-header"<?php echo $section_num ? ' data-num="' . esc_attr( $section_num ) . '"' : ''; ?>>
      <?php if ( $label ) : ?>
        <span class="label label-center"><?php echo esc_html( $label ); ?></span>
      <?php endif; ?>
      <h2 class="section-title section-title-center" id="faq-title"><?php echo esc_html( $title ); ?></h2>
      <?php if ( $subtitle ) : ?>
        <p class="section-subtitle"><?php echo vetapteka_format_multiline_text( $subtitle ); ?></p>
      <?php endif; ?>
    </div>

    <div class="faq-list">
      <?php foreach ( $items as $index => $item ) : ?>
        <?php
        if ( empty( $item['question'] ) || empty( $item['answer'] ) ) {
            continue;
        }
        $answer_id = 'faq-a-' . ( $index + 1 );
        ?>
        <div class="faq-item">
          <button class="faq-q" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr( $answer_id ); ?>">
            <span><?php echo esc_html( $item['question'] ); ?></span>
            <span class="faq-icon" aria-hidden="true"></span>
          </button>
          <div class="faq-a" id="<?php echo esc_attr( $answer_id ); ?>" role="region">
            <div class="faq-a-inner">
              <p><?php echo vetapteka_format_multiline_text( $item['answer'] ); ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

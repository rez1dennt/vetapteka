<?php
/**
 * Shared cards section renderer
 */

$section_class = $args['section_class'] ?? '';
$section_id    = $args['section_id'] ?? '';
$section_num   = $args['section_num'] ?? '';
$label         = $args['label'] ?? '';
$title         = $args['title'] ?? '';
$subtitle      = $args['subtitle'] ?? '';
$cards         = $args['cards'] ?? [];
$grid_class    = $args['grid_class'] ?? 'cards-grid';
$card_class    = $args['card_class'] ?? 'card';

if ( ! $title || empty( $cards ) ) {
    return;
}
?>

<section class="<?php echo esc_attr( $section_class ); ?>" id="<?php echo esc_attr( $section_id ); ?>" aria-labelledby="<?php echo esc_attr( $section_id . '-title' ); ?>">
  <div class="container">
    <div class="section-header"<?php echo $section_num ? ' data-num="' . esc_attr( $section_num ) . '"' : ''; ?>>
      <?php if ( $label ) : ?>
        <span class="label label-center"><?php echo esc_html( $label ); ?></span>
      <?php endif; ?>
      <h2 class="section-title section-title-center" id="<?php echo esc_attr( $section_id . '-title' ); ?>"><?php echo wp_kses_post( $title ); ?></h2>
      <?php if ( $subtitle ) : ?>
        <p class="section-subtitle"><?php echo vetapteka_format_multiline_text( $subtitle ); ?></p>
      <?php endif; ?>
    </div>

    <div class="<?php echo esc_attr( $grid_class ); ?>" role="list">
      <?php foreach ( $cards as $card ) : ?>
        <?php
        $image        = $card['image'] ?? null;
        $image_url    = vetapteka_get_image_url( $image, 'vetapteka-card' );
        $image_alt    = vetapteka_get_image_alt( $image, $card['title'] ?? '' );
        $button       = $card['button'] ?? [];
        $button_url   = vetapteka_get_link_url( $button, '#contacts' );
        $button_title = vetapteka_get_link_title( $button, '' );
        $button_target = vetapteka_get_link_target( $button );
        ?>
        <article class="<?php echo esc_attr( $card_class ); ?>" role="listitem">
          <?php if ( $image_url ) : ?>
            <div class="card-img-wrap">
              <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" loading="lazy" class="card-img">
            </div>
          <?php endif; ?>
          <div class="card-body">
            <?php if ( ! empty( $card['title'] ) ) : ?>
              <h3 class="card-title"><?php echo esc_html( $card['title'] ); ?></h3>
            <?php endif; ?>
            <?php if ( ! empty( $card['description'] ) ) : ?>
              <p class="card-desc"><?php echo vetapteka_format_multiline_text( $card['description'] ); ?></p>
            <?php endif; ?>
            <?php if ( $button_title ) : ?>
              <a class="btn btn-gold btn-sm" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>">
                <?php echo vetapteka_phone_svg( 15 ); ?>
                <?php echo esc_html( $button_title ); ?>
              </a>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

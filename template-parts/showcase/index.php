<?php
/**
 * Витрина (showcase) section template
 */

$use_products     = get_field( 'vitrina_use_products', 'options' );
$products         = get_field( 'vitrina_products', 'options' ) ?: [];
$title            = get_field( 'vitrina_title', 'options' ) ?: 'Наши препараты';
$subtitle         = get_field( 'vitrina_subtitle', 'options' ) ?: '';
$placeholder      = get_field( 'vitrina_placeholder', 'options' );
$placeholder_text = get_field( 'vitrina_placeholder_text', 'options' ) ?: 'Ассортимент формируется. Свяжитесь с нами.';

$show_products = $use_products && ! empty( $products );
$per_page      = 9;
$total         = count( $products );
$initial       = array_slice( $products, 0, $per_page );
$has_more      = $total > $per_page;

$placeholder_url = $placeholder
    ? esc_url( $placeholder['sizes']['large'] ?? $placeholder['url'] )
    : esc_url( get_template_directory_uri() . '/images/флаконы.jpg' );
?>

<section class="vitrina section-dark" id="vitrina" aria-labelledby="vitrina-title">
  <div class="container">
    <div class="section-header" data-num="05">
      <span class="label label-center">Ассортимент</span>
      <h2 class="section-title section-title-center" id="vitrina-title"><?php echo esc_html( $title ); ?></h2>
      <?php if ( $subtitle ) : ?>
        <p class="section-subtitle"><?php echo esc_html( $subtitle ); ?></p>
      <?php endif; ?>
    </div>

    <?php if ( ! $show_products ) : ?>
      <!-- ЗАГЛУШКА -->
      <div class="vitrina-placeholder">
        <div class="vitrina-placeholder__img-wrap">
          <img src="<?php echo $placeholder_url; ?>" alt="Ассортимент препаратов ВЕТАПТЕКА.ПРО" loading="lazy" class="vitrina-placeholder__img">
        </div>
        <p class="vitrina-placeholder__text"><?php echo esc_html( $placeholder_text ); ?></p>
        <a class="btn btn-gold" href="tel:+79168096136">
          <?php echo vetapteka_phone_svg( 16 ); ?>
          Узнать наличие
        </a>
      </div>
    <?php else : ?>
      <!-- СЕТКА ТОВАРОВ -->
      <div class="vitrina-grid"
           id="vitrina-grid"
           data-offset="<?php echo esc_attr( min( $per_page, $total ) ); ?>"
           data-total="<?php echo esc_attr( $total ); ?>">
        <?php
        foreach ( $initial as $product ) :
            $name      = esc_html( $product['product_name'] ?? '' );
            $desc      = esc_html( $product['product_description'] ?? '' );
            $price     = esc_html( $product['product_price'] ?? '' );
            $badge     = esc_html( $product['product_badge'] ?? '' );
            $available = ! empty( $product['product_available'] );
            $img       = $product['product_image'] ?? null;
            $img_url   = $img
                ? esc_url( $img['sizes']['medium_large'] ?? $img['sizes']['large'] ?? $img['url'] )
                : esc_url( get_template_directory_uri() . '/images/флаконы.jpg' );
            $img_alt   = $img
                ? esc_attr( $img['alt'] ?: $name )
                : esc_attr( $name );

            echo vetapteka_build_card_html( $name, $desc, $price, $badge, $available, $img_url, $img_alt );
        endforeach;
        ?>
      </div>

      <?php if ( $has_more ) : ?>
        <div class="vitrina-more">
          <button class="btn btn-outline vitrina-more__btn" id="vitrina-load-more" type="button"
                  data-remaining="<?php echo esc_attr( $total - min( $per_page, $total ) ); ?>">
            Показать ещё
            <span class="vitrina-more__count">(ещё <?php echo esc_html( $total - min( $per_page, $total ) ); ?>)</span>
          </button>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</section>

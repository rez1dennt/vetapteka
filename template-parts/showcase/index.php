<?php
/**
 * Витрина (showcase) section template
 */

$use_products     = get_field( 'vitrina_use_products', 'options' );
$products         = get_field( 'vitrina_products', 'options' ) ?: [];
$label            = vetapteka_get_option_value( 'vitrina_label', '' );
$title            = get_field( 'vitrina_title', 'options' ) ?: '';
$subtitle         = get_field( 'vitrina_subtitle', 'options' ) ?: '';
$placeholder      = get_field( 'vitrina_placeholder', 'options' );
$placeholder_text = get_field( 'vitrina_placeholder_text', 'options' ) ?: '';
$placeholder_alt  = vetapteka_get_option_value( 'vitrina_placeholder_alt', '' );
$placeholder_btn  = vetapteka_get_option_value( 'vitrina_placeholder_button_text', '' );
$more_button      = vetapteka_get_option_value( 'vitrina_more_button_text', '' );
$more_count_label = vetapteka_get_option_value( 'vitrina_more_count_label', '' );
$phone_href       = vetapteka_get_phone_href( vetapteka_get_option_value( 'contacts_phone_raw', '' ) );
$section_num      = $args['section_num'] ?? '';

$show_products = $use_products && ! empty( $products );
$per_page      = 9;
$total         = count( $products );
$initial       = array_slice( $products, 0, $per_page );
$has_more      = $total > $per_page;

$placeholder_url = $placeholder
    ? vetapteka_get_image_url( $placeholder, 'vetapteka-placeholder' )
    : vetapteka_get_optimized_asset_url( get_template_directory_uri() . '/images/флаконы.jpg' );
?>

<section class="vitrina section-dark" id="vitrina" aria-labelledby="vitrina-title">
  <div class="container">
    <div class="section-header" data-num="<?php echo esc_attr( $section_num ); ?>">
      <span class="label label-center"><?php echo esc_html( $label ); ?></span>
      <h2 class="section-title section-title-center" id="vitrina-title"><?php echo esc_html( $title ); ?></h2>
      <?php if ( $subtitle ) : ?>
        <p class="section-subtitle"><?php echo vetapteka_format_multiline_text( $subtitle ); ?></p>
      <?php endif; ?>
    </div>

    <?php if ( ! $show_products ) : ?>
      <!-- ЗАГЛУШКА -->
      <div class="vitrina-placeholder">
        <div class="vitrina-placeholder__img-wrap">
          <img src="<?php echo $placeholder_url; ?>" alt="<?php echo esc_attr( $placeholder_alt ); ?>" loading="lazy" class="vitrina-placeholder__img">
        </div>
        <p class="vitrina-placeholder__text"><?php echo vetapteka_format_multiline_text( $placeholder_text ); ?></p>
        <a class="btn btn-gold" href="<?php echo esc_url( $phone_href ); ?>">
          <?php echo vetapteka_phone_svg( 16 ); ?>
          <?php echo esc_html( $placeholder_btn ); ?>
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
            $name      = (string) ( $product['product_name'] ?? '' );
            $desc      = (string) ( $product['product_description'] ?? '' );
            $price     = (string) ( $product['product_price'] ?? '' );
            $badge     = (string) ( $product['product_badge'] ?? '' );
            $available = ! empty( $product['product_available'] );
            $img       = $product['product_image'] ?? null;
            $img_url   = $img
                ? vetapteka_get_image_url( $img, 'vetapteka-card' )
                : vetapteka_get_optimized_asset_url( get_template_directory_uri() . '/images/флаконы.jpg' );
            $img_alt   = vetapteka_get_image_alt( $img, $name );

            echo vetapteka_build_card_html( $name, $desc, $price, $badge, $available, $img_url, $img_alt );
        endforeach;
        ?>
      </div>

      <?php if ( $has_more ) : ?>
        <div class="vitrina-more">
          <button class="btn btn-outline vitrina-more__btn" id="vitrina-load-more" type="button"
                  data-count-label="<?php echo esc_attr( $more_count_label ); ?>"
                  data-remaining="<?php echo esc_attr( $total - min( $per_page, $total ) ); ?>">
            <?php echo esc_html( $more_button ); ?>
            <span class="vitrina-more__count">(<?php echo esc_html( $more_count_label ); ?> <?php echo esc_html( $total - min( $per_page, $total ) ); ?>)</span>
          </button>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</section>

<?php
/**
 * ВЕТАПТЕКА.ПРО — AJAX handler for Витрина load more
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function vetapteka_showcase_load_more() {
    check_ajax_referer( 'vetapteka_showcase_nonce', 'nonce' );

    $offset   = absint( $_POST['offset'] ?? 0 );
    $per_page = 9;
    $products = get_field( 'vitrina_products', 'options' ) ?: [];
    $chunk    = array_slice( $products, $offset, $per_page );
    $total    = count( $products );
    $has_more = ( $offset + $per_page ) < $total;

    ob_start();
    foreach ( $chunk as $product ) {
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
    }
    $html = ob_get_clean();

    wp_send_json_success( [
        'html'       => $html,
        'has_more'   => $has_more,
        'new_offset' => $offset + count( $chunk ),
    ] );
}
add_action( 'wp_ajax_vetapteka_showcase_load_more',        'vetapteka_showcase_load_more' );
add_action( 'wp_ajax_nopriv_vetapteka_showcase_load_more', 'vetapteka_showcase_load_more' );

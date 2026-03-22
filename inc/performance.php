<?php
/**
 * ВЕТАПТЕКА.ПРО — performance and image optimization
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'big_image_size_threshold', 'vetapteka_big_image_size_threshold', 10, 4 );
add_filter( 'jpeg_quality', 'vetapteka_image_quality', 10, 2 );
add_filter( 'wp_editor_set_quality', 'vetapteka_image_quality', 10, 2 );
add_filter( 'wp_generate_attachment_metadata', 'vetapteka_generate_attachment_webp_versions', 20, 2 );
add_action( 'wp_head', 'vetapteka_preload_hero_image', 1 );

function vetapteka_big_image_size_threshold( $threshold, $imagesize, $file, $attachment_id ) {
    return 1920;
}

function vetapteka_image_quality( $quality, $mime_type = '' ) {
    if ( $mime_type === 'image/png' ) {
        return $quality;
    }

    return 82;
}

function vetapteka_generate_attachment_webp_versions( array $metadata, int $attachment_id ): array {
    $source_path = get_attached_file( $attachment_id );

    if ( $source_path ) {
        $webp_path = preg_replace( '/\.(jpe?g|png)$/i', '.webp', $source_path );

        if ( $webp_path ) {
            vetapteka_create_webp_from_file( $source_path, $webp_path );
        }
    }

    if ( empty( $metadata['sizes'] ) || ! $source_path ) {
        return $metadata;
    }

    $base_dir = trailingslashit( dirname( $source_path ) );

    foreach ( $metadata['sizes'] as $size ) {
        if ( empty( $size['file'] ) ) {
            continue;
        }

        $size_path = wp_normalize_path( $base_dir . $size['file'] );
        $webp_path = preg_replace( '/\.(jpe?g|png)$/i', '.webp', $size_path );

        if ( $webp_path ) {
            vetapteka_create_webp_from_file( $size_path, $webp_path );
        }
    }

    return $metadata;
}

function vetapteka_preload_hero_image() {
    if ( ! is_front_page() || ! vetapteka_get_option_value( 'hero_visible', 1 ) ) {
        return;
    }

    $hero_image = get_field( 'hero_background', 'option' );
    $hero_url   = vetapteka_get_image_url( $hero_image, 'vetapteka-hero' );

    if ( ! $hero_url ) {
        return;
    }

    printf(
        "<link rel=\"preload\" as=\"image\" href=\"%s\">\n",
        esc_url( $hero_url )
    );
}

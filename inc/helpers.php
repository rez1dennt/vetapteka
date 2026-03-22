<?php
/**
 * ВЕТАПТЕКА.ПРО — helpers
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function vetapteka_get_option_value( string $field_name, $default = '' ) {
    $value = get_field( $field_name, 'option' );

    if ( $value === null || $value === '' ) {
        return $default;
    }

    return $value;
}

function vetapteka_get_image_size_candidates( string $size ): array {
    $fallbacks = [
        'vetapteka-logo'        => [ 'vetapteka-logo', 'medium', 'thumbnail', 'full' ],
        'vetapteka-card'        => [ 'vetapteka-card', 'medium_large', 'large', 'full' ],
        'vetapteka-section'     => [ 'vetapteka-section', 'large', 'medium_large', 'full' ],
        'vetapteka-placeholder' => [ 'vetapteka-placeholder', 'large', 'medium_large', 'full' ],
        'vetapteka-hero'        => [ 'vetapteka-hero', '1536x1536', 'large', 'full' ],
    ];

    return $fallbacks[ $size ] ?? [ $size, 'large', 'medium_large', 'full' ];
}

function vetapteka_get_local_path_from_url( string $url ): string {
    if ( $url === '' ) {
        return '';
    }

    $normalized_url  = strtok( $url, '?' );
    $uploads         = wp_get_upload_dir();
    $template_url    = trailingslashit( get_template_directory_uri() );
    $stylesheet_url  = trailingslashit( get_stylesheet_directory_uri() );
    $mappings        = [
        trailingslashit( $uploads['baseurl'] )    => trailingslashit( $uploads['basedir'] ),
        $template_url                              => trailingslashit( get_template_directory() ),
        $stylesheet_url                            => trailingslashit( get_stylesheet_directory() ),
    ];

    foreach ( $mappings as $base_url => $base_dir ) {
        if ( strpos( $normalized_url, $base_url ) !== 0 ) {
            continue;
        }

        $relative = ltrim( substr( $normalized_url, strlen( $base_url ) ), '/' );
        $path     = wp_normalize_path( $base_dir . $relative );

        if ( file_exists( $path ) ) {
            return $path;
        }
    }

    return '';
}

function vetapteka_create_webp_from_file( string $source_path, string $target_path ): bool {
    if ( ! function_exists( 'imagewebp' ) || ! file_exists( $source_path ) ) {
        return false;
    }

    $mime = function_exists( 'wp_get_image_mime' )
        ? (string) wp_get_image_mime( $source_path )
        : '';

    if ( $mime === '' ) {
        $mime = wp_check_filetype( $source_path )['type'] ?? '';
    }

    if ( ! in_array( $mime, [ 'image/jpeg', 'image/png' ], true ) ) {
        return false;
    }

    if ( ! wp_mkdir_p( dirname( $target_path ) ) ) {
        return false;
    }

    if ( $mime === 'image/jpeg' ) {
        $image = imagecreatefromjpeg( $source_path );
    } else {
        $image = imagecreatefrompng( $source_path );

        if ( ! $image ) {
            return false;
        }

        if ( function_exists( 'imagepalettetotruecolor' ) ) {
            imagepalettetotruecolor( $image );
        }

        imagealphablending( $image, true );
        imagesavealpha( $image, true );
    }

    if ( ! $image ) {
        return false;
    }

    $result = imagewebp( $image, $target_path, 82 );
    imagedestroy( $image );

    return (bool) $result;
}

function vetapteka_get_optimized_asset_url( string $url ): string {
    if ( $url === '' ) {
        return '';
    }

    $path = vetapteka_get_local_path_from_url( $url );

    if ( ! $path ) {
        return $url;
    }

    $extension = strtolower( pathinfo( $path, PATHINFO_EXTENSION ) );

    if ( $extension === 'webp' ) {
        return $url;
    }

    if ( ! in_array( $extension, [ 'jpg', 'jpeg', 'png' ], true ) ) {
        return $url;
    }

    $webp_path = preg_replace( '/\.(jpe?g|png)$/i', '.webp', $path );
    $webp_url  = preg_replace( '/\.(jpe?g|png)(\?.*)?$/i', '.webp$2', $url );

    if ( ! $webp_path || ! $webp_url ) {
        return $url;
    }

    if ( ! file_exists( $webp_path ) || filemtime( $webp_path ) < filemtime( $path ) ) {
        vetapteka_create_webp_from_file( $path, $webp_path );
    }

    return file_exists( $webp_path ) ? $webp_url : $url;
}

function vetapteka_get_image_url( $image, string $size = 'large' ): string {
    $attachment_id = 0;

    if ( is_array( $image ) ) {
        $attachment_id = (int) ( $image['ID'] ?? 0 );
    } elseif ( is_numeric( $image ) ) {
        $attachment_id = (int) $image;
    }

    if ( $attachment_id > 0 ) {
        foreach ( vetapteka_get_image_size_candidates( $size ) as $candidate ) {
            $url = wp_get_attachment_image_url( $attachment_id, $candidate );

            if ( $url ) {
                return vetapteka_get_optimized_asset_url( (string) $url );
            }
        }
    }

    if ( is_array( $image ) ) {
        foreach ( vetapteka_get_image_size_candidates( $size ) as $candidate ) {
            if ( isset( $image['sizes'][ $candidate ] ) && $image['sizes'][ $candidate ] ) {
                return vetapteka_get_optimized_asset_url( (string) $image['sizes'][ $candidate ] );
            }
        }

        if ( ! empty( $image['url'] ) ) {
            return vetapteka_get_optimized_asset_url( (string) $image['url'] );
        }
    }

    return '';
}

function vetapteka_get_image_alt( $image, string $fallback = '' ): string {
    if ( is_array( $image ) && ! empty( $image['alt'] ) ) {
        return (string) $image['alt'];
    }

    if ( is_numeric( $image ) ) {
        $alt = get_post_meta( (int) $image, '_wp_attachment_image_alt', true );

        if ( $alt ) {
            return (string) $alt;
        }
    }

    return $fallback;
}

function vetapteka_get_link_url( $link, string $default = '#' ): string {
    if ( is_array( $link ) && ! empty( $link['url'] ) ) {
        $url = (string) $link['url'];

        if ( strpos( $url, '#' ) === 0 && ! is_front_page() ) {
            return home_url( '/' . ltrim( $url, '/' ) );
        }

        return $url;
    }

    if ( strpos( $default, '#' ) === 0 && ! is_front_page() ) {
        return home_url( '/' . ltrim( $default, '/' ) );
    }

    return $default;
}

function vetapteka_get_link_title( $link, string $default = '' ): string {
    if ( is_array( $link ) && isset( $link['title'] ) && $link['title'] !== '' ) {
        return (string) $link['title'];
    }

    return $default;
}

function vetapteka_get_link_target( $link ): string {
    if ( is_array( $link ) && ! empty( $link['target'] ) ) {
        return (string) $link['target'];
    }

    return '_self';
}

function vetapteka_get_phone_href( string $phone_raw ): string {
    if ( strpos( $phone_raw, 'tel:' ) === 0 ) {
        return $phone_raw;
    }

    $clean = preg_replace( '/[^0-9+]/', '', $phone_raw );

    return $clean ? 'tel:' . $clean : '#';
}

function vetapteka_section_number( int $number ): string {
    return str_pad( (string) $number, 2, '0', STR_PAD_LEFT );
}

function vetapteka_is_current_row_visible(): bool {
    $value = get_sub_field( 'is_visible' );

    if ( $value === null || $value === '' ) {
        return true;
    }

    return (bool) $value;
}

function vetapteka_rows_have_content( array $rows, array $keys ): bool {
    foreach ( $rows as $row ) {
        if ( ! is_array( $row ) ) {
            continue;
        }

        foreach ( $keys as $key ) {
            if ( empty( $row[ $key ] ) ) {
                continue;
            }

            return true;
        }
    }

    return false;
}

function vetapteka_should_render_home_section( string $layout ): bool {
    if ( ! vetapteka_is_current_row_visible() ) {
        return false;
    }

    switch ( $layout ) {
        case 'about_section':
            return (bool) (
                vetapteka_get_option_value( 'about_title', '' )
                || vetapteka_get_option_value( 'about_text_primary', '' )
                || vetapteka_get_option_value( 'about_text_secondary', '' )
                || get_field( 'about_image', 'option' )
                || vetapteka_rows_have_content( get_field( 'about_features', 'option' ) ?: [], [ 'text' ] )
            );

        case 'stats_section':
            return vetapteka_rows_have_content( get_field( 'stats_items', 'option' ) ?: [], [ 'value', 'label' ] );

        case 'services_section':
            return (bool) vetapteka_get_option_value( 'services_title', '' )
                && vetapteka_rows_have_content( get_field( 'services_cards', 'option' ) ?: [], [ 'title', 'description', 'image' ] );

        case 'solutions_section':
            return (bool) vetapteka_get_option_value( 'solutions_title', '' )
                && vetapteka_rows_have_content( get_field( 'solutions_cards', 'option' ) ?: [], [ 'title', 'description', 'image' ] );

        case 'approach_section':
            return (bool) vetapteka_get_option_value( 'approach_title', '' )
                && vetapteka_rows_have_content( get_field( 'approach_cards', 'option' ) ?: [], [ 'title', 'description', 'image' ] );

        case 'showcase_section':
            return true;

        case 'certificate_section':
            return (bool) (
                vetapteka_get_option_value( 'certificate_title', '' )
                || vetapteka_get_option_value( 'certificate_text', '' )
                || get_field( 'certificate_image', 'option' )
                || vetapteka_rows_have_content( get_field( 'certificate_details', 'option' ) ?: [], [ 'label', 'value' ] )
                || vetapteka_get_link_title( get_field( 'certificate_button', 'option' ), '' )
            );

        case 'contacts_section':
            return (bool) (
                vetapteka_get_option_value( 'contacts_title', '' )
                || vetapteka_get_option_value( 'contacts_address_text', '' )
                || vetapteka_get_option_value( 'contacts_phone_display', '' )
                || vetapteka_get_option_value( 'contacts_email', '' )
            );

        case 'cta_section':
            return (bool) (
                vetapteka_get_option_value( 'cta_title', '' )
                || vetapteka_get_option_value( 'cta_text', '' )
                || vetapteka_get_link_title( get_field( 'cta_button', 'option' ), '' )
            );

        case 'faq_section':
            return (bool) vetapteka_get_option_value( 'faq_title', '' )
                && vetapteka_rows_have_content( get_field( 'faq_items', 'option' ) ?: [], [ 'question', 'answer' ] );
    }

    return true;
}

function vetapteka_format_multiline_text( string $text ): string {
    if ( $text === '' ) {
        return '';
    }

    if ( preg_match( '/<[^>]+>/', $text ) ) {
        return wp_kses_post( $text );
    }

    return nl2br( esc_html( $text ) );
}

function vetapteka_replace_year_token( string $text ): string {
    return str_replace( '{year}', date_i18n( 'Y' ), $text );
}

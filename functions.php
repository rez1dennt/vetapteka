<?php
/**
 * ВЕТАПТЕКА.ПРО — Theme functions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ──────────────────────────────────────────────────────────────
   THEME SETUP
────────────────────────────────────────────────────────────── */
function vetapteka_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ] );

    add_image_size( 'vetapteka-hero', 1920, 1920, false );
    add_image_size( 'vetapteka-section', 1280, 1280, false );
    add_image_size( 'vetapteka-card', 960, 960, false );
    add_image_size( 'vetapteka-placeholder', 1280, 1280, false );
    add_image_size( 'vetapteka-logo', 160, 160, false );
}
add_action( 'after_setup_theme', 'vetapteka_setup' );

/* ──────────────────────────────────────────────────────────────
   ENQUEUE SCRIPTS & STYLES
────────────────────────────────────────────────────────────── */
function vetapteka_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'vetapteka-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap',
        [],
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'vetapteka-style',
        get_template_directory_uri() . '/css/style.css',
        [ 'vetapteka-fonts' ],
        wp_get_theme()->get( 'Version' )
    );

    // Main JS
    wp_enqueue_script(
        'vetapteka-main',
        get_template_directory_uri() . '/js/main.js',
        [],
        wp_get_theme()->get( 'Version' ),
        true
    );

    if ( is_front_page() ) {
        wp_enqueue_script(
            'vetapteka-showcase',
            get_template_directory_uri() . '/js/showcase.js',
            [ 'vetapteka-main' ],
            wp_get_theme()->get( 'Version' ),
            true
        );

        wp_localize_script(
            'vetapteka-showcase',
            'vetaptekaAjax',
            [
                'url'     => admin_url( 'admin-ajax.php' ),
                'nonce'   => wp_create_nonce( 'vetapteka_showcase_nonce' ),
                'perPage' => 9,
            ]
        );
    }
}
add_action( 'wp_enqueue_scripts', 'vetapteka_scripts' );

/* ──────────────────────────────────────────────────────────────
   HELPER: Phone SVG
────────────────────────────────────────────────────────────── */
function vetapteka_phone_svg( $size = 16 ) {
    $s = absint( $size );
    return sprintf(
        '<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">'
        . '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.29 6.29l1.28-1.29a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>'
        . '</svg>',
        $s
    );
}

/* ──────────────────────────────────────────────────────────────
   HELPER: Build showcase card HTML string
────────────────────────────────────────────────────────────── */
function vetapteka_build_card_html(
    string $name,
    string $desc,
    string $price,
    string $badge,
    bool   $available,
    string $img_url,
    string $img_alt
): string {
    $phone_svg        = vetapteka_phone_svg( 15 );
    $badge_fallback   = vetapteka_get_option_value( 'vitrina_unavailable_badge_text', '' );
    $button_text      = vetapteka_get_option_value( 'vitrina_card_button_text', '' );
    $phone_href       = vetapteka_get_phone_href( vetapteka_get_option_value( 'contacts_phone_raw', '' ) );

    $badge_html = '';
    if ( $badge ) {
        $badge_html = sprintf(
            '<span class="showcase-card__badge">%s</span>',
            esc_html( $badge )
        );
    } elseif ( ! $available && $badge_fallback ) {
        $badge_html = sprintf(
            '<span class="showcase-card__badge showcase-card__badge--unavailable">%s</span>',
            esc_html( $badge_fallback )
        );
    }

    $price_html = $price
        ? sprintf( '<p class="showcase-card__price">%s</p>', esc_html( $price ) )
        : '';

    $desc_html = $desc
        ? sprintf( '<p class="showcase-card__desc">%s</p>', vetapteka_format_multiline_text( $desc ) )
        : '';

    $button_html = $button_text
        ? sprintf(
            '<a class="btn btn-gold btn-sm showcase-card__btn" href="%s">%s %s</a>',
            esc_url( $phone_href ),
            $phone_svg,
            esc_html( $button_text )
        )
        : '';

    return sprintf(
        '<article class="showcase-card">'
        . '%s'
        . '<div class="showcase-card__img-wrap">'
        .   '<img src="%s" alt="%s" loading="lazy" class="showcase-card__img">'
        . '</div>'
        . '<div class="showcase-card__body">'
        .   '<h3 class="showcase-card__name">%s</h3>'
        .   '%s'
        .   '%s'
        .   '%s'
        . '</div>'
        . '</article>',
        $badge_html,
        esc_url( $img_url ),
        esc_attr( $img_alt ),
        esc_html( $name ),
        $desc_html,
        $price_html,
        $button_html
    );
}

/* ──────────────────────────────────────────────────────────────
   INCLUDE FILES
────────────────────────────────────────────────────────────── */
require_once get_template_directory() . '/inc/acf-options.php';
require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/performance.php';
require_once get_template_directory() . '/inc/acf-fields.php';
require_once get_template_directory() . '/inc/acf-seed.php';
require_once get_template_directory() . '/inc/yoast-setup.php';
require_once get_template_directory() . '/inc/ajax-showcase.php';

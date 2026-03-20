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

    // Showcase JS
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
add_action( 'wp_enqueue_scripts', 'vetapteka_scripts' );

/* ──────────────────────────────────────────────────────────────
   SCHEMA.ORG JSON-LD
────────────────────────────────────────────────────────────── */
function vetapteka_schema_jsonld() {
    ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": ["Pharmacy", "LocalBusiness"],
  "name": "ВЕТАПТЕКА.ПРО",
  "description": "Компаундинговая ветеринарная аптека. Индивидуальные лекарственные препараты для животных.",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "ул. Алма-Атинская, д. 9, к. 2",
    "addressLocality": "Москва",
    "addressCountry": "RU",
    "postalCode": "115408"
  },
  "telephone": "+79168096136",
  "url": "https://vetapteka.pro",
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
    "opens": "09:00",
    "closes": "18:00"
  }
}
</script>
    <?php
}
add_action( 'wp_head', 'vetapteka_schema_jsonld' );

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
    $phone_svg = vetapteka_phone_svg( 15 );

    $badge_html = '';
    if ( $badge ) {
        $badge_html = sprintf(
            '<span class="showcase-card__badge">%s</span>',
            esc_html( $badge )
        );
    } elseif ( ! $available ) {
        $badge_html = '<span class="showcase-card__badge showcase-card__badge--unavailable">Нет в наличии</span>';
    }

    $price_html = $price
        ? sprintf( '<p class="showcase-card__price">%s</p>', esc_html( $price ) )
        : '';

    $desc_html = $desc
        ? sprintf( '<p class="showcase-card__desc">%s</p>', esc_html( $desc ) )
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
        .   '<a class="btn btn-gold btn-sm showcase-card__btn" href="tel:+79168096136">'
        .     '%s Заказать'
        .   '</a>'
        . '</div>'
        . '</article>',
        $badge_html,
        esc_url( $img_url ),
        esc_attr( $img_alt ),
        esc_html( $name ),
        $desc_html,
        $price_html,
        $phone_svg
    );
}

/* ──────────────────────────────────────────────────────────────
   INCLUDE FILES
────────────────────────────────────────────────────────────── */
require_once get_template_directory() . '/inc/acf-options.php';
require_once get_template_directory() . '/inc/acf-fields.php';
require_once get_template_directory() . '/inc/ajax-showcase.php';

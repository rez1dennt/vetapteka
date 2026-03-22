<?php
/**
 * ВЕТАПТЕКА.ПРО — Yoast SEO sync
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', 'vetapteka_maybe_sync_yoast_settings', 30 );
add_action( 'acf/save_post', 'vetapteka_sync_yoast_after_acf_save', 30 );

function vetapteka_sync_yoast_after_acf_save( $post_id ) {
    if ( $post_id !== 'options' ) {
        return;
    }

    vetapteka_sync_yoast_settings( true );
}

function vetapteka_maybe_sync_yoast_settings() {
    vetapteka_sync_yoast_settings( false );
}

function vetapteka_sync_yoast_settings( bool $force = false ) {
    if ( ! class_exists( 'WPSEO_Options' ) || ! function_exists( 'get_field' ) ) {
        return;
    }

    $brand_main   = trim( (string) vetapteka_get_option_value( 'general_brand_main', '' ) );
    $brand_accent = trim( (string) vetapteka_get_option_value( 'general_brand_accent', '' ) );
    $site_name    = trim( $brand_main . $brand_accent );
    $tagline      = wp_strip_all_tags( (string) vetapteka_get_option_value( 'general_site_tagline', '' ) );
    $hero_text    = wp_strip_all_tags( (string) vetapteka_get_option_value( 'hero_subtitle', '' ) );
    $home_title   = $site_name ? $site_name . ' | Ветеринарная аптека для животных в Москве' : get_bloginfo( 'name' );
    $home_desc    = $hero_text ?: $tagline;
    $phone        = trim( (string) vetapteka_get_option_value( 'contacts_phone_raw', '' ) );
    $email        = sanitize_email( (string) vetapteka_get_option_value( 'contacts_email', '' ) );
    $logo         = get_field( 'general_logo', 'option' );
    $logo_id      = 0;

    if ( is_array( $logo ) ) {
        $logo_id = (int) ( $logo['ID'] ?? 0 );
    } elseif ( is_numeric( $logo ) ) {
        $logo_id = (int) $logo;
    }

    $logo_url = $logo_id ? wp_get_attachment_image_url( $logo_id, 'full' ) : '';

    $payload = [
        'site_name' => $site_name,
        'tagline'   => $tagline,
        'home_title'=> $home_title,
        'home_desc' => $home_desc,
        'phone'     => $phone,
        'email'     => $email,
        'logo_id'   => $logo_id,
        'logo_url'  => $logo_url,
    ];

    $hash = md5( wp_json_encode( $payload ) );

    if ( ! $force && get_option( 'vetapteka_yoast_sync_hash' ) === $hash ) {
        return;
    }

    WPSEO_Options::set( 'enable_xml_sitemap', true, 'wpseo' );
    WPSEO_Options::set( 'enable_schema', true, 'wpseo' );

    WPSEO_Options::set( 'website_name', $site_name, 'wpseo_titles' );
    WPSEO_Options::set( 'company_name', $site_name, 'wpseo_titles' );
    WPSEO_Options::set( 'company_or_person', 'company', 'wpseo_titles' );
    WPSEO_Options::set( 'disable-attachment', true, 'wpseo_titles' );
    WPSEO_Options::set( 'title-home-wpseo', $home_title, 'wpseo_titles' );
    WPSEO_Options::set( 'metadesc-home-wpseo', $home_desc, 'wpseo_titles' );
    WPSEO_Options::set( 'open_graph_frontpage_desc', $home_desc, 'wpseo_titles' );
    WPSEO_Options::set( 'org-description', $tagline ?: $home_desc, 'wpseo_titles' );
    WPSEO_Options::set( 'org-phone', $phone, 'wpseo_titles' );
    WPSEO_Options::set( 'org-email', $email, 'wpseo_titles' );

    WPSEO_Options::set( 'company_logo', $logo_url ?: '', 'wpseo_titles' );
    WPSEO_Options::set( 'company_logo_id', $logo_id > 0 ? $logo_id : 0, 'wpseo_titles' );

    WPSEO_Options::set( 'og_frontpage_desc', $home_desc, 'wpseo_social' );
    update_option( 'wp_attachment_pages_enabled', 0 );

    if ( $site_name ) {
        update_option( 'blogname', $site_name );
    }

    if ( $tagline ) {
        update_option( 'blogdescription', $tagline );
    }

    update_option( 'vetapteka_yoast_sync_hash', $hash, false );
}

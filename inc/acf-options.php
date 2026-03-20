<?php
/**
 * ВЕТАПТЕКА.ПРО — ACF Options pages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'acf/init', 'vetapteka_register_options_pages' );

function vetapteka_register_options_pages() {
    if ( ! function_exists( 'acf_add_options_page' ) ) {
        return;
    }

    // Top-level page
    acf_add_options_page( [
        'page_title'  => 'Ветаптека',
        'menu_title'  => 'Ветаптека',
        'menu_slug'   => 'vetapteka',
        'capability'  => 'edit_posts',
        'icon_url'    => 'dashicons-heart',
        'position'    => 25,
        'redirect'    => false,
    ] );

    // Sub-pages
    acf_add_options_sub_page( [
        'page_title'  => 'Главная',
        'menu_title'  => 'Главная',
        'parent_slug' => 'vetapteka',
        'menu_slug'   => 'vetapteka-home',
        'capability'  => 'edit_posts',
    ] );

    acf_add_options_sub_page( [
        'page_title'  => 'О компании',
        'menu_title'  => 'О компании',
        'parent_slug' => 'vetapteka',
        'menu_slug'   => 'vetapteka-about',
        'capability'  => 'edit_posts',
    ] );

    acf_add_options_sub_page( [
        'page_title'  => 'Контакты',
        'menu_title'  => 'Контакты',
        'parent_slug' => 'vetapteka',
        'menu_slug'   => 'vetapteka-contacts',
        'capability'  => 'edit_posts',
    ] );

    acf_add_options_sub_page( [
        'page_title'  => 'Витрина',
        'menu_title'  => 'Витрина',
        'parent_slug' => 'vetapteka',
        'menu_slug'   => 'vetapteka-vitrina',
        'capability'  => 'edit_posts',
    ] );
}

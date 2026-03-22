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
        'page_title'  => 'Статистика',
        'menu_title'  => 'Статистика',
        'parent_slug' => 'vetapteka',
        'menu_slug'   => 'vetapteka-stats',
        'capability'  => 'edit_posts',
    ] );

    acf_add_options_sub_page( [
        'page_title'  => 'Услуги',
        'menu_title'  => 'Услуги',
        'parent_slug' => 'vetapteka',
        'menu_slug'   => 'vetapteka-services',
        'capability'  => 'edit_posts',
    ] );

    acf_add_options_sub_page( [
        'page_title'  => 'Решения',
        'menu_title'  => 'Решения',
        'parent_slug' => 'vetapteka',
        'menu_slug'   => 'vetapteka-solutions',
        'capability'  => 'edit_posts',
    ] );

    acf_add_options_sub_page( [
        'page_title'  => 'Подход',
        'menu_title'  => 'Подход',
        'parent_slug' => 'vetapteka',
        'menu_slug'   => 'vetapteka-approach',
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

    acf_add_options_sub_page( [
        'page_title'  => 'Лицензия',
        'menu_title'  => 'Лицензия',
        'parent_slug' => 'vetapteka',
        'menu_slug'   => 'vetapteka-certificate',
        'capability'  => 'edit_posts',
    ] );

    acf_add_options_sub_page( [
        'page_title'  => 'CTA',
        'menu_title'  => 'CTA',
        'parent_slug' => 'vetapteka',
        'menu_slug'   => 'vetapteka-cta',
        'capability'  => 'edit_posts',
    ] );

    acf_add_options_sub_page( [
        'page_title'  => 'FAQ',
        'menu_title'  => 'FAQ',
        'parent_slug' => 'vetapteka',
        'menu_slug'   => 'vetapteka-faq',
        'capability'  => 'edit_posts',
    ] );

    acf_add_options_sub_page( [
        'page_title'  => 'Футер',
        'menu_title'  => 'Футер',
        'parent_slug' => 'vetapteka',
        'menu_slug'   => 'vetapteka-footer',
        'capability'  => 'edit_posts',
    ] );

    acf_add_options_sub_page( [
        'page_title'  => 'Политика конфиденциальности',
        'menu_title'  => 'Политика',
        'parent_slug' => 'vetapteka',
        'menu_slug'   => 'vetapteka-policy',
        'capability'  => 'edit_posts',
    ] );
}

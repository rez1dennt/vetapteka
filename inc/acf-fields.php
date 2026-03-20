<?php
/**
 * ВЕТАПТЕКА.ПРО — ACF local field group for Витрина
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'acf/init', 'vetapteka_register_vitrina_fields' );

function vetapteka_register_vitrina_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_vitrina',
        'title'    => 'Витрина — управление',
        'fields'   => [

            // ── Tab: Основные настройки ──────────────────────────
            [
                'key'   => 'field_vitrina_tab_main',
                'label' => 'Основные настройки',
                'type'  => 'tab',
            ],
            [
                'key'           => 'field_vitrina_use_products',
                'name'          => 'vitrina_use_products',
                'label'         => 'Использовать товары',
                'type'          => 'true_false',
                'message'       => 'Включить вывод товаров (если выключено — показывается заглушка)',
                'default_value' => 0,
                'ui'            => 1,
                'ui_on_text'    => 'Включено',
                'ui_off_text'   => 'Выключено',
            ],
            [
                'key'           => 'field_vitrina_title',
                'name'          => 'vitrina_title',
                'label'         => 'Заголовок секции',
                'type'          => 'text',
                'default_value' => 'Наши препараты',
                'instructions'  => 'Заголовок раздела витрины на сайте',
            ],
            [
                'key'   => 'field_vitrina_subtitle',
                'name'  => 'vitrina_subtitle',
                'label' => 'Подзаголовок',
                'type'  => 'textarea',
                'rows'  => 2,
            ],

            // ── Tab: Заглушка ────────────────────────────────────
            [
                'key'   => 'field_vitrina_tab_placeholder',
                'label' => 'Заглушка',
                'type'  => 'tab',
            ],
            [
                'key'           => 'field_vitrina_placeholder',
                'name'          => 'vitrina_placeholder',
                'label'         => 'Изображение-заглушка',
                'type'          => 'image',
                'instructions'  => 'Показывается когда товары отключены или список пуст. По умолчанию — флаконы.jpg',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            [
                'key'           => 'field_vitrina_placeholder_text',
                'name'          => 'vitrina_placeholder_text',
                'label'         => 'Текст под заглушкой',
                'type'          => 'text',
                'default_value' => 'Ассортимент препаратов формируется. Свяжитесь с нами для уточнения наличия.',
            ],

            // ── Tab: Товары ──────────────────────────────────────
            [
                'key'   => 'field_vitrina_tab_products',
                'label' => 'Товары',
                'type'  => 'tab',
            ],
            [
                'key'          => 'field_vitrina_products',
                'name'         => 'vitrina_products',
                'label'        => 'Товары',
                'type'         => 'repeater',
                'button_label' => 'Добавить товар',
                'layout'       => 'block',
                'sub_fields'   => [
                    [
                        'key'      => 'field_product_name',
                        'name'     => 'product_name',
                        'label'    => 'Название товара',
                        'type'     => 'text',
                        'required' => 1,
                        'wrapper'  => [ 'width' => '60' ],
                    ],
                    [
                        'key'         => 'field_product_price',
                        'name'        => 'product_price',
                        'label'       => 'Цена',
                        'type'        => 'text',
                        'placeholder' => 'напр. от 850 ₽',
                        'wrapper'     => [ 'width' => '40' ],
                    ],
                    [
                        'key'           => 'field_product_image',
                        'name'          => 'product_image',
                        'label'         => 'Изображение',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'thumbnail',
                        'wrapper'       => [ 'width' => '30' ],
                    ],
                    [
                        'key'     => 'field_product_description',
                        'name'    => 'product_description',
                        'label'   => 'Описание',
                        'type'    => 'textarea',
                        'rows'    => 3,
                        'wrapper' => [ 'width' => '70' ],
                    ],
                    [
                        'key'         => 'field_product_badge',
                        'name'        => 'product_badge',
                        'label'       => 'Бейдж (опционально)',
                        'type'        => 'text',
                        'placeholder' => 'напр. Новинка, Хит',
                        'wrapper'     => [ 'width' => '50' ],
                    ],
                    [
                        'key'           => 'field_product_available',
                        'name'          => 'product_available',
                        'label'         => 'В наличии',
                        'type'          => 'true_false',
                        'default_value' => 1,
                        'ui'            => 1,
                        'wrapper'       => [ 'width' => '50' ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vetapteka-vitrina',
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'active'                => true,
    ] );
}

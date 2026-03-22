<?php
/**
 * ВЕТАПТЕКА.ПРО — ACF local field groups
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'acf/init', 'vetapteka_register_acf_field_groups' );

function vetapteka_register_acf_field_groups() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    vetapteka_register_general_field_group();
    vetapteka_register_home_field_group();
    vetapteka_register_about_field_group();
    vetapteka_register_stats_field_group();
    vetapteka_register_services_field_group();
    vetapteka_register_solutions_field_group();
    vetapteka_register_approach_field_group();
    vetapteka_register_contacts_field_group();
    vetapteka_register_certificate_field_group();
    vetapteka_register_cta_field_group();
    vetapteka_register_faq_field_group();
    vetapteka_register_footer_field_group();
    vetapteka_register_policy_field_group();
    vetapteka_register_vitrina_field_group();
}

function vetapteka_acf_tab( string $key, string $label ): array {
    return [
        'key'   => $key,
        'label' => $label,
        'type'  => 'tab',
    ];
}

function vetapteka_acf_text_field(
    string $key,
    string $name,
    string $label,
    string $instructions = '',
    string $default = '',
    string $width = ''
): array {
    $field = [
        'key'           => $key,
        'name'          => $name,
        'label'         => $label,
        'type'          => 'text',
        'instructions'  => $instructions,
        'default_value' => $default,
    ];

    if ( $width !== '' ) {
        $field['wrapper'] = [ 'width' => $width ];
    }

    return $field;
}

function vetapteka_acf_textarea_field(
    string $key,
    string $name,
    string $label,
    string $instructions = '',
    string $default = '',
    int $rows = 3,
    string $width = ''
): array {
    $field = [
        'key'           => $key,
        'name'          => $name,
        'label'         => $label,
        'type'          => 'textarea',
        'instructions'  => $instructions,
        'default_value' => $default,
        'rows'          => $rows,
        'new_lines'     => 'br',
    ];

    if ( $width !== '' ) {
        $field['wrapper'] = [ 'width' => $width ];
    }

    return $field;
}

function vetapteka_acf_image_field(
    string $key,
    string $name,
    string $label,
    string $instructions = '',
    string $width = ''
): array {
    $field = [
        'key'           => $key,
        'name'          => $name,
        'label'         => $label,
        'type'          => 'image',
        'instructions'  => $instructions,
        'return_format' => 'array',
        'preview_size'  => 'medium',
        'library'       => 'all',
    ];

    if ( $width !== '' ) {
        $field['wrapper'] = [ 'width' => $width ];
    }

    return $field;
}

function vetapteka_acf_link_field(
    string $key,
    string $name,
    string $label,
    string $instructions = '',
    string $width = ''
): array {
    $field = [
        'key'           => $key,
        'name'          => $name,
        'label'         => $label,
        'type'          => 'link',
        'instructions'  => $instructions,
        'return_format' => 'array',
    ];

    if ( $width !== '' ) {
        $field['wrapper'] = [ 'width' => $width ];
    }

    return $field;
}

function vetapteka_acf_true_false_field(
    string $key,
    string $name,
    string $label,
    string $message,
    int $default = 1,
    string $width = ''
): array {
    $field = [
        'key'           => $key,
        'name'          => $name,
        'label'         => $label,
        'type'          => 'true_false',
        'message'       => $message,
        'default_value' => $default,
        'ui'            => 1,
        'ui_on_text'    => 'Включено',
        'ui_off_text'   => 'Выключено',
    ];

    if ( $width !== '' ) {
        $field['wrapper'] = [ 'width' => $width ];
    }

    return $field;
}

function vetapteka_acf_visible_sub_field( string $key ): array {
    return vetapteka_acf_true_false_field(
        $key,
        'is_visible',
        'Показывать секцию',
        'Если выключить, секция останется в списке, но не будет выводиться на сайте.',
        1
    );
}

function vetapteka_acf_note_sub_field( string $key, string $message ): array {
    return [
        'key'       => $key,
        'label'     => 'Подсказка',
        'type'      => 'message',
        'message'   => $message,
        'esc_html'  => 0,
        'new_lines' => 'wpautop',
    ];
}

function vetapteka_acf_text_sub_field(
    string $key,
    string $name,
    string $label,
    string $instructions = '',
    string $width = ''
): array {
    return vetapteka_acf_text_field( $key, $name, $label, $instructions, '', $width );
}

function vetapteka_acf_textarea_sub_field(
    string $key,
    string $name,
    string $label,
    string $instructions = '',
    int $rows = 3,
    string $width = ''
): array {
    return vetapteka_acf_textarea_field( $key, $name, $label, $instructions, '', $rows, $width );
}

function vetapteka_acf_image_sub_field(
    string $key,
    string $name,
    string $label,
    string $instructions = '',
    string $width = ''
): array {
    return vetapteka_acf_image_field( $key, $name, $label, $instructions, $width );
}

function vetapteka_acf_link_sub_field(
    string $key,
    string $name,
    string $label,
    string $instructions = '',
    string $width = ''
): array {
    return vetapteka_acf_link_field( $key, $name, $label, $instructions, $width );
}

function vetapteka_acf_cards_repeater_sub_field( string $prefix, string $name, string $label, string $button_label ): array {
    return [
        'key'          => $prefix . '_cards',
        'name'         => $name,
        'label'        => $label,
        'type'         => 'repeater',
        'layout'       => 'block',
        'button_label' => $button_label,
        'instructions' => 'Карточки можно менять местами перетаскиванием.',
        'sub_fields'   => [
            vetapteka_acf_image_sub_field(
                $prefix . '_card_image',
                'image',
                'Изображение',
                'Загрузите изображение карточки.',
                '30'
            ),
            vetapteka_acf_text_sub_field(
                $prefix . '_card_title',
                'title',
                'Заголовок',
                'Название карточки на сайте.',
                '35'
            ),
            vetapteka_acf_link_sub_field(
                $prefix . '_card_button',
                'button',
                'Кнопка',
                'Текст и ссылка для кнопки карточки.',
                '35'
            ),
            vetapteka_acf_textarea_sub_field(
                $prefix . '_card_description',
                'description',
                'Описание',
                'Короткий текст под заголовком.',
                3,
                '100'
            ),
        ],
    ];
}

function vetapteka_register_general_field_group() {
    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_general',
        'title'    => 'Ветаптека — общие настройки',
        'fields'   => [
            vetapteka_acf_tab( 'field_general_tab_brand', 'Бренд' ),
            vetapteka_acf_image_field(
                'field_general_logo',
                'general_logo',
                'Логотип',
                'Используется в шапке и футере.',
                '30'
            ),
            vetapteka_acf_text_field(
                'field_general_logo_alt',
                'general_logo_alt',
                'Alt логотипа',
                'Описание изображения логотипа.',
                'Логотип ВЕТАПТЕКА.ПРО',
                '30'
            ),
            vetapteka_acf_text_field(
                'field_general_brand_main',
                'general_brand_main',
                'Название бренда',
                'Основная часть логотипа.',
                'ВЕТАПТЕКА',
                '20'
            ),
            vetapteka_acf_text_field(
                'field_general_brand_accent',
                'general_brand_accent',
                'Акцент бренда',
                'Например: .ПРО',
                '.ПРО',
                '20'
            ),
            vetapteka_acf_text_field(
                'field_general_site_tagline',
                'general_site_tagline',
                'Короткий слоган',
                'Используется в футере и как вспомогательный текст.',
                'Препараты, которых нет в продаже — для тех, кого вы любите',
                '100'
            ),

            vetapteka_acf_tab( 'field_general_tab_header', 'Шапка' ),
            [
                'key'          => 'field_general_header_nav',
                'name'         => 'header_nav_links',
                'label'        => 'Пункты меню',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Добавить пункт меню',
                'instructions' => 'Для внутренних переходов используйте ссылки вида #about, #services и т.д.',
                'sub_fields'   => [
                    vetapteka_acf_link_sub_field(
                        'field_general_header_nav_link',
                        'link',
                        'Ссылка',
                        'Укажите текст пункта и ссылку.',
                        '100'
                    ),
                ],
            ],
            vetapteka_acf_link_field(
                'field_general_header_cta',
                'header_cta_link',
                'Кнопка в шапке',
                'Текст и ссылка для правой кнопки в header.',
                '50'
            ),
            vetapteka_acf_link_field(
                'field_general_mobile_cta',
                'mobile_cta_link',
                'Кнопка в мобильном меню',
                'Обычно сюда ставят телефон.',
                '50'
            ),
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vetapteka',
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

function vetapteka_register_home_field_group() {
    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_home',
        'title'    => 'Главная — контент',
        'fields'   => [
            vetapteka_acf_tab( 'field_home_tab_hero', 'Hero' ),
            vetapteka_acf_true_false_field(
                'field_home_hero_visible',
                'hero_visible',
                'Показывать Hero',
                'Если выключить, первый экран не будет выводиться на сайте.',
                1,
                '100'
            ),
            vetapteka_acf_text_field(
                'field_home_hero_eyebrow',
                'hero_eyebrow',
                'Надзаголовок',
                'Короткая строка над главным заголовком.',
                'Компаундинг · Москва',
                '30'
            ),
            vetapteka_acf_textarea_field(
                'field_home_hero_title',
                'hero_title',
                'Главный заголовок',
                'Можно использовать <br> и <em> для переноса и выделения.',
                'Препараты для<br>питомцев, которых<br><em>нет в аптеке</em>',
                4,
                '40'
            ),
            vetapteka_acf_textarea_field(
                'field_home_hero_subtitle',
                'hero_subtitle',
                'Подзаголовок',
                'Основной текст первого экрана.',
                'Изготавливаем лекарства по рецепту ветеринара — нужная доза, подходящий вкус, удобная форма. Для кошек, собак, лошадей и экзотов.',
                4,
                '30'
            ),
            vetapteka_acf_link_field(
                'field_home_hero_button',
                'hero_button',
                'Кнопка Hero',
                'Текст и ссылка главной кнопки.',
                '30'
            ),
            vetapteka_acf_image_field(
                'field_home_hero_background',
                'hero_background',
                'Фоновое изображение Hero',
                'Широкое горизонтальное изображение для первого экрана.',
                '100'
            ),

            vetapteka_acf_tab( 'field_home_tab_marquee', 'Бегущая строка' ),
            vetapteka_acf_true_false_field(
                'field_home_marquee_visible',
                'marquee_visible',
                'Показывать бегущую строку',
                'Если выключить, лента под Hero будет скрыта.',
                1,
                '100'
            ),
            [
                'key'          => 'field_home_marquee_items',
                'name'         => 'marquee_items',
                'label'        => 'Элементы бегущей строки',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Добавить элемент',
                'instructions' => 'Эти фразы повторяются на движущейся строке под Hero.',
                'sub_fields'   => [
                    vetapteka_acf_text_sub_field(
                        'field_home_marquee_item_text',
                        'text',
                        'Текст',
                        '',
                        '100'
                    ),
                ],
            ],

            vetapteka_acf_tab( 'field_home_tab_sections', 'Гибкие секции' ),
            [
                'key'          => 'field_home_sections',
                'name'         => 'home_sections',
                'label'        => 'Секции главной страницы',
                'type'         => 'flexible_content',
                'button_label' => 'Добавить секцию',
                'instructions' => 'Меняйте порядок секций перетаскиванием. Каждую секцию можно скрыть без удаления.',
                'layouts'      => vetapteka_get_home_layouts(),
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vetapteka-home',
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

function vetapteka_get_home_layouts(): array {
    return [
        [
            'key'        => 'layout_home_about_section',
            'name'       => 'about_section',
            'label'      => 'О компании',
            'display'    => 'block',
            'sub_fields' => [
                vetapteka_acf_visible_sub_field( 'field_home_about_visible' ),
                vetapteka_acf_note_sub_field(
                    'field_home_about_note',
                    'Контент этого блока редактируется на странице <strong>Ветаптека → О компании</strong>. Здесь вы только включаете секцию и меняете её порядок.'
                ),
            ],
        ],
        [
            'key'        => 'layout_home_stats_section',
            'name'       => 'stats_section',
            'label'      => 'Статистика',
            'display'    => 'block',
            'sub_fields' => [
                vetapteka_acf_visible_sub_field( 'field_home_stats_visible' ),
                vetapteka_acf_note_sub_field(
                    'field_home_stats_note',
                    'Контент этого блока редактируется на странице <strong>Ветаптека → Статистика</strong>. Здесь вы только включаете секцию и меняете её порядок.'
                ),
            ],
        ],
        [
            'key'        => 'layout_home_services_section',
            'name'       => 'services_section',
            'label'      => 'Наши услуги',
            'display'    => 'block',
            'sub_fields' => [
                vetapteka_acf_visible_sub_field( 'field_home_services_visible' ),
                vetapteka_acf_note_sub_field(
                    'field_home_services_note',
                    'Контент этого блока редактируется на странице <strong>Ветаптека → Услуги</strong>. Здесь вы только включаете секцию и меняете её порядок.'
                ),
            ],
        ],
        [
            'key'        => 'layout_home_solutions_section',
            'name'       => 'solutions_section',
            'label'      => 'Наши решения',
            'display'    => 'block',
            'sub_fields' => [
                vetapteka_acf_visible_sub_field( 'field_home_solutions_visible' ),
                vetapteka_acf_note_sub_field(
                    'field_home_solutions_note',
                    'Контент этого блока редактируется на странице <strong>Ветаптека → Решения</strong>. Здесь вы только включаете секцию и меняете её порядок.'
                ),
            ],
        ],
        [
            'key'        => 'layout_home_approach_section',
            'name'       => 'approach_section',
            'label'      => 'Индивидуальный подход',
            'display'    => 'block',
            'sub_fields' => [
                vetapteka_acf_visible_sub_field( 'field_home_approach_visible' ),
                vetapteka_acf_note_sub_field(
                    'field_home_approach_note',
                    'Контент этого блока редактируется на странице <strong>Ветаптека → Подход</strong>. Здесь вы только включаете секцию и меняете её порядок.'
                ),
            ],
        ],
        [
            'key'        => 'layout_home_showcase_section',
            'name'       => 'showcase_section',
            'label'      => 'Витрина',
            'display'    => 'block',
            'sub_fields' => [
                vetapteka_acf_visible_sub_field( 'field_home_showcase_visible' ),
                vetapteka_acf_note_sub_field(
                    'field_home_showcase_note',
                    'Блок витрины остаётся отдельным. Контент товаров и заглушки редактируется на странице <strong>Ветаптека → Витрина</strong>.'
                ),
            ],
        ],
        [
            'key'        => 'layout_home_certificate_section',
            'name'       => 'certificate_section',
            'label'      => 'Лицензия',
            'display'    => 'block',
            'sub_fields' => [
                vetapteka_acf_visible_sub_field( 'field_home_certificate_visible' ),
                vetapteka_acf_note_sub_field(
                    'field_home_certificate_note',
                    'Контент этого блока редактируется на странице <strong>Ветаптека → Лицензия</strong>. Здесь вы только включаете секцию и меняете её порядок.'
                ),
            ],
        ],
        [
            'key'        => 'layout_home_contacts_section',
            'name'       => 'contacts_section',
            'label'      => 'Контакты',
            'display'    => 'block',
            'sub_fields' => [
                vetapteka_acf_visible_sub_field( 'field_home_contacts_visible' ),
                vetapteka_acf_note_sub_field(
                    'field_home_contacts_note',
                    'Контент этого блока редактируется на странице <strong>Ветаптека → Контакты</strong>. Здесь вы только включаете секцию и меняете её порядок.'
                ),
            ],
        ],
        [
            'key'        => 'layout_home_cta_section',
            'name'       => 'cta_section',
            'label'      => 'Призыв к действию',
            'display'    => 'block',
            'sub_fields' => [
                vetapteka_acf_visible_sub_field( 'field_home_cta_visible' ),
                vetapteka_acf_note_sub_field(
                    'field_home_cta_note',
                    'Контент этого блока редактируется на странице <strong>Ветаптека → CTA</strong>. Здесь вы только включаете секцию и меняете её порядок.'
                ),
            ],
        ],
        [
            'key'        => 'layout_home_faq_section',
            'name'       => 'faq_section',
            'label'      => 'FAQ',
            'display'    => 'block',
            'sub_fields' => [
                vetapteka_acf_visible_sub_field( 'field_home_faq_visible' ),
                vetapteka_acf_note_sub_field(
                    'field_home_faq_note',
                    'Контент этого блока редактируется на странице <strong>Ветаптека → FAQ</strong>. Здесь вы только включаете секцию и меняете её порядок.'
                ),
            ],
        ],
    ];
}

function vetapteka_register_stats_field_group() {
    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_stats',
        'title'    => 'Статистика — контент',
        'fields'   => [
            vetapteka_acf_note_sub_field(
                'field_stats_note',
                'Порядок блока и его показ на главной странице настраиваются в разделе <strong>Ветаптека → Главная</strong>. Здесь редактируется только контент секции.'
            ),
            [
                'key'          => 'field_stats_items',
                'name'         => 'stats_items',
                'label'        => 'Пункты статистики',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Добавить показатель',
                'instructions' => 'Показатели выводятся в полосе между блоками на главной странице.',
                'sub_fields'   => [
                    vetapteka_acf_text_sub_field(
                        'field_stats_item_value',
                        'value',
                        'Число',
                        'Например: 10+, 500+, ∞',
                        '35'
                    ),
                    vetapteka_acf_text_sub_field(
                        'field_stats_item_label',
                        'label',
                        'Подпись',
                        'Короткое описание показателя.',
                        '65'
                    ),
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vetapteka-stats',
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

function vetapteka_register_services_field_group() {
    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_services',
        'title'    => 'Услуги — контент',
        'fields'   => [
            vetapteka_acf_note_sub_field(
                'field_services_note',
                'Порядок блока и его показ на главной странице настраиваются в разделе <strong>Ветаптека → Главная</strong>. Здесь редактируется только контент секции.'
            ),
            vetapteka_acf_text_field(
                'field_services_label',
                'services_label',
                'Подпись секции',
                'Небольшой текст над заголовком блока.',
                'Что мы делаем'
            ),
            vetapteka_acf_text_field(
                'field_services_title',
                'services_title',
                'Заголовок секции',
                'Главный заголовок блока.',
                'Наши услуги'
            ),
            vetapteka_acf_cards_repeater_sub_field(
                'field_services',
                'services_cards',
                'Карточки услуг',
                'Добавить услугу'
            ),
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vetapteka-services',
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

function vetapteka_register_solutions_field_group() {
    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_solutions',
        'title'    => 'Решения — контент',
        'fields'   => [
            vetapteka_acf_note_sub_field(
                'field_solutions_note',
                'Порядок блока и его показ на главной странице настраиваются в разделе <strong>Ветаптека → Главная</strong>. Здесь редактируется только контент секции.'
            ),
            vetapteka_acf_text_field(
                'field_solutions_label',
                'solutions_label',
                'Подпись секции',
                'Небольшой текст над заголовком блока.',
                'Формы препаратов.'
            ),
            vetapteka_acf_text_field(
                'field_solutions_title',
                'solutions_title',
                'Заголовок секции',
                'Главный заголовок блока.',
                'Наши решения'
            ),
            vetapteka_acf_cards_repeater_sub_field(
                'field_solutions',
                'solutions_cards',
                'Карточки решений',
                'Добавить решение'
            ),
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vetapteka-solutions',
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

function vetapteka_register_approach_field_group() {
    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_approach',
        'title'    => 'Подход — контент',
        'fields'   => [
            vetapteka_acf_note_sub_field(
                'field_approach_note',
                'Порядок блока и его показ на главной странице настраиваются в разделе <strong>Ветаптека → Главная</strong>. Здесь редактируется только контент секции.'
            ),
            vetapteka_acf_text_field(
                'field_approach_label',
                'approach_label',
                'Подпись секции',
                'Небольшой текст над заголовком блока.',
                'Для кого мы работаем'
            ),
            vetapteka_acf_text_field(
                'field_approach_title',
                'approach_title',
                'Заголовок секции',
                'Главный заголовок блока.',
                'Индивидуальный подход к лечению'
            ),
            vetapteka_acf_textarea_field(
                'field_approach_subtitle',
                'approach_subtitle',
                'Подзаголовок',
                'Текст под заголовком секции.',
                'Наш подход к компаундингу позволяет создавать лекарства, которые идеально подходят под физиологию и вес вашего животного, обеспечивая наилучший лечебный эффект.',
                4
            ),
            vetapteka_acf_cards_repeater_sub_field(
                'field_approach',
                'approach_cards',
                'Карточки подхода',
                'Добавить карточку'
            ),
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vetapteka-approach',
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

function vetapteka_register_certificate_field_group() {
    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_certificate',
        'title'    => 'Лицензия — контент',
        'fields'   => [
            vetapteka_acf_note_sub_field(
                'field_certificate_note',
                'Порядок блока и его показ на главной странице настраиваются в разделе <strong>Ветаптека → Главная</strong>. Здесь редактируется только контент секции.'
            ),
            vetapteka_acf_text_field(
                'field_certificate_label',
                'certificate_label',
                'Подпись секции',
                '',
                'Лицензия'
            ),
            vetapteka_acf_text_field(
                'field_certificate_title',
                'certificate_title',
                'Заголовок секции',
                '',
                'Сертифицированная аптека'
            ),
            vetapteka_acf_textarea_field(
                'field_certificate_text',
                'certificate_text',
                'Описание',
                'Основной текст секции лицензии.',
                'Мы работаем строго по лицензии Россельхознадзора, обеспечивая высочайшее качество каждого изготовленного препарата для здоровья ваших питомцев.',
                5
            ),
            vetapteka_acf_image_field(
                'field_certificate_image',
                'certificate_image',
                'Изображение лицензии',
                'Изображение открывается в lightbox.',
                '50'
            ),
            vetapteka_acf_text_field(
                'field_certificate_zoom_hint',
                'certificate_zoom_hint',
                'Подсказка при наведении',
                'Например: Нажмите для просмотра',
                'Нажмите для просмотра',
                '50'
            ),
            [
                'key'          => 'field_certificate_details',
                'name'         => 'certificate_details',
                'label'        => 'Параметры лицензии',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Добавить строку',
                'sub_fields'   => [
                    vetapteka_acf_text_sub_field(
                        'field_certificate_detail_label',
                        'label',
                        'Название',
                        'Например: Номер лицензии',
                        '40'
                    ),
                    vetapteka_acf_text_sub_field(
                        'field_certificate_detail_value',
                        'value',
                        'Значение',
                        'Например: Л042-00118-77/03607161',
                        '40'
                    ),
                    vetapteka_acf_true_false_field(
                        'field_certificate_detail_highlight',
                        'is_highlight',
                        'Выделить',
                        'Значение будет оформлено акцентом.',
                        0,
                        '20'
                    ),
                ],
            ],
            vetapteka_acf_link_field(
                'field_certificate_button',
                'certificate_button',
                'Кнопка',
                'Кнопка под блоком лицензии.'
            ),
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vetapteka-certificate',
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

function vetapteka_register_cta_field_group() {
    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_cta',
        'title'    => 'CTA — контент',
        'fields'   => [
            vetapteka_acf_note_sub_field(
                'field_cta_note',
                'Порядок блока и его показ на главной странице настраиваются в разделе <strong>Ветаптека → Главная</strong>. Здесь редактируется только контент секции.'
            ),
            vetapteka_acf_textarea_field(
                'field_cta_title',
                'cta_title',
                'Заголовок',
                'Основная фраза внутри баннера.',
                'Ветеринар выписал рецепт? Мы сами свяжемся с ним и уточним дозировки!',
                3
            ),
            vetapteka_acf_textarea_field(
                'field_cta_text',
                'cta_text',
                'Текст',
                'Текст под заголовком.',
                'Звоните — и через 3–5 дней нужный препарат будет у вас.',
                3
            ),
            vetapteka_acf_link_field(
                'field_cta_button',
                'cta_button',
                'Ссылка',
                'Ссылка внутри текста баннера.'
            ),
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vetapteka-cta',
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

function vetapteka_register_faq_field_group() {
    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_faq',
        'title'    => 'FAQ — контент',
        'fields'   => [
            vetapteka_acf_note_sub_field(
                'field_faq_note',
                'Порядок блока и его показ на главной странице настраиваются в разделе <strong>Ветаптека → Главная</strong>. Здесь редактируется только контент секции.'
            ),
            vetapteka_acf_text_field(
                'field_faq_label',
                'faq_label',
                'Подпись секции',
                '',
                'Вопросы и ответы'
            ),
            vetapteka_acf_text_field(
                'field_faq_title',
                'faq_title',
                'Заголовок секции',
                '',
                'Частые вопросы'
            ),
            vetapteka_acf_textarea_field(
                'field_faq_subtitle',
                'faq_subtitle',
                'Подзаголовок',
                'Короткое описание над списком вопросов.',
                'Ответы на самые частые вопросы о нашей работе.',
                3
            ),
            [
                'key'          => 'field_faq_items',
                'name'         => 'faq_items',
                'label'        => 'Вопросы и ответы',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Добавить вопрос',
                'sub_fields'   => [
                    vetapteka_acf_text_sub_field(
                        'field_faq_item_question',
                        'question',
                        'Вопрос'
                    ),
                    vetapteka_acf_textarea_sub_field(
                        'field_faq_item_answer',
                        'answer',
                        'Ответ',
                        'Можно использовать переносы строк.',
                        5
                    ),
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vetapteka-faq',
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

function vetapteka_register_about_field_group() {
    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_about',
        'title'    => 'О компании — контент',
        'fields'   => [
            vetapteka_acf_note_sub_field(
                'field_about_note',
                'Порядок блока и его показ на главной странице настраиваются в разделе <strong>Ветаптека → Главная</strong>. Здесь редактируется только контент секции.'
            ),
            vetapteka_acf_text_field(
                'field_about_label',
                'about_label',
                'Подпись секции',
                'Например: Кто мы',
                'Кто мы'
            ),
            vetapteka_acf_textarea_field(
                'field_about_title',
                'about_title',
                'Заголовок секции',
                'Можно использовать <br> для переноса строк.',
                'Делаем то, чего<br>нет в обычной аптеке',
                3
            ),
            vetapteka_acf_textarea_field(
                'field_about_text_primary',
                'about_text_primary',
                'Первый абзац',
                'Основной текст блока.',
                'Иногда нужный препарат просто недоступен: нет нужной дозировки, неподходящая форма, животное отказывается принимать. Мы решаем именно эти задачи.',
                5
            ),
            vetapteka_acf_textarea_field(
                'field_about_text_secondary',
                'about_text_secondary',
                'Второй абзац',
                'Дополнительный текст блока.',
                'Наш фармацевтический компаундинг изготавливает препараты по рецептам ветеринаров — с точным расчётом дозы под вес, вид и состояние животного. Работаем официально, по лицензии Россельхознадзора.',
                5
            ),
            vetapteka_acf_image_field(
                'field_about_image',
                'about_image',
                'Изображение',
                'Основное изображение секции.',
                '50'
            ),
            vetapteka_acf_text_field(
                'field_about_badge_number',
                'about_badge_number',
                'Число в бейдже',
                'Например: 10+',
                '10+',
                '25'
            ),
            vetapteka_acf_text_field(
                'field_about_badge_text',
                'about_badge_text',
                'Текст в бейдже',
                'Например: лет опыта',
                'лет опыта',
                '25'
            ),
            [
                'key'          => 'field_about_features',
                'name'         => 'about_features',
                'label'        => 'Преимущества',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Добавить преимущество',
                'instructions' => 'Список пунктов внизу блока.',
                'sub_fields'   => [
                    vetapteka_acf_text_sub_field(
                        'field_about_feature_text',
                        'text',
                        'Текст пункта',
                        '',
                        '100'
                    ),
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vetapteka-about',
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

function vetapteka_register_contacts_field_group() {
    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_contacts',
        'title'    => 'Контакты — контент',
        'fields'   => [
            vetapteka_acf_note_sub_field(
                'field_contacts_note',
                'Порядок блока и его показ на главной странице настраиваются в разделе <strong>Ветаптека → Главная</strong>. Здесь редактируется только контент секции.'
            ),
            vetapteka_acf_text_field(
                'field_contacts_label',
                'contacts_label',
                'Подпись секции',
                '',
                'Где нас найти'
            ),
            vetapteka_acf_text_field(
                'field_contacts_title',
                'contacts_title',
                'Заголовок секции',
                '',
                'Контакты'
            ),
            vetapteka_acf_text_field(
                'field_contacts_address_title',
                'contacts_address_title',
                'Заголовок адреса',
                '',
                'Наш адрес',
                '50'
            ),
            vetapteka_acf_textarea_field(
                'field_contacts_address_text',
                'contacts_address_text',
                'Текст адреса',
                'Можно указывать адрес в несколько строк.',
                'г. Москва, ул. Алма-Атинская, д. 9, к. 2',
                3,
                '50'
            ),
            vetapteka_acf_text_field(
                'field_contacts_delivery_title',
                'contacts_delivery_title',
                'Заголовок доставки',
                '',
                'Доставка',
                '50'
            ),
            vetapteka_acf_textarea_field(
                'field_contacts_delivery_text',
                'contacts_delivery_text',
                'Текст доставки',
                '',
                'Работаем в формате доставки по всей России',
                3,
                '50'
            ),
            vetapteka_acf_text_field(
                'field_contacts_phone_title',
                'contacts_phone_title',
                'Заголовок телефона',
                '',
                'Телефон',
                '33'
            ),
            vetapteka_acf_text_field(
                'field_contacts_phone_display',
                'contacts_phone_display',
                'Телефон для показа',
                'Например: +7 (916) 809-61-36',
                '+7 (916) 809-61-36',
                '33'
            ),
            vetapteka_acf_text_field(
                'field_contacts_phone_raw',
                'contacts_phone_raw',
                'Телефон для ссылки',
                'Например: +79168096136',
                '+79168096136',
                '34'
            ),
            vetapteka_acf_text_field(
                'field_contacts_email_title',
                'contacts_email_title',
                'Заголовок email',
                '',
                'Email',
                '50'
            ),
            vetapteka_acf_text_field(
                'field_contacts_email',
                'contacts_email',
                'Email',
                'Адрес электронной почты.',
                'info@vetapteka.pro',
                '50'
            ),
            vetapteka_acf_text_field(
                'field_contacts_worktime_title',
                'contacts_worktime_title',
                'Заголовок режима работы',
                '',
                'Режим работы',
                '50'
            ),
            vetapteka_acf_textarea_field(
                'field_contacts_worktime_text',
                'contacts_worktime_text',
                'Режим работы',
                'Например: Пн–Пт 09:00–18:00',
                'Пн–Пт 09:00–18:00',
                3,
                '50'
            ),
            vetapteka_acf_text_field(
                'field_contacts_map_title',
                'contacts_map_title',
                'Заголовок карты',
                'Используется в атрибуте title у iframe.',
                'Расположение ветеринарной аптеки ВЕТАПТЕКА.ПРО на карте Москвы',
                '50'
            ),
            vetapteka_acf_text_field(
                'field_contacts_map_url',
                'contacts_map_embed_url',
                'Ссылка на встроенную карту',
                'Полная ссылка для iframe на Яндекс.Карты или другую карту.',
                'https://yandex.ru/map-widget/v1/?ll=37.772927%2C55.639380&z=16&l=map&pt=37.772927%2C55.639380,pm2rdm',
                '50'
            ),
            vetapteka_acf_text_field(
                'field_contacts_latitude',
                'contacts_latitude',
                'Широта',
                'Для служебных данных и карты.',
                '55.639380',
                '25'
            ),
            vetapteka_acf_text_field(
                'field_contacts_longitude',
                'contacts_longitude',
                'Долгота',
                'Для служебных данных и карты.',
                '37.772927',
                '25'
            ),
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vetapteka-contacts',
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

function vetapteka_register_footer_field_group() {
    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_footer',
        'title'    => 'Футер — контент',
        'fields'   => [
            vetapteka_acf_true_false_field(
                'field_footer_visible',
                'footer_visible',
                'Показывать футер',
                'Если выключить, футер скроется на сайте.',
                1,
                '100'
            ),
            vetapteka_acf_text_field(
                'field_footer_tagline',
                'footer_tagline',
                'Подзаголовок бренда',
                'Текст рядом с логотипом.',
                'Препараты, которых нет в продаже — для тех, кого вы любите'
            ),
            vetapteka_acf_text_field(
                'field_footer_license_badge',
                'footer_license_badge',
                'Лицензионный бейдж',
                'Короткая строка под логотипом.',
                'Лицензия №Л042-00118-77/03607161'
            ),
            vetapteka_acf_text_field(
                'field_footer_nav_heading',
                'footer_nav_heading',
                'Заголовок колонки ссылок',
                '',
                'Разделы',
                '50'
            ),
            [
                'key'          => 'field_footer_nav_links',
                'name'         => 'footer_nav_links',
                'label'        => 'Ссылки футера',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Добавить ссылку',
                'instructions' => 'Обычно это якорные ссылки на разделы сайта.',
                'sub_fields'   => [
                    vetapteka_acf_link_sub_field(
                        'field_footer_nav_link',
                        'link',
                        'Ссылка',
                        '',
                        '100'
                    ),
                ],
            ],
            vetapteka_acf_text_field(
                'field_footer_contact_heading',
                'footer_contact_heading',
                'Заголовок колонки контактов',
                '',
                'Связаться',
                '50'
            ),
            vetapteka_acf_text_field(
                'field_footer_phone_display',
                'footer_phone_display',
                'Телефон для показа',
                '',
                '+7 (916) 809-61-36',
                '25'
            ),
            vetapteka_acf_text_field(
                'field_footer_phone_raw',
                'footer_phone_raw',
                'Телефон для ссылки',
                '',
                '+79168096136',
                '25'
            ),
            vetapteka_acf_textarea_field(
                'field_footer_address',
                'footer_address',
                'Адрес',
                'Текст адреса в колонке футера.',
                "г. Москва, ул. Алма-Атинская,\nд. 9, к. 2",
                3,
                '50'
            ),
            vetapteka_acf_text_field(
                'field_footer_delivery_note',
                'footer_delivery_note',
                'Примечание о доставке',
                '',
                'Доставка по всей России',
                '50'
            ),
            vetapteka_acf_text_field(
                'field_footer_copyright',
                'footer_copyright',
                'Копирайт',
                'Нижняя строка слева. Можно использовать {year}.',
                '© {year} ВЕТАПТЕКА.ПРО. Все права защищены.',
                '50'
            ),
            vetapteka_acf_link_field(
                'field_footer_privacy_link',
                'footer_privacy_link',
                'Ссылка на политику',
                'Текст и ссылка для политики конфиденциальности.',
                '25'
            ),
            vetapteka_acf_text_field(
                'field_footer_bottom_note',
                'footer_bottom_note',
                'Нижняя строка справа',
                '',
                'Работаем по лицензии Россельхознадзора',
                '25'
            ),
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vetapteka-footer',
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

function vetapteka_register_vitrina_field_group() {
    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_vitrina',
        'title'    => 'Витрина — управление',
        'fields'   => [
            vetapteka_acf_tab( 'field_vitrina_tab_main', 'Основные настройки' ),
            vetapteka_acf_note_sub_field(
                'field_vitrina_note',
                'Порядок блока и его показ на главной странице настраиваются в разделе <strong>Ветаптека → Главная</strong>. Здесь редактируется только содержимое витрины и товаров.'
            ),
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
                'key'           => 'field_vitrina_label',
                'name'          => 'vitrina_label',
                'label'         => 'Подпись секции',
                'type'          => 'text',
                'default_value' => 'Ассортимент',
                'instructions'  => 'Небольшая подпись над заголовком витрины.',
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

            vetapteka_acf_tab( 'field_vitrina_tab_placeholder', 'Заглушка' ),
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
            [
                'key'           => 'field_vitrina_placeholder_alt',
                'name'          => 'vitrina_placeholder_alt',
                'label'         => 'Alt изображения-заглушки',
                'type'          => 'text',
                'default_value' => 'Ассортимент препаратов ВЕТАПТЕКА.ПРО',
            ],
            [
                'key'           => 'field_vitrina_placeholder_button_text',
                'name'          => 'vitrina_placeholder_button_text',
                'label'         => 'Текст кнопки заглушки',
                'type'          => 'text',
                'default_value' => 'Узнать наличие',
            ],

            vetapteka_acf_tab( 'field_vitrina_tab_products', 'Товары' ),
            [
                'key'           => 'field_vitrina_more_button_text',
                'name'          => 'vitrina_more_button_text',
                'label'         => 'Текст кнопки "Показать ещё"',
                'type'          => 'text',
                'default_value' => 'Показать ещё',
                'wrapper'       => [ 'width' => '50' ],
            ],
            [
                'key'           => 'field_vitrina_more_count_label',
                'name'          => 'vitrina_more_count_label',
                'label'         => 'Подпись счётчика',
                'type'          => 'text',
                'default_value' => 'ещё',
                'wrapper'       => [ 'width' => '50' ],
            ],
            [
                'key'           => 'field_vitrina_card_button_text',
                'name'          => 'vitrina_card_button_text',
                'label'         => 'Текст кнопки товара',
                'type'          => 'text',
                'default_value' => 'Заказать',
                'wrapper'       => [ 'width' => '50' ],
            ],
            [
                'key'           => 'field_vitrina_unavailable_badge_text',
                'name'          => 'vitrina_unavailable_badge_text',
                'label'         => 'Текст "нет в наличии"',
                'type'          => 'text',
                'default_value' => 'Нет в наличии',
                'wrapper'       => [ 'width' => '50' ],
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

function vetapteka_register_policy_field_group() {
    acf_add_local_field_group( [
        'key'      => 'group_vetapteka_policy',
        'title'    => 'Политика конфиденциальности',
        'fields'   => [
            vetapteka_acf_tab( 'field_policy_tab_main', 'Главное' ),
            vetapteka_acf_text_field(
                'field_policy_page_title',
                'policy_page_title',
                'Заголовок страницы',
                'Основной заголовок юридической страницы.',
                'Политика конфиденциальности',
                '50'
            ),
            vetapteka_acf_textarea_field(
                'field_policy_intro',
                'policy_intro',
                'Вступление',
                'Короткое пояснение под заголовком.',
                'На этой странице описано, какие персональные данные могут обрабатываться при использовании сайта, для каких целей это делается и как пользователь может реализовать свои права.',
                4,
                '50'
            ),
            vetapteka_acf_text_field(
                'field_policy_last_updated',
                'policy_last_updated',
                'Дата последнего обновления',
                'Например: 22.03.2026',
                '',
                '25'
            ),
            [
                'key'       => 'field_policy_note',
                'label'     => 'Подсказка',
                'type'      => 'message',
                'message'   => 'Страница автоматически открывается по адресу <code>/privacy/</code>. Содержимое ниже можно менять без правки кода.',
                'esc_html'  => 0,
                'new_lines' => 'wpautop',
            ],

            vetapteka_acf_tab( 'field_policy_tab_operator', 'Оператор' ),
            vetapteka_acf_text_field(
                'field_policy_operator_name',
                'policy_operator_name',
                'Наименование оператора',
                'Укажите полное наименование или ФИО/бренд владельца сайта.',
                'ВЕТАПТЕКА.ПРО',
                '50'
            ),
            vetapteka_acf_textarea_field(
                'field_policy_operator_address',
                'policy_operator_address',
                'Адрес оператора',
                'Почтовый или фактический адрес для обращений субъектов персональных данных.',
                "г. Москва, ул. Алма-Атинская,\nд. 9, к. 2",
                3,
                '50'
            ),
            vetapteka_acf_text_field(
                'field_policy_operator_email',
                'policy_operator_email',
                'Email для обращений',
                '',
                'info@vetapteka.pro',
                '25'
            ),
            vetapteka_acf_text_field(
                'field_policy_operator_phone',
                'policy_operator_phone',
                'Телефон',
                '',
                '+7 (916) 809-61-36',
                '25'
            ),
            vetapteka_acf_text_field(
                'field_policy_site_domain',
                'policy_site_domain',
                'Домен сайта',
                'Обычно подставляется основной домен.',
                home_url( '/' ),
                '50'
            ),

            vetapteka_acf_tab( 'field_policy_tab_sections', 'Секции документа' ),
            [
                'key'          => 'field_policy_sections',
                'name'         => 'policy_sections',
                'label'        => 'Разделы политики',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Добавить раздел',
                'instructions' => 'Разделы выводятся в том порядке, в котором расположены здесь.',
                'sub_fields'   => [
                    [
                        'key'          => 'field_policy_section_title',
                        'name'         => 'title',
                        'label'        => 'Заголовок раздела',
                        'type'         => 'text',
                        'required'     => 1,
                        'wrapper'      => [ 'width' => '35' ],
                        'instructions' => 'Например: Цели обработки персональных данных.',
                    ],
                    [
                        'key'          => 'field_policy_section_content',
                        'name'         => 'content',
                        'label'        => 'Содержимое раздела',
                        'type'         => 'wysiwyg',
                        'tabs'         => 'all',
                        'toolbar'      => 'basic',
                        'media_upload' => 0,
                        'wrapper'      => [ 'width' => '65' ],
                        'instructions' => 'Можно использовать абзацы, списки и выделение.',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vetapteka-policy',
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

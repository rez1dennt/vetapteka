<?php
/**
 * ВЕТАПТЕКА.ПРО — default ACF content seed
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'acf/init', 'vetapteka_seed_default_acf_content', 20 );

function vetapteka_seed_default_acf_content() {
    if ( ! function_exists( 'update_field' ) ) {
        return;
    }

    $privacy_page_id = vetapteka_ensure_privacy_page();
    vetapteka_sync_footer_privacy_link( $privacy_page_id );
    vetapteka_sync_privacy_page_seo( $privacy_page_id );
    vetapteka_migrate_home_sections_content_to_option_pages();

    $seed_version = '20260322_full_acf_v7';

    if ( get_option( 'vetapteka_acf_seed_version' ) === $seed_version ) {
        return;
    }

    $logo_id             = vetapteka_seed_import_theme_image( 'images/logo.png', 'Логотип ВЕТАПТЕКА.ПРО' );
    $hero_id             = vetapteka_seed_import_theme_image( 'images/nathaniel-yeo-747NDboAWNY-unsplash (1).jpg', 'Hero Vetapteka' );
    $about_id            = vetapteka_seed_import_theme_image( 'images/photo-1576201836106-db1758fd1c97.png', 'О компании' );
    $services_recipes_id = vetapteka_seed_import_theme_image( 'images/services-recipes.jpg', 'Услуги — Рецепты' );
    $services_flavors_id = vetapteka_seed_import_theme_image( 'images/services-flavors.jpg', 'Услуги — Вкусы' );
    $services_doses_id   = vetapteka_seed_import_theme_image( 'images/services-doses.jpg', 'Услуги — Дозы' );
    $solutions_liquid_id = vetapteka_seed_import_theme_image( 'images/solutions-liquid.jpg', 'Решения — Жидкие формы' );
    $solutions_derma_id  = vetapteka_seed_import_theme_image( 'images/solutions-derma.jpg', 'Решения — Дерматология' );
    $solutions_solid_id  = vetapteka_seed_import_theme_image( 'images/solutions-solid.jpg', 'Решения — Твёрдые формы' );
    $approach_clinic_id  = vetapteka_seed_import_theme_image( 'images/approach-clinics.jpg', 'Подход — Клиники' );
    $approach_breeder_id = vetapteka_seed_import_theme_image( 'images/approach-breeders.jpg', 'Подход — Заводчики' );
    $approach_owner_id   = vetapteka_seed_import_theme_image( 'images/approach-owners.jpg', 'Подход — Владельцы' );
    $certificate_id      = vetapteka_seed_import_theme_image( 'images/certificate.webp', 'Лицензия' );
    $placeholder_id      = vetapteka_seed_import_theme_image( 'images/флаконы.jpg', 'Витрина — заглушка' );

    vetapteka_seed_option_if_empty( 'general_logo', $logo_id );
    vetapteka_seed_option_if_empty( 'general_logo_alt', 'Логотип ВЕТАПТЕКА.ПРО' );
    vetapteka_seed_option_if_empty( 'general_brand_main', 'ВЕТАПТЕКА' );
    vetapteka_seed_option_if_empty( 'general_brand_accent', '.ПРО' );
    vetapteka_seed_option_if_empty( 'general_site_tagline', 'Препараты, которых нет в продаже — для тех, кого вы любите' );
    vetapteka_seed_option_if_empty( 'header_nav_links', [
        [ 'link' => [ 'title' => 'О нас', 'url' => '#about', 'target' => '' ] ],
        [ 'link' => [ 'title' => 'Услуги', 'url' => '#services', 'target' => '' ] ],
        [ 'link' => [ 'title' => 'Решения', 'url' => '#solutions', 'target' => '' ] ],
        [ 'link' => [ 'title' => 'Продукция', 'url' => '#vitrina', 'target' => '' ] ],
        [ 'link' => [ 'title' => 'Контакты', 'url' => '#contacts', 'target' => '' ] ],
        [ 'link' => [ 'title' => 'FAQ', 'url' => '#faq', 'target' => '' ] ],
    ] );
    vetapteka_seed_option_if_empty( 'header_cta_link', [
        'title'  => 'Свяжитесь с нами',
        'url'    => 'tel:+79168096136',
        'target' => '',
    ] );
    vetapteka_seed_option_if_empty( 'mobile_cta_link', [
        'title'  => '+7 (916) 809-61-36',
        'url'    => 'tel:+79168096136',
        'target' => '',
    ] );

    vetapteka_seed_option_if_empty( 'hero_eyebrow', 'Компаундинг · Москва' );
    vetapteka_seed_option_if_empty( 'hero_visible', 1 );
    vetapteka_seed_option_if_empty( 'hero_title', 'Препараты для<br>питомцев, которых<br><em>нет в аптеке</em>' );
    vetapteka_seed_option_if_empty( 'hero_subtitle', 'Изготавливаем лекарства по рецепту ветеринара — нужная доза, подходящий вкус, удобная форма. Для кошек, собак, лошадей и экзотов.' );
    vetapteka_seed_option_if_empty( 'hero_button', [
        'title'  => 'Позвонить и заказать',
        'url'    => 'tel:+79168096136',
        'target' => '',
    ] );
    vetapteka_seed_option_if_empty( 'hero_background', $hero_id );
    vetapteka_seed_option_if_empty( 'marquee_visible', 1 );
    vetapteka_seed_option_if_empty( 'marquee_items', [
        [ 'text' => 'Компаундинг' ],
        [ 'text' => 'Рецепты' ],
        [ 'text' => 'Доставка по России' ],
        [ 'text' => 'Лицензия Россельхознадзора' ],
        [ 'text' => 'Жидкие формы' ],
        [ 'text' => 'Дерматология' ],
        [ 'text' => 'Твёрдые формы' ],
        [ 'text' => 'Индивидуальный подход' ],
    ] );
    $home_sections_seed = [
        [ 'acf_fc_layout' => 'about_section', 'is_visible' => 1 ],
        [ 'acf_fc_layout' => 'stats_section', 'is_visible' => 1 ],
        [ 'acf_fc_layout' => 'services_section', 'is_visible' => 1 ],
        [ 'acf_fc_layout' => 'solutions_section', 'is_visible' => 1 ],
        [ 'acf_fc_layout' => 'approach_section', 'is_visible' => 1 ],
        [ 'acf_fc_layout' => 'showcase_section', 'is_visible' => 1 ],
        [ 'acf_fc_layout' => 'certificate_section', 'is_visible' => 1 ],
        [ 'acf_fc_layout' => 'contacts_section', 'is_visible' => 1 ],
        [ 'acf_fc_layout' => 'cta_section', 'is_visible' => 1 ],
        [ 'acf_fc_layout' => 'faq_section', 'is_visible' => 1 ],
    ];

    if ( ! get_field( 'home_sections', 'option' ) ) {
        update_field( 'field_home_sections', $home_sections_seed, 'option' );
    }

    vetapteka_seed_option_if_empty( 'about_label', 'Кто мы' );
    vetapteka_seed_option_if_empty( 'about_visible', 1 );
    vetapteka_seed_option_if_empty( 'about_title', 'Делаем то, чего<br>нет в обычной аптеке' );
    vetapteka_seed_option_if_empty( 'about_text_primary', 'Иногда нужный препарат просто недоступен: нет нужной дозировки, неподходящая форма, животное отказывается принимать. Мы решаем именно эти задачи.' );
    vetapteka_seed_option_if_empty( 'about_text_secondary', 'Наш фармацевтический компаундинг изготавливает препараты по рецептам ветеринаров — с точным расчётом дозы под вес, вид и состояние животного. Работаем официально, по лицензии Россельхознадзора.' );
    vetapteka_seed_option_if_empty( 'about_image', $about_id );
    vetapteka_seed_option_if_empty( 'about_badge_number', '10+' );
    vetapteka_seed_option_if_empty( 'about_badge_text', 'лет опыта' );
    vetapteka_seed_option_if_empty( 'about_features', [
        [ 'text' => 'Лицензия Россельхознадзора №Л042-00118-77/03607161' ],
        [ 'text' => 'Доставка по всей России — курьером или транспортной компанией' ],
        [ 'text' => 'Срок изготовления — от 3 до 5 рабочих дней' ],
        [ 'text' => 'Жидкие, твёрдые и дерматологические формы, любые вкусы' ],
    ] );

    vetapteka_seed_option_if_empty( 'stats_items', [
        [ 'value' => '10+', 'label' => 'лет на рынке' ],
        [ 'value' => '500+', 'label' => 'рецептов в месяц' ],
        [ 'value' => '12+', 'label' => 'форм препаратов' ],
        [ 'value' => '∞', 'label' => 'забота о питомцах' ],
    ] );

    vetapteka_seed_option_if_empty( 'services_label', 'Что мы делаем' );
    vetapteka_seed_option_if_empty( 'services_title', 'Наши услуги' );
    vetapteka_seed_option_if_empty( 'services_cards', [
        [
            'image'       => $services_recipes_id,
            'title'       => 'Рецепты',
            'description' => 'Создаём препараты с учётом веса и особенностей вашего любимца по ветеринарному рецепту.',
            'button'      => [ 'title' => 'Заказать', 'url' => 'tel:+79168096136', 'target' => '' ],
        ],
        [
            'image'       => $services_flavors_id,
            'title'       => 'Вкусы',
            'description' => 'Подбираем вкусные добавки, чтобы лечение стало приятным лакомством для питомца.',
            'button'      => [ 'title' => 'Заказать', 'url' => 'tel:+79168096136', 'target' => '' ],
        ],
        [
            'image'       => $services_doses_id,
            'title'       => 'Дозы',
            'description' => 'Точные дозировки, рассчитанные специально под вес и физиологию вашего животного.',
            'button'      => [ 'title' => 'Заказать', 'url' => 'tel:+79168096136', 'target' => '' ],
        ],
    ] );

    vetapteka_seed_option_if_empty( 'solutions_label', 'Формы препаратов.' );
    vetapteka_seed_option_if_empty( 'solutions_title', 'Наши решения' );
    vetapteka_seed_option_if_empty( 'solutions_cards', [
        [
            'image'       => $solutions_liquid_id,
            'title'       => 'Жидкие формы',
            'description' => 'Индивидуальные суспензии, пасты, растворы, капли, настои.',
            'button'      => [ 'title' => 'Заказать', 'url' => 'tel:+79168096136', 'target' => '' ],
        ],
        [
            'image'       => $solutions_derma_id,
            'title'       => 'Дерматология',
            'description' => 'Крема, мази, гели, присыпки, порошки.',
            'button'      => [ 'title' => 'Заказать', 'url' => 'tel:+79168096136', 'target' => '' ],
        ],
        [
            'image'       => $solutions_solid_id,
            'title'       => 'Твёрдые формы',
            'description' => 'Жевательные таблетки, суппозитории, болюсы, порошки, пилюли.',
            'button'      => [ 'title' => 'Заказать', 'url' => 'tel:+79168096136', 'target' => '' ],
        ],
    ] );

    vetapteka_seed_option_if_empty( 'approach_label', 'Для кого мы работаем' );
    vetapteka_seed_option_if_empty( 'approach_title', 'Индивидуальный подход к лечению' );
    vetapteka_seed_option_if_empty( 'approach_subtitle', 'Наш подход к компаундингу позволяет создавать лекарства, которые идеально подходят под физиологию и вес вашего животного, обеспечивая наилучший лечебный эффект.' );
    vetapteka_seed_option_if_empty( 'approach_cards', [
        [
            'image'       => $approach_clinic_id,
            'title'       => 'Ветеринарным клиникам',
            'description' => 'Работаем с малыми и большими дозами, изготавливаем сложные препараты для клинической практики.',
            'button'      => [ 'title' => 'Заказать', 'url' => 'tel:+79168096136', 'target' => '' ],
        ],
        [
            'image'       => $approach_breeder_id,
            'title'       => 'Заводчикам',
            'description' => 'Работаем с питомниками и племенными хозяйствами: профилактика, поддержание здоровья, улучшение фертильности.',
            'button'      => [ 'title' => 'Заказать', 'url' => 'tel:+79168096136', 'target' => '' ],
        ],
        [
            'image'       => $approach_owner_id,
            'title'       => 'Владельцам животных',
            'description' => 'Упрощаем схему приёма и подбираем удобную форму препарата именно под вашего питомца.',
            'button'      => [ 'title' => 'Заказать', 'url' => 'tel:+79168096136', 'target' => '' ],
        ],
    ] );

    vetapteka_seed_option_if_empty( 'certificate_label', 'Лицензия' );
    vetapteka_seed_option_if_empty( 'certificate_title', 'Сертифицированная аптека' );
    vetapteka_seed_option_if_empty( 'certificate_text', 'Мы работаем строго по лицензии Россельхознадзора, обеспечивая высочайшее качество каждого изготовленного препарата для здоровья ваших питомцев.' );
    vetapteka_seed_option_if_empty( 'certificate_image', $certificate_id );
    vetapteka_seed_option_if_empty( 'certificate_zoom_hint', 'Нажмите для просмотра' );
    vetapteka_seed_option_if_empty( 'certificate_details', [
        [ 'label' => 'Номер лицензии:', 'value' => 'Л042-00118-77/03607161', 'is_highlight' => 0 ],
        [ 'label' => 'Срок действия:', 'value' => 'Бессрочная', 'is_highlight' => 0 ],
        [ 'label' => 'Дата выдачи:', 'value' => '24.10.2025', 'is_highlight' => 0 ],
        [ 'label' => 'Статус:', 'value' => 'Действует', 'is_highlight' => 1 ],
    ] );
    vetapteka_seed_option_if_empty( 'certificate_button', [
        'title'  => 'Заказать препарат',
        'url'    => 'tel:+79168096136',
        'target' => '',
    ] );

    vetapteka_seed_option_if_empty( 'cta_title', 'Ветеринар выписал рецепт? Мы сами свяжемся с ним и уточним дозировки!' );
    vetapteka_seed_option_if_empty( 'cta_text', 'Звоните — и через 3–5 дней нужный препарат будет у вас.' );
    vetapteka_seed_option_if_empty( 'cta_button', [
        'title'  => '+7 (916) 809-61-36',
        'url'    => 'tel:+79168096136',
        'target' => '',
    ] );

    vetapteka_seed_option_if_empty( 'faq_label', 'Вопросы и ответы' );
    vetapteka_seed_option_if_empty( 'faq_title', 'Частые вопросы' );
    vetapteka_seed_option_if_empty( 'faq_subtitle', 'Ответы на самые частые вопросы о нашей работе.' );
    vetapteka_seed_option_if_empty( 'faq_items', [
        [
            'question' => 'Как сделать заказ?',
            'answer'   => 'Позвоните нам по номеру +7 (916) 809-61-36 и расскажите о питомце и рецепте ветеринара. Мы уточним вид животного, вес, нужную форму и вкус — и рассчитаем итоговую стоимость.',
        ],
        [
            'question' => 'Вы работаете официально?',
            'answer'   => 'Да. Мы работаем по лицензии Россельхознадзора №Л042-00118-77/03607161 на фармацевтическую деятельность.',
        ],
        [
            'question' => 'В каких формах вы изготавливаете препараты?',
            'answer'   => 'Мы изготавливаем жидкие формы, дерматологические средства, а также твёрдые формы с удобными вкусовыми добавками.',
        ],
        [
            'question' => 'Сколько времени занимает изготовление?',
            'answer'   => 'Стандартный срок изготовления — 3–5 рабочих дней. При срочных запросах свяжитесь с нами напрямую.',
        ],
    ] );

    vetapteka_seed_option_if_empty( 'contacts_label', 'Где нас найти' );
    vetapteka_seed_option_if_empty( 'contacts_visible', 1 );
    vetapteka_seed_option_if_empty( 'contacts_title', 'Контакты' );
    vetapteka_seed_option_if_empty( 'contacts_address_title', 'Наш адрес' );
    vetapteka_seed_option_if_empty( 'contacts_address_text', 'г. Москва, ул. Алма-Атинская, д. 9, к. 2' );
    vetapteka_seed_option_if_empty( 'contacts_delivery_title', 'Доставка' );
    vetapteka_seed_option_if_empty( 'contacts_delivery_text', 'Работаем в формате доставки по всей России' );
    vetapteka_seed_option_if_empty( 'contacts_phone_title', 'Телефон' );
    vetapteka_seed_option_if_empty( 'contacts_phone_display', '+7 (916) 809-61-36' );
    vetapteka_seed_option_if_empty( 'contacts_phone_raw', '+79168096136' );
    vetapteka_seed_option_if_empty( 'contacts_email_title', 'Email' );
    vetapteka_seed_option_if_empty( 'contacts_email', 'info@vetapteka.pro' );
    vetapteka_seed_option_if_empty( 'contacts_worktime_title', 'Режим работы' );
    vetapteka_seed_option_if_empty( 'contacts_worktime_text', "Пн–Пт 09:00–18:00\nСб–Вс по договорённости" );
    vetapteka_seed_option_if_empty( 'contacts_map_title', 'Расположение ветеринарной аптеки ВЕТАПТЕКА.ПРО на карте Москвы' );
    vetapteka_seed_option_if_empty( 'contacts_map_embed_url', 'https://yandex.ru/map-widget/v1/?ll=37.772927%2C55.639380&z=16&l=map&pt=37.772927%2C55.639380,pm2rdm' );
    vetapteka_seed_option_if_empty( 'contacts_latitude', '55.639380' );
    vetapteka_seed_option_if_empty( 'contacts_longitude', '37.772927' );

    vetapteka_seed_option_if_empty( 'footer_tagline', 'Препараты, которых нет в продаже — для тех, кого вы любите' );
    vetapteka_seed_option_if_empty( 'footer_visible', 1 );
    vetapteka_seed_option_if_empty( 'footer_license_badge', 'Лицензия №Л042-00118-77/03607161' );
    vetapteka_seed_option_if_empty( 'footer_nav_heading', 'Разделы' );
    vetapteka_seed_option_if_empty( 'footer_nav_links', [
        [ 'link' => [ 'title' => 'О нас', 'url' => '#about', 'target' => '' ] ],
        [ 'link' => [ 'title' => 'Услуги', 'url' => '#services', 'target' => '' ] ],
        [ 'link' => [ 'title' => 'Решения', 'url' => '#solutions', 'target' => '' ] ],
        [ 'link' => [ 'title' => 'Подход', 'url' => '#approach', 'target' => '' ] ],
        [ 'link' => [ 'title' => 'Продукция', 'url' => '#vitrina', 'target' => '' ] ],
        [ 'link' => [ 'title' => 'Лицензия', 'url' => '#certificate', 'target' => '' ] ],
        [ 'link' => [ 'title' => 'Контакты', 'url' => '#contacts', 'target' => '' ] ],
        [ 'link' => [ 'title' => 'FAQ', 'url' => '#faq', 'target' => '' ] ],
    ] );
    vetapteka_seed_option_if_empty( 'footer_contact_heading', 'Связаться' );
    vetapteka_seed_option_if_empty( 'footer_phone_display', '+7 (916) 809-61-36' );
    vetapteka_seed_option_if_empty( 'footer_phone_raw', '+79168096136' );
    vetapteka_seed_option_if_empty( 'footer_address', "г. Москва, ул. Алма-Атинская,\nд. 9, к. 2" );
    vetapteka_seed_option_if_empty( 'footer_delivery_note', 'Доставка по всей России' );
    vetapteka_seed_option_if_empty( 'footer_copyright', '© {year} ВЕТАПТЕКА.ПРО. Все права защищены.' );
    vetapteka_seed_option_if_empty( 'footer_privacy_link', [
        'title'  => 'Политика конфиденциальности',
        'url'    => vetapteka_get_privacy_page_url( $privacy_page_id ),
        'target' => '',
    ] );
    vetapteka_seed_option_if_empty( 'footer_bottom_note', 'Работаем по лицензии Россельхознадзора' );

    vetapteka_seed_option_if_empty( 'policy_page_title', 'Политика конфиденциальности' );
    vetapteka_seed_option_if_empty( 'policy_intro', 'На этой странице описано, какие персональные данные могут обрабатываться при использовании сайта, для каких целей это делается, на каких основаниях и каким образом пользователь может реализовать свои права.' );
    vetapteka_seed_option_if_empty( 'policy_last_updated', date_i18n( 'd.m.Y' ) );
    vetapteka_seed_option_if_empty( 'policy_operator_name', 'ВЕТАПТЕКА.ПРО' );
    vetapteka_seed_option_if_empty( 'policy_operator_address', "г. Москва, ул. Алма-Атинская,\nд. 9, к. 2" );
    vetapteka_seed_option_if_empty( 'policy_operator_email', 'info@vetapteka.pro' );
    vetapteka_seed_option_if_empty( 'policy_operator_phone', '+7 (916) 809-61-36' );
    vetapteka_seed_option_if_empty( 'policy_site_domain', home_url( '/' ) );
    vetapteka_seed_option_if_empty( 'policy_sections', [
        [
            'title'   => '1. Общие положения',
            'content' => '<p>Настоящая Политика конфиденциальности и обработки персональных данных определяет порядок обработки и меры по защите персональных данных, которые могут быть получены при использовании сайта ВЕТАПТЕКА.ПРО, а также при обращении по контактам, указанным на сайте.</p><p>Политика разработана с учетом требований законодательства Российской Федерации о персональных данных и применяется ко всей информации, которую оператор может получить о посетителях сайта, клиентах и иных лицах, взаимодействующих с оператором через сайт, электронную почту, телефон и иные каналы связи.</p><p>Использование сайта означает ознакомление пользователя с настоящей Политикой.</p>',
        ],
        [
            'title'   => '2. Какие данные могут обрабатываться',
            'content' => '<p>В зависимости от ситуации оператор может обрабатывать следующие категории персональных данных:</p><ul><li>фамилию, имя, отчество;</li><li>номер телефона;</li><li>адрес электронной почты;</li><li>сведения об организации, должности и реквизитах обращения, если такие данные добровольно предоставлены пользователем;</li><li>содержание обращения, заявки или переписки;</li><li>технические данные: IP-адрес, сведения о браузере, устройстве, файлы cookie, дата и время обращения, адреса запрашиваемых страниц, технические журналы сервера.</li></ul><p>Оператор не стремится получать избыточные персональные данные и не запрашивает специальные категории персональных данных, если это не требуется законодательством или не предоставлено пользователем добровольно в рамках его обращения.</p>',
        ],
        [
            'title'   => '3. Цели обработки персональных данных',
            'content' => '<p>Персональные данные обрабатываются для следующих целей:</p><ul><li>обработка обращений пользователей и обратная связь;</li><li>консультирование по вопросам продукции, наличия, рецептурных форм и условий взаимодействия;</li><li>подготовка, заключение и исполнение договоров;</li><li>ведение деловой переписки и документооборота;</li><li>обеспечение корректной работы сайта, информационной безопасности и защиты от злоупотреблений;</li><li>исполнение обязанностей, возложенных на оператора законодательством Российской Федерации.</li></ul>',
        ],
        [
            'title'   => '4. Правовые основания обработки',
            'content' => '<p>Оператор обрабатывает персональные данные на следующих правовых основаниях:</p><ul><li>согласие субъекта персональных данных;</li><li>необходимость обработки для заключения и исполнения договора либо для совершения действий по инициативе субъекта персональных данных до заключения договора;</li><li>исполнение обязанностей, установленных законодательством Российской Федерации;</li><li>осуществление прав и законных интересов оператора при условии, что при этом не нарушаются права и свободы субъекта персональных данных.</li></ul>',
        ],
        [
            'title'   => '5. Порядок, сроки хранения и уничтожение данных',
            'content' => '<p>Обработка персональных данных может осуществляться с использованием средств автоматизации, без их использования либо смешанным способом.</p><p>Персональные данные хранятся не дольше, чем этого требуют цели обработки, если иной срок не установлен законодательством Российской Федерации, договором или обязательными правилами хранения документов.</p><p>По достижении целей обработки, при утрате необходимости в обработке либо при наличии законных оснований для прекращения обработки персональные данные подлежат удалению, уничтожению или обезличиванию в разумный срок, если иное не предусмотрено законодательством Российской Федерации.</p>',
        ],
        [
            'title'   => '6. Передача данных третьим лицам',
            'content' => '<p>Оператор не распространяет персональные данные и не передает их третьим лицам без надлежащих правовых оснований.</p><p>Передача персональных данных допускается:</p><ul><li>лицам, привлеченным оператором для обеспечения работы сайта, хостинга, связи и технической поддержки, при условии соблюдения ими требований конфиденциальности и безопасности;</li><li>государственным органам и иным уполномоченным лицам в случаях, прямо предусмотренных законодательством Российской Федерации;</li><li>иным лицам с согласия субъекта персональных данных либо по его поручению.</li></ul><p>Трансграничная передача персональных данных не осуществляется, за исключением случаев, когда такая передача необходима и допускается законодательством Российской Федерации.</p>',
        ],
        [
            'title'   => '7. Файлы cookie и технические данные',
            'content' => '<p>Сайт может использовать технические cookie-файлы и аналогичные технологии, необходимые для корректной работы страниц, навигации, запоминания пользовательских действий и обеспечения безопасности.</p><p>Также автоматически могут фиксироваться технические сведения, связанные с обращением к сайту: IP-адрес, данные браузера, дата и время запроса, адреса запрашиваемых страниц, информация об ошибках и иных событиях системы.</p><p>Пользователь может изменить настройки браузера и ограничить использование cookie, однако это может повлиять на работоспособность отдельных функций сайта.</p><p>При сборе персональных данных граждан Российской Федерации оператор обеспечивает запись, систематизацию, накопление, хранение и иные операции с использованием баз данных, находящихся на территории Российской Федерации, если иной порядок не предусмотрен законодательством.</p>',
        ],
        [
            'title'   => '8. Права субъекта персональных данных',
            'content' => '<p>Субъект персональных данных вправе:</p><ul><li>получать сведения о факте, правовых основаниях, целях, способах и сроках обработки его персональных данных;</li><li>требовать уточнения, блокирования или уничтожения персональных данных, если они являются неполными, устаревшими, неточными, незаконно полученными либо не являются необходимыми для заявленной цели обработки;</li><li>отозвать согласие на обработку персональных данных, если обработка основана на согласии;</li><li>обжаловать действия или бездействие оператора в уполномоченный орган по защите прав субъектов персональных данных или в судебном порядке;</li><li>осуществлять иные права, предусмотренные законодательством Российской Федерации.</li></ul>',
        ],
        [
            'title'   => '9. Меры по защите персональных данных',
            'content' => '<p>Оператор принимает необходимые правовые, организационные и технические меры для защиты персональных данных от неправомерного или случайного доступа, уничтожения, изменения, блокирования, копирования, предоставления, распространения, а также от иных неправомерных действий.</p><p>В частности, применяются меры разграничения доступа, защита учетных записей, резервное копирование, контроль актуальности программного обеспечения и иные разумно достаточные меры безопасности, соответствующие характеру и объему обрабатываемых данных.</p>',
        ],
        [
            'title'   => '10. Обращения и изменение Политики',
            'content' => '<p>Запросы, связанные с обработкой персональных данных, можно направлять оператору по контактам, указанным на этой странице и в разделе «Контакты» сайта.</p><p>Оператор вправе вносить изменения в настоящую Политику. Актуальная редакция всегда размещается на сайте в открытом доступе. Новая редакция вступает в силу с момента ее публикации, если иное не предусмотрено новой редакцией Политики.</p>',
        ],
    ] );

    vetapteka_seed_option_if_empty( 'vitrina_visible', 1 );
    vetapteka_seed_option_if_empty( 'vitrina_label', 'Ассортимент' );
    vetapteka_seed_option_if_empty( 'vitrina_title', 'Наши препараты' );
    vetapteka_seed_option_if_empty( 'vitrina_subtitle', 'Часть препаратов мы изготавливаем индивидуально по рецепту ветеринара. Примеры ниже показывают возможные формы и решения.' );
    vetapteka_seed_option_if_empty( 'vitrina_placeholder', $placeholder_id );
    vetapteka_seed_option_if_empty( 'vitrina_placeholder_text', 'Ассортимент препаратов формируется. Свяжитесь с нами для уточнения наличия.' );
    vetapteka_seed_option_if_empty( 'vitrina_placeholder_alt', 'Ассортимент препаратов ВЕТАПТЕКА.ПРО' );
    vetapteka_seed_option_if_empty( 'vitrina_placeholder_button_text', 'Узнать наличие' );
    vetapteka_seed_option_if_empty( 'vitrina_more_button_text', 'Показать ещё' );
    vetapteka_seed_option_if_empty( 'vitrina_more_count_label', 'ещё' );
    vetapteka_seed_option_if_empty( 'vitrina_card_button_text', 'Заказать' );
    vetapteka_seed_option_if_empty( 'vitrina_unavailable_badge_text', 'Нет в наличии' );

    update_option( 'vetapteka_acf_seed_version', $seed_version );
}

function vetapteka_seed_option_if_empty( string $field_name, $value ): void {
    $current = get_field( $field_name, 'option' );

    if ( ! empty( $current ) || $current === '0' || $current === 0 ) {
        return;
    }

    if ( $value === null || $value === '' || $value === [] || $value === 0 ) {
        return;
    }

    update_field( $field_name, $value, 'option' );
}

function vetapteka_migrate_home_sections_content_to_option_pages(): void {
    $migration_version = '20260322_home_sections_to_options_v1';

    if ( get_option( 'vetapteka_home_sections_content_migration' ) === $migration_version ) {
        return;
    }

    $layouts = vetapteka_get_legacy_home_sections_layouts();

    foreach ( $layouts as $index => $layout ) {
        switch ( $layout ) {
            case 'stats_section':
                vetapteka_seed_option_if_empty(
                    'stats_items',
                    vetapteka_get_legacy_home_section_rows( $index, 'items', [ 'value', 'label' ] )
                );
                break;

            case 'services_section':
                vetapteka_seed_option_if_empty( 'services_label', vetapteka_get_legacy_home_section_value( $index, 'section_label', '' ) );
                vetapteka_seed_option_if_empty( 'services_title', vetapteka_get_legacy_home_section_value( $index, 'section_title', '' ) );
                vetapteka_seed_option_if_empty(
                    'services_cards',
                    vetapteka_get_legacy_home_section_rows( $index, 'cards', [ 'image', 'title', 'description', 'button' ] )
                );
                break;

            case 'solutions_section':
                vetapteka_seed_option_if_empty( 'solutions_label', vetapteka_get_legacy_home_section_value( $index, 'section_label', '' ) );
                vetapteka_seed_option_if_empty( 'solutions_title', vetapteka_get_legacy_home_section_value( $index, 'section_title', '' ) );
                vetapteka_seed_option_if_empty(
                    'solutions_cards',
                    vetapteka_get_legacy_home_section_rows( $index, 'cards', [ 'image', 'title', 'description', 'button' ] )
                );
                break;

            case 'approach_section':
                vetapteka_seed_option_if_empty( 'approach_label', vetapteka_get_legacy_home_section_value( $index, 'section_label', '' ) );
                vetapteka_seed_option_if_empty( 'approach_title', vetapteka_get_legacy_home_section_value( $index, 'section_title', '' ) );
                vetapteka_seed_option_if_empty( 'approach_subtitle', vetapteka_get_legacy_home_section_value( $index, 'section_subtitle', '' ) );
                vetapteka_seed_option_if_empty(
                    'approach_cards',
                    vetapteka_get_legacy_home_section_rows( $index, 'cards', [ 'image', 'title', 'description', 'button' ] )
                );
                break;

            case 'certificate_section':
                vetapteka_seed_option_if_empty( 'certificate_label', vetapteka_get_legacy_home_section_value( $index, 'section_label', '' ) );
                vetapteka_seed_option_if_empty( 'certificate_title', vetapteka_get_legacy_home_section_value( $index, 'section_title', '' ) );
                vetapteka_seed_option_if_empty( 'certificate_text', vetapteka_get_legacy_home_section_value( $index, 'section_text', '' ) );
                vetapteka_seed_option_if_empty( 'certificate_image', vetapteka_get_legacy_home_section_value( $index, 'image', null ) );
                vetapteka_seed_option_if_empty( 'certificate_zoom_hint', vetapteka_get_legacy_home_section_value( $index, 'zoom_hint', '' ) );
                vetapteka_seed_option_if_empty(
                    'certificate_details',
                    vetapteka_get_legacy_home_section_rows( $index, 'details', [ 'label', 'value', 'is_highlight' ] )
                );
                vetapteka_seed_option_if_empty( 'certificate_button', vetapteka_get_legacy_home_section_value( $index, 'button', [] ) );
                break;

            case 'cta_section':
                vetapteka_seed_option_if_empty( 'cta_title', vetapteka_get_legacy_home_section_value( $index, 'section_title', '' ) );
                vetapteka_seed_option_if_empty( 'cta_text', vetapteka_get_legacy_home_section_value( $index, 'section_text', '' ) );
                vetapteka_seed_option_if_empty( 'cta_button', vetapteka_get_legacy_home_section_value( $index, 'button', [] ) );
                break;

            case 'faq_section':
                vetapteka_seed_option_if_empty( 'faq_label', vetapteka_get_legacy_home_section_value( $index, 'section_label', '' ) );
                vetapteka_seed_option_if_empty( 'faq_title', vetapteka_get_legacy_home_section_value( $index, 'section_title', '' ) );
                vetapteka_seed_option_if_empty( 'faq_subtitle', vetapteka_get_legacy_home_section_value( $index, 'section_subtitle', '' ) );
                vetapteka_seed_option_if_empty(
                    'faq_items',
                    vetapteka_get_legacy_home_section_rows( $index, 'items', [ 'question', 'answer' ] )
                );
                break;
        }
    }

    update_option( 'vetapteka_home_sections_content_migration', $migration_version );
}

function vetapteka_get_legacy_home_sections_layouts(): array {
    $layouts = get_option( 'options_home_sections', [] );

    return is_array( $layouts ) ? array_values( $layouts ) : [];
}

function vetapteka_get_legacy_home_section_value( int $index, string $field, $default = '' ) {
    $value = get_option( 'options_home_sections_' . $index . '_' . $field, null );

    return $value === null ? $default : $value;
}

function vetapteka_get_legacy_home_section_rows( int $index, string $field, array $sub_fields ): array {
    $count = (int) get_option( 'options_home_sections_' . $index . '_' . $field, 0 );

    if ( $count <= 0 ) {
        return [];
    }

    $rows = [];

    for ( $row_index = 0; $row_index < $count; $row_index++ ) {
        $row = [];

        foreach ( $sub_fields as $sub_field ) {
            $value = get_option( 'options_home_sections_' . $index . '_' . $field . '_' . $row_index . '_' . $sub_field, null );

            if ( $value === null || $value === '' || $value === [] ) {
                continue;
            }

            $row[ $sub_field ] = $value;
        }

        if ( ! empty( $row ) ) {
            $rows[] = $row;
        }
    }

    return $rows;
}

function vetapteka_ensure_privacy_page(): int {
    $page = get_page_by_path( 'privacy', OBJECT, 'page' );

    if ( $page instanceof WP_Post ) {
        if ( $page->post_status !== 'publish' ) {
            wp_update_post( [
                'ID'          => $page->ID,
                'post_status' => 'publish',
            ] );
        }

        return (int) $page->ID;
    }

    return (int) wp_insert_post( [
        'post_type'    => 'page',
        'post_status'  => 'publish',
        'post_title'   => 'Политика конфиденциальности',
        'post_name'    => 'privacy',
        'post_content' => '',
    ] );
}

function vetapteka_sync_footer_privacy_link( int $privacy_page_id ): void {
    if ( $privacy_page_id <= 0 ) {
        return;
    }

    $permalink = get_permalink( $privacy_page_id );
    $permalink = vetapteka_get_privacy_page_url( $privacy_page_id );

    if ( ! $permalink ) {
        return;
    }

    $link         = get_field( 'footer_privacy_link', 'option' );
    $current_url  = is_array( $link ) ? (string) ( $link['url'] ?? '' ) : '';
    $current_text = is_array( $link ) ? (string) ( $link['title'] ?? '' ) : '';
    $current_tgt  = is_array( $link ) ? (string) ( $link['target'] ?? '' ) : '';
    $is_default   = $current_url === ''
        || strpos( $current_url, '/privacy' ) !== false
        || strpos( $current_url, 'page_id=' ) !== false;

    if ( ! $is_default && $current_url !== $permalink ) {
        return;
    }

    if ( $current_url === $permalink && $current_text !== '' ) {
        return;
    }

    update_option(
        'options_footer_privacy_link',
        [
            'title'  => $current_text ?: 'Политика конфиденциальности',
            'url'    => $permalink,
            'target' => $current_tgt,
        ]
    );
    update_option( '_options_footer_privacy_link', 'field_footer_privacy_link' );
}

function vetapteka_get_privacy_page_url( int $privacy_page_id ): string {
    if ( $privacy_page_id <= 0 ) {
        return home_url( '/privacy/' );
    }

    $structure = (string) get_option( 'permalink_structure' );

    if ( $structure !== '' ) {
        $permalink = get_permalink( $privacy_page_id );

        if ( $permalink ) {
            return $permalink;
        }
    }

    return home_url( '/?page_id=' . $privacy_page_id );
}

function vetapteka_sync_privacy_page_seo( int $privacy_page_id ): void {
    if ( $privacy_page_id <= 0 ) {
        return;
    }

    $title = trim( 'Политика конфиденциальности | ' . (string) get_bloginfo( 'name' ) );
    $desc  = 'Политика конфиденциальности и обработки персональных данных сайта ВЕТАПТЕКА.ПРО: цели обработки, правовые основания, сроки хранения, права субъектов и контакты для обращений.';

    if ( ! get_post_meta( $privacy_page_id, '_yoast_wpseo_title', true ) ) {
        update_post_meta( $privacy_page_id, '_yoast_wpseo_title', $title );
    }

    if ( ! get_post_meta( $privacy_page_id, '_yoast_wpseo_metadesc', true ) ) {
        update_post_meta( $privacy_page_id, '_yoast_wpseo_metadesc', $desc );
    }

    if ( ! get_post_meta( $privacy_page_id, '_yoast_wpseo_focuskw', true ) ) {
        update_post_meta( $privacy_page_id, '_yoast_wpseo_focuskw', 'политика конфиденциальности' );
    }
}

function vetapteka_seed_import_theme_image( string $relative_path, string $title ): int {
    $cache_key = 'vetapteka_seed_media_' . md5( $relative_path );
    $cached    = (int) get_option( $cache_key );

    if ( $cached && get_post( $cached ) ) {
        return $cached;
    }

    $source = trailingslashit( get_template_directory() ) . ltrim( $relative_path, '/\\' );

    if ( ! file_exists( $source ) ) {
        return 0;
    }

    $uploads = wp_upload_dir();

    if ( ! empty( $uploads['error'] ) ) {
        return 0;
    }

    $filename = wp_unique_filename( $uploads['path'], wp_basename( $source ) );
    $target   = trailingslashit( $uploads['path'] ) . $filename;

    if ( ! copy( $source, $target ) ) {
        return 0;
    }

    $filetype = wp_check_filetype( $filename, null );
    $attach_id = wp_insert_attachment(
        [
            'post_mime_type' => $filetype['type'],
            'post_title'     => $title,
            'post_status'    => 'inherit',
        ],
        $target
    );

    if ( is_wp_error( $attach_id ) || ! $attach_id ) {
        return 0;
    }

    require_once ABSPATH . 'wp-admin/includes/image.php';

    $metadata = wp_generate_attachment_metadata( $attach_id, $target );
    wp_update_attachment_metadata( $attach_id, $metadata );
    update_option( $cache_key, $attach_id );

    return (int) $attach_id;
}

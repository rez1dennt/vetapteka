<?php
/**
 * Services section wrapper
 */

get_template_part( 'template-parts/sections/cards-section', null, [
    'section_class' => 'section-dark services',
    'section_id'    => 'services',
    'section_num'   => $args['section_num'] ?? '',
    'label'         => vetapteka_get_option_value( 'services_label', '' ),
    'title'         => vetapteka_get_option_value( 'services_title', '' ),
    'subtitle'      => '',
    'cards'         => get_field( 'services_cards', 'option' ) ?: [],
    'grid_class'    => 'cards-grid',
    'card_class'    => 'card',
] );

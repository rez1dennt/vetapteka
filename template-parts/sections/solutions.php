<?php
/**
 * Solutions section wrapper
 */

get_template_part( 'template-parts/sections/cards-section', null, [
    'section_class' => 'solutions',
    'section_id'    => 'solutions',
    'section_num'   => $args['section_num'] ?? '',
    'label'         => vetapteka_get_option_value( 'solutions_label', '' ),
    'title'         => vetapteka_get_option_value( 'solutions_title', '' ),
    'subtitle'      => '',
    'cards'         => get_field( 'solutions_cards', 'option' ) ?: [],
    'grid_class'    => 'cards-grid cards-grid-alt',
    'card_class'    => 'card card-light',
] );

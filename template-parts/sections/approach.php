<?php
/**
 * Approach section wrapper
 */

get_template_part( 'template-parts/sections/cards-section', null, [
    'section_class' => 'approach section-dark',
    'section_id'    => 'approach',
    'section_num'   => $args['section_num'] ?? '',
    'label'         => vetapteka_get_option_value( 'approach_label', '' ),
    'title'         => vetapteka_get_option_value( 'approach_title', '' ),
    'subtitle'      => vetapteka_get_option_value( 'approach_subtitle', '' ),
    'cards'         => get_field( 'approach_cards', 'option' ) ?: [],
    'grid_class'    => 'cards-grid',
    'card_class'    => 'card',
] );

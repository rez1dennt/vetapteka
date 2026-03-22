<?php
/**
 * Showcase section wrapper
 */

get_template_part( 'template-parts/showcase/index', null, [
    'section_num' => $args['section_num'] ?? '',
] );

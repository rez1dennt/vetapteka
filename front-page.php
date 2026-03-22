<?php
/**
 * Front page template — ВЕТАПТЕКА.ПРО
 */

get_header();

$template_map = [
    'about_section'       => 'about',
    'stats_section'       => 'stats',
    'services_section'    => 'services',
    'solutions_section'   => 'solutions',
    'approach_section'    => 'approach',
    'showcase_section'    => 'showcase',
    'certificate_section' => 'certificate',
    'contacts_section'    => 'contacts',
    'cta_section'         => 'cta',
    'faq_section'         => 'faq',
];

$numbered_layouts = [
    'about_section',
    'services_section',
    'solutions_section',
    'approach_section',
    'showcase_section',
    'certificate_section',
    'contacts_section',
    'faq_section',
];
?>

<main id="main-content">
  <?php if ( vetapteka_get_option_value( 'hero_visible', 1 ) ) : ?>
    <?php get_template_part( 'template-parts/sections/hero' ); ?>
  <?php endif; ?>

  <?php if ( vetapteka_get_option_value( 'marquee_visible', 1 ) ) : ?>
    <?php get_template_part( 'template-parts/sections/marquee' ); ?>
  <?php endif; ?>

  <?php if ( have_rows( 'home_sections', 'option' ) ) : ?>
    <?php $section_index = 1; ?>
    <?php while ( have_rows( 'home_sections', 'option' ) ) : the_row(); ?>
      <?php
      $layout = get_row_layout();
      $slug   = $template_map[ $layout ] ?? '';

      if ( ! $slug || ! vetapteka_should_render_home_section( $layout ) ) {
          continue;
      }

      $args = [];

      if ( in_array( $layout, $numbered_layouts, true ) ) {
          $args['section_num'] = vetapteka_section_number( $section_index );
          $section_index++;
      }

      get_template_part( 'template-parts/sections/' . $slug, null, $args );
      ?>
    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>

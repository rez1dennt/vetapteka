<?php
/**
 * Privacy policy page template
 */

get_header();

$title          = vetapteka_get_option_value( 'policy_page_title', get_the_title() );
$intro          = vetapteka_get_option_value( 'policy_intro', '' );
$updated        = vetapteka_get_option_value( 'policy_last_updated', '' );
$operator_name  = vetapteka_get_option_value( 'policy_operator_name', '' );
$operator_email = vetapteka_get_option_value( 'policy_operator_email', '' );
$operator_phone = vetapteka_get_option_value( 'policy_operator_phone', '' );
$operator_addr  = vetapteka_get_option_value( 'policy_operator_address', '' );
$sections       = get_field( 'policy_sections', 'option' ) ?: [];
?>

<main id="main-content" class="legal-page">
  <section class="legal-hero section-dark">
    <div class="container">
      <div class="section-header legal-hero__header">
        <span class="label label-center">Правовая информация</span>
        <h1 class="section-title section-title-center" id="policy-title"><?php echo esc_html( $title ); ?></h1>
        <?php if ( $intro ) : ?>
          <p class="section-subtitle"><?php echo vetapteka_format_multiline_text( $intro ); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section class="legal-body">
    <div class="container legal-shell">
      <aside class="legal-sidebar">
        <?php if ( ! empty( $sections ) ) : ?>
          <nav class="legal-toc" aria-label="Навигация по политике">
            <p class="legal-toc__title">Содержание</p>
            <ul class="legal-toc__list" role="list">
              <?php foreach ( $sections as $index => $section ) : ?>
                <?php
                $section_title = $section['title'] ?? '';
                $display_title = preg_replace( '/^\d+\.\s*/u', '', $section_title );
                $section_num   = str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT );

                if ( ! $display_title ) :
                ?>
                  <?php continue; ?>
                <?php endif; ?>
                <li>
                  <a href="#policy-section-<?php echo esc_attr( $index + 1 ); ?>" class="legal-toc__link">
                    <span class="legal-toc__num"><?php echo esc_html( $section_num ); ?></span>
                    <?php echo esc_html( $display_title ); ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </nav>
        <?php endif; ?>

        <div class="legal-contact-card">
          <p class="legal-contact-card__title">Контакты для обращений</p>
          <?php if ( $operator_email ) : ?>
            <p><a href="mailto:<?php echo esc_attr( antispambot( $operator_email ) ); ?>"><?php echo esc_html( antispambot( $operator_email ) ); ?></a></p>
          <?php endif; ?>
          <?php if ( $operator_phone ) : ?>
            <p><a href="<?php echo esc_url( vetapteka_get_phone_href( $operator_phone ) ); ?>"><?php echo esc_html( $operator_phone ); ?></a></p>
          <?php endif; ?>
          <?php if ( $operator_addr ) : ?>
            <p><?php echo vetapteka_format_multiline_text( $operator_addr ); ?></p>
          <?php endif; ?>
        </div>
      </aside>

      <article class="legal-article" aria-labelledby="policy-title">
        <?php if ( ! empty( $sections ) ) : ?>
          <?php foreach ( $sections as $index => $section ) : ?>
            <?php
            $section_title   = $section['title'] ?? '';
            $section_content = $section['content'] ?? '';
            $display_title   = preg_replace( '/^\d+\.\s*/u', '', $section_title );
            $section_num     = str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT );

            if ( ! $section_title && ! $section_content ) {
                continue;
            }
            ?>
            <section class="legal-card" id="policy-section-<?php echo esc_attr( $index + 1 ); ?>">
              <div class="legal-card__top">
                <?php if ( $display_title ) : ?>
                  <span class="legal-card__num"><?php echo esc_html( $section_num ); ?></span>
                  <h2 class="legal-card__title"><?php echo esc_html( $display_title ); ?></h2>
                <?php endif; ?>
              </div>

              <?php if ( $section_content ) : ?>
                <div class="legal-content">
                  <?php echo wp_kses_post( $section_content ); ?>
                </div>
              <?php endif; ?>
            </section>
          <?php endforeach; ?>
        <?php else : ?>
          <section class="legal-card">
            <div class="legal-content">
              <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
              <?php endwhile; ?>
            </div>
          </section>
        <?php endif; ?>
      </article>
    </div>
  </section>
</main>

<?php get_footer(); ?>

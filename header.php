<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
$logo             = get_field( 'general_logo', 'option' );
$logo_url         = vetapteka_get_image_url( $logo, 'vetapteka-logo' );
$logo_alt         = vetapteka_get_option_value( 'general_logo_alt', '' );
$brand_main       = vetapteka_get_option_value( 'general_brand_main', '' );
$brand_accent     = vetapteka_get_option_value( 'general_brand_accent', '' );
$nav_links        = get_field( 'header_nav_links', 'option' ) ?: [];
$header_cta       = get_field( 'header_cta_link', 'option' );
$mobile_cta       = get_field( 'mobile_cta_link', 'option' );
$site_name        = trim( $brand_main . $brand_accent );
?>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
  <div class="container header-inner">
    <a href="<?php echo esc_url( home_url( '/#hero' ) ); ?>" class="logo" aria-label="<?php echo esc_attr( $site_name ? $site_name . ' — вернуться на главную' : 'Вернуться на главную' ); ?>">
      <?php if ( $logo_url ) : ?>
        <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>" width="52" height="52" class="logo-img">
      <?php endif; ?>
      <span class="logo-text"><?php echo esc_html( $brand_main ); ?><span class="logo-pro"><?php echo esc_html( $brand_accent ); ?></span></span>
    </a>

    <nav class="main-nav" id="main-nav" aria-label="Основная навигация">
      <?php if ( ! empty( $nav_links ) ) : ?>
        <ul class="nav-list" role="list">
          <?php foreach ( $nav_links as $item ) : ?>
            <?php
            $link = $item['link'] ?? [];
            $url  = vetapteka_get_link_url( $link, '#hero' );
            $text = vetapteka_get_link_title( $link, '' );
            if ( ! $text ) {
                continue;
            }
            ?>
            <li><a class="nav-link" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $text ); ?></a></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </nav>

    <?php if ( $header_cta ) : ?>
      <a class="btn btn-outline header-cta" href="<?php echo esc_url( vetapteka_get_link_url( $header_cta, '#contacts' ) ); ?>" target="<?php echo esc_attr( vetapteka_get_link_target( $header_cta ) ); ?>">
        <?php echo vetapteka_phone_svg( 15 ); ?>
        <?php echo esc_html( vetapteka_get_link_title( $header_cta, '' ) ); ?>
      </a>
    <?php endif; ?>

    <button
      class="burger"
      id="burger-btn"
      aria-label="Открыть меню"
      aria-expanded="false"
      aria-controls="mobile-menu"
      type="button"
    >
      <span class="burger-bar"></span>
      <span class="burger-bar"></span>
      <span class="burger-bar"></span>
    </button>
  </div>
</header>

<div class="menu-overlay" id="menu-overlay" aria-hidden="true"></div>

<div class="mobile-menu" id="mobile-menu" aria-hidden="true">
  <div class="mobile-menu-header">
    <span class="mobile-menu-brand"><?php echo esc_html( $brand_main ); ?><em><?php echo esc_html( $brand_accent ); ?></em></span>
    <button class="mobile-menu-close" id="mobile-menu-close" type="button" aria-label="Закрыть меню">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>
  </div>
  <nav aria-label="Мобильная навигация">
    <?php if ( ! empty( $nav_links ) ) : ?>
      <ul class="mobile-nav-list" role="list">
        <?php foreach ( $nav_links as $item ) : ?>
          <?php
          $link = $item['link'] ?? [];
          $url  = vetapteka_get_link_url( $link, '#hero' );
          $text = vetapteka_get_link_title( $link, '' );
          if ( ! $text ) {
              continue;
          }
          ?>
          <li><a class="mobile-nav-link" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $text ); ?></a></li>
        <?php endforeach; ?>
        <?php if ( $mobile_cta ) : ?>
          <li>
            <a class="mobile-nav-cta" href="<?php echo esc_url( vetapteka_get_link_url( $mobile_cta, '#contacts' ) ); ?>" target="<?php echo esc_attr( vetapteka_get_link_target( $mobile_cta ) ); ?>">
              <?php echo vetapteka_phone_svg( 16 ); ?>
              <?php echo esc_html( vetapteka_get_link_title( $mobile_cta, '' ) ); ?>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    <?php endif; ?>
  </nav>
</div>

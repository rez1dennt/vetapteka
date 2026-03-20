<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Индивидуальные лекарственные препараты для животных. Компаундинговая ветеринарная аптека в Москве. Жидкие формы, дерматология, твёрдые формы. Лицензия Россельхознадзора. Доставка по всей России.">
  <meta name="keywords" content="ветеринарная аптека, компаундинг, лекарства для животных, ветаптека Москва, индивидуальные препараты, ветеринарный фармацевт">
  <meta name="robots" content="index, follow">

  <!-- Open Graph -->
  <meta property="og:title" content="ВЕТАПТЕКА.ПРО — Ветеринарная аптека в Москве">
  <meta property="og:description" content="Индивидуальные лекарственные препараты для животных. Компаундинговая аптека с лицензией Россельхознадзора.">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="ru_RU">

  <!-- Preconnect for Google Fonts (loaded via wp_enqueue_style) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- ========== HEADER ========== -->
  <header class="site-header" id="site-header">
    <div class="container header-inner">

      <a href="<?php echo esc_url( home_url( '/#hero' ) ); ?>" class="logo" aria-label="ВЕТАПТЕКА.ПРО — вернуться на главную">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="Логотип ВЕТАПТЕКА.ПРО" width="52" height="52" class="logo-img">
        <span class="logo-text">ВЕТАПТЕКА<span class="logo-pro">.ПРО</span></span>
      </a>

      <nav class="main-nav" id="main-nav" aria-label="Основная навигация">
        <ul class="nav-list" role="list">
          <li><a class="nav-link" href="#about">О нас</a></li>
          <li><a class="nav-link" href="#services">Услуги</a></li>
          <li><a class="nav-link" href="#solutions">Решения</a></li>
          <li><a class="nav-link" href="#contacts">Контакты</a></li>
          <li><a class="nav-link" href="#faq">FAQ</a></li>
        </ul>
      </nav>

      <a class="btn btn-outline header-cta" href="tel:+79168096136" aria-label="Позвонить нам: +7 (916) 809-61-36">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.29 6.29l1.28-1.29a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
        </svg>
        Свяжитесь с нами
      </a>

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

  <!-- Overlay + панель меню — вне хедера, чтобы backdrop-filter хедера
       не ломал position:fixed у панели (браузерный баг со stacking context) -->
  <div class="menu-overlay" id="menu-overlay" aria-hidden="true"></div>

  <div class="mobile-menu" id="mobile-menu" aria-hidden="true">
    <div class="mobile-menu-header">
      <span class="mobile-menu-brand">ВЕТАПТЕКА<em>.ПРО</em></span>
      <button class="mobile-menu-close" id="mobile-menu-close" type="button" aria-label="Закрыть меню">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
          <line x1="18" y1="6" x2="6" y2="18"/>
          <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>
    <nav aria-label="Мобильная навигация">
      <ul class="mobile-nav-list" role="list">
        <li><a class="mobile-nav-link" href="#about">О нас</a></li>
        <li><a class="mobile-nav-link" href="#services">Услуги</a></li>
        <li><a class="mobile-nav-link" href="#solutions">Решения</a></li>
        <li><a class="mobile-nav-link" href="#approach">Подход</a></li>
        <li><a class="mobile-nav-link" href="#certificate">Лицензия</a></li>
        <li><a class="mobile-nav-link" href="#contacts">Контакты</a></li>
        <li><a class="mobile-nav-link" href="#faq">FAQ</a></li>
        <li>
          <a class="mobile-nav-cta" href="tel:+79168096136">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.29 6.29l1.28-1.29a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
            </svg>
            +7 (916) 809-61-36
          </a>
        </li>
      </ul>
    </nav>
  </div>

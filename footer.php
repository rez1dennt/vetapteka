  <!-- ========== FOOTER ========== -->
  <footer class="site-footer" role="contentinfo">

    <!-- Top: logo + nav + contacts -->
    <div class="footer-top">
      <div class="container footer-top-inner">

        <div class="footer-logo-col">
          <a href="<?php echo esc_url( home_url( '/#hero' ) ); ?>" class="footer-logo-link" aria-label="ВЕТАПТЕКА.ПРО — на главную">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="Логотип ВЕТАПТЕКА.ПРО" width="80" height="80" class="footer-logo-img">
            <div class="footer-wordmark">
              <span class="footer-brandname">ВЕТАПТЕКА<em>.ПРО</em></span>
              <p class="footer-tagline">Препараты, которых нет в продаже — для тех, кого вы любите</p>
            </div>
          </a>
          <p class="footer-license-badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
            Лицензия №Л042-00118-77/03607161
          </p>
        </div>

        <nav class="footer-nav-col" aria-label="Навигация">
          <p class="footer-col-heading">Разделы</p>
          <ul class="footer-nav-list" role="list">
            <li><a href="#about">О нас</a></li>
            <li><a href="#services">Услуги</a></li>
            <li><a href="#solutions">Решения</a></li>
            <li><a href="#approach">Подход</a></li>
            <li><a href="#certificate">Лицензия</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#contacts">Контакты</a></li>
          </ul>
        </nav>

        <div class="footer-contact-col">
          <p class="footer-col-heading">Связаться</p>
          <a class="footer-phone-big" href="tel:+79168096136">+7 (916) 809-61-36</a>
          <address class="footer-address">
            <p>г. Москва, ул. Алма-Атинская,<br>д. 9, к. 2</p>
            <p class="footer-delivery-note">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
              Доставка по всей России
            </p>
          </address>
        </div>

      </div>
    </div>

    <!-- Bottom bar -->
    <div class="footer-bottom">
      <div class="container footer-bottom-inner">
        <p>&copy; <?php echo date( 'Y' ); ?> ВЕТАПТЕКА.ПРО. Все права защищены.</p>
        <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>" target="_blank" class="footer-privacy-link">Политика конфиденциальности</a>
        <p>Работаем по лицензии Россельхознадзора</p>
      </div>
    </div>

  </footer>

  <!-- ========== LIGHTBOX ========== -->
  <div
    class="lightbox"
    id="lightbox"
    role="dialog"
    aria-modal="true"
    aria-label="Просмотр лицензии"
    hidden
  >
    <div class="lightbox-backdrop" id="lightbox-backdrop"></div>
    <button class="lightbox-close" id="lightbox-close" type="button" aria-label="Закрыть просмотр">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <line x1="18" y1="6" x2="6" y2="18"/>
        <line x1="6" y1="6" x2="18" y2="18"/>
      </svg>
    </button>
    <figure class="lightbox-figure">
      <img class="lightbox-img" id="lightbox-img" src="" alt="">
      <figcaption class="lightbox-caption" id="lightbox-caption"></figcaption>
    </figure>
  </div>

<?php wp_footer(); ?>
</body>
</html>

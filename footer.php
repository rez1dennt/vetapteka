<?php
$logo             = get_field( 'general_logo', 'option' );
$logo_url         = vetapteka_get_image_url( $logo, 'vetapteka-logo' );
$logo_alt         = vetapteka_get_option_value( 'general_logo_alt', '' );
$brand_main       = vetapteka_get_option_value( 'general_brand_main', '' );
$brand_accent     = vetapteka_get_option_value( 'general_brand_accent', '' );
$footer_tagline   = vetapteka_get_option_value( 'footer_tagline', '' );
$footer_badge     = vetapteka_get_option_value( 'footer_license_badge', '' );
$footer_nav_title = vetapteka_get_option_value( 'footer_nav_heading', '' );
$footer_nav_links = get_field( 'footer_nav_links', 'option' ) ?: [];
$footer_contacts  = vetapteka_get_option_value( 'footer_contact_heading', '' );
$footer_phone     = vetapteka_get_option_value( 'footer_phone_display', '' );
$footer_phone_raw = vetapteka_get_option_value( 'footer_phone_raw', '' );
$footer_address   = vetapteka_get_option_value( 'footer_address', '' );
$footer_delivery  = vetapteka_get_option_value( 'footer_delivery_note', '' );
$footer_copyright = vetapteka_replace_year_token( vetapteka_get_option_value( 'footer_copyright', '' ) );
$footer_privacy   = get_field( 'footer_privacy_link', 'option' );
$footer_bottom    = vetapteka_get_option_value( 'footer_bottom_note', '' );
$footer_visible   = vetapteka_get_option_value( 'footer_visible', 1 );
?>

<?php if ( $footer_visible ) : ?>
  <footer class="site-footer" role="contentinfo">
    <div class="footer-top">
      <div class="container footer-top-inner">
        <div class="footer-logo-col">
          <a href="<?php echo esc_url( home_url( '/#hero' ) ); ?>" class="footer-logo-link" aria-label="Перейти к началу страницы">
            <?php if ( $logo_url ) : ?>
              <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>" width="80" height="80" class="footer-logo-img">
            <?php endif; ?>
            <div class="footer-wordmark">
              <span class="footer-brandname"><?php echo esc_html( $brand_main ); ?><em><?php echo esc_html( $brand_accent ); ?></em></span>
              <?php if ( $footer_tagline ) : ?>
                <p class="footer-tagline"><?php echo esc_html( $footer_tagline ); ?></p>
              <?php endif; ?>
            </div>
          </a>
          <?php if ( $footer_badge ) : ?>
            <p class="footer-license-badge">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
              <?php echo esc_html( $footer_badge ); ?>
            </p>
          <?php endif; ?>
        </div>

        <nav class="footer-nav-col" aria-label="Навигация в футере">
          <?php if ( $footer_nav_title ) : ?>
            <p class="footer-col-heading"><?php echo esc_html( $footer_nav_title ); ?></p>
          <?php endif; ?>
          <?php if ( ! empty( $footer_nav_links ) ) : ?>
            <ul class="footer-nav-list" role="list">
              <?php foreach ( $footer_nav_links as $item ) : ?>
                <?php
                $link = $item['link'] ?? [];
                $url  = vetapteka_get_link_url( $link, '#hero' );
                $text = vetapteka_get_link_title( $link, '' );
                if ( ! $text ) {
                    continue;
                }
                ?>
                <li><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $text ); ?></a></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </nav>

        <div class="footer-contact-col">
          <?php if ( $footer_contacts ) : ?>
            <p class="footer-col-heading"><?php echo esc_html( $footer_contacts ); ?></p>
          <?php endif; ?>
          <?php if ( $footer_phone ) : ?>
            <a class="footer-phone-big" href="<?php echo esc_url( vetapteka_get_phone_href( $footer_phone_raw ) ); ?>"><?php echo esc_html( $footer_phone ); ?></a>
          <?php endif; ?>
          <address class="footer-address">
            <?php if ( $footer_address ) : ?>
              <p><?php echo vetapteka_format_multiline_text( $footer_address ); ?></p>
            <?php endif; ?>
            <?php if ( $footer_delivery ) : ?>
              <p class="footer-delivery-note">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                <?php echo esc_html( $footer_delivery ); ?>
              </p>
            <?php endif; ?>
          </address>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="container footer-bottom-inner">
        <?php if ( $footer_copyright ) : ?>
          <p><?php echo esc_html( $footer_copyright ); ?></p>
        <?php endif; ?>
        <?php if ( $footer_privacy ) : ?>
          <a href="<?php echo esc_url( vetapteka_get_link_url( $footer_privacy, '#' ) ); ?>" target="<?php echo esc_attr( vetapteka_get_link_target( $footer_privacy ) ); ?>" class="footer-privacy-link"><?php echo esc_html( vetapteka_get_link_title( $footer_privacy, '' ) ); ?></a>
        <?php endif; ?>
        <?php if ( $footer_bottom ) : ?>
          <p><?php echo esc_html( $footer_bottom ); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </footer>
<?php endif; ?>

<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Просмотр лицензии" hidden>
  <div class="lightbox-backdrop" id="lightbox-backdrop"></div>
  <button class="lightbox-close" id="lightbox-close" type="button" aria-label="Закрыть просмотр">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
      <line x1="18" y1="6" x2="6" y2="18"></line>
      <line x1="6" y1="6" x2="18" y2="18"></line>
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

<?php
/**
 * Contacts section
 */

$section_num      = $args['section_num'] ?? '';

$label            = vetapteka_get_option_value( 'contacts_label', '' );
$title            = vetapteka_get_option_value( 'contacts_title', '' );
$address_title    = vetapteka_get_option_value( 'contacts_address_title', '' );
$address_text     = vetapteka_get_option_value( 'contacts_address_text', '' );
$delivery_title   = vetapteka_get_option_value( 'contacts_delivery_title', '' );
$delivery_text    = vetapteka_get_option_value( 'contacts_delivery_text', '' );
$phone_title      = vetapteka_get_option_value( 'contacts_phone_title', '' );
$phone_display    = vetapteka_get_option_value( 'contacts_phone_display', '' );
$phone_raw        = vetapteka_get_option_value( 'contacts_phone_raw', '' );
$email_title      = vetapteka_get_option_value( 'contacts_email_title', '' );
$email            = vetapteka_get_option_value( 'contacts_email', '' );
$worktime_title   = vetapteka_get_option_value( 'contacts_worktime_title', '' );
$worktime_text    = vetapteka_get_option_value( 'contacts_worktime_text', '' );
$map_url          = vetapteka_get_option_value( 'contacts_map_embed_url', '' );
$map_title        = vetapteka_get_option_value( 'contacts_map_title', '' );
?>

<section class="contacts section-dark" id="contacts" aria-labelledby="contacts-title">
  <div class="container contacts-inner">
    <div class="contacts-text-col">
      <div class="section-header"<?php echo $section_num ? ' data-num="' . esc_attr( $section_num ) . '"' : ''; ?>>
        <?php if ( $label ) : ?>
          <span class="label"><?php echo esc_html( $label ); ?></span>
        <?php endif; ?>
        <?php if ( $title ) : ?>
          <h2 class="section-title" id="contacts-title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>
      </div>

      <address class="contacts-addr">
        <?php if ( $address_title || $address_text ) : ?>
          <div class="contact-row">
            <span class="contact-icon" aria-hidden="true">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
            </span>
            <div>
              <?php if ( $address_title ) : ?><strong><?php echo esc_html( $address_title ); ?></strong><?php endif; ?>
              <?php if ( $address_text ) : ?><p><?php echo vetapteka_format_multiline_text( $address_text ); ?></p><?php endif; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if ( $delivery_title || $delivery_text ) : ?>
          <div class="contact-row">
            <span class="contact-icon" aria-hidden="true">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="1" y="3" width="15" height="13"></rect>
                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                <circle cx="18.5" cy="18.5" r="2.5"></circle>
              </svg>
            </span>
            <div>
              <?php if ( $delivery_title ) : ?><strong><?php echo esc_html( $delivery_title ); ?></strong><?php endif; ?>
              <?php if ( $delivery_text ) : ?><p><?php echo vetapteka_format_multiline_text( $delivery_text ); ?></p><?php endif; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if ( $phone_title || $phone_display ) : ?>
          <div class="contact-row">
            <span class="contact-icon" aria-hidden="true">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.29 6.29l1.28-1.29a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
            </span>
            <div>
              <?php if ( $phone_title ) : ?><strong><?php echo esc_html( $phone_title ); ?></strong><?php endif; ?>
              <?php if ( $phone_display ) : ?><a class="contact-phone" href="<?php echo esc_url( vetapteka_get_phone_href( $phone_raw ) ); ?>"><?php echo esc_html( $phone_display ); ?></a><?php endif; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if ( $email_title || $email ) : ?>
          <div class="contact-row">
            <span class="contact-icon" aria-hidden="true">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 4h16v16H4z"></path>
                <path d="M22 6l-10 7L2 6"></path>
              </svg>
            </span>
            <div>
              <?php if ( $email_title ) : ?><strong><?php echo esc_html( $email_title ); ?></strong><?php endif; ?>
              <?php if ( $email ) : ?><p><a class="contact-phone" href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a></p><?php endif; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if ( $worktime_title || $worktime_text ) : ?>
          <div class="contact-row">
            <span class="contact-icon" aria-hidden="true">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="9"></circle>
                <path d="M12 7v5l3 3"></path>
              </svg>
            </span>
            <div>
              <?php if ( $worktime_title ) : ?><strong><?php echo esc_html( $worktime_title ); ?></strong><?php endif; ?>
              <?php if ( $worktime_text ) : ?><p><?php echo vetapteka_format_multiline_text( $worktime_text ); ?></p><?php endif; ?>
            </div>
          </div>
        <?php endif; ?>
      </address>
    </div>

    <div class="contacts-map-col">
      <?php if ( $map_url ) : ?>
        <iframe
          src="<?php echo esc_url( $map_url ); ?>"
          width="100%"
          height="380"
          frameborder="0"
          allowfullscreen
          title="<?php echo esc_attr( $map_title ); ?>"
          loading="lazy"
          class="contacts-map"
        ></iframe>
      <?php endif; ?>
    </div>
  </div>
</section>

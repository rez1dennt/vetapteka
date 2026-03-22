<?php
/**
 * Marquee section
 */

$items = get_field( 'marquee_items', 'option' ) ?: [];

if ( empty( $items ) ) {
    return;
}
?>

<div class="marquee-band" aria-hidden="true">
  <div class="marquee-track">
    <?php for ( $loop = 0; $loop < 2; $loop++ ) : ?>
      <?php foreach ( $items as $item ) : ?>
        <?php if ( empty( $item['text'] ) ) : ?>
          <?php continue; ?>
        <?php endif; ?>
        <span><?php echo esc_html( $item['text'] ); ?></span><span class="mq-sep">✦</span>
      <?php endforeach; ?>
    <?php endfor; ?>
  </div>
</div>

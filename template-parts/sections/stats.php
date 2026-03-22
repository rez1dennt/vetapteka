<?php
/**
 * Stats strip section
 */

$items = get_field( 'stats_items', 'option' ) ?: [];

if ( empty( $items ) ) {
    return;
}
?>

<div class="stats-strip" aria-label="Наша статистика">
  <div class="container stats-inner">
    <?php foreach ( $items as $index => $item ) : ?>
      <?php if ( empty( $item['value'] ) && empty( $item['label'] ) ) : ?>
        <?php continue; ?>
      <?php endif; ?>
      <div class="stat-item">
        <?php if ( ! empty( $item['value'] ) ) : ?>
          <span class="stat-num"><?php echo wp_kses( $item['value'], [ 'sup' => [] ] ); ?></span>
        <?php endif; ?>
        <?php if ( ! empty( $item['label'] ) ) : ?>
          <span class="stat-label"><?php echo esc_html( $item['label'] ); ?></span>
        <?php endif; ?>
      </div>
      <?php if ( $index < count( $items ) - 1 ) : ?>
        <div class="stat-sep" aria-hidden="true"></div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>

<?php
$items = get_sub_field( 'items' ) ?: [];
?>
<section class="features has-arch">
	<div class="container">
		<div class="section-title section-title--center features__title">
			<?php vineyard_icon( 'sprig', 'section-title__sprig' ); ?>
			<?php if ( $heading = get_sub_field( 'heading' ) ) : ?>
				<h2 class="section-title__heading"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<?php if ( $text = get_sub_field( 'text' ) ) : ?>
				<p class="section-title__text"><?php echo esc_html( $text ); ?></p>
			<?php endif; ?>
		</div>
		<?php if ( $items ) : ?>
			<div class="features__row">
				<?php foreach ( $items as $item ) : ?>
					<div class="feature">
						<?php if ( ! empty( $item['icon'] ) ) {
							vineyard_icon( 'icon-' . $item['icon'], 'feature__icon' );
						} ?>
						<?php if ( ! empty( $item['title'] ) ) : ?>
							<h3 class="feature__title"><?php echo esc_html( $item['title'] ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $item['text'] ) ) : ?>
							<p class="feature__text"><?php echo esc_html( $item['text'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

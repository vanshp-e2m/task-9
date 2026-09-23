<?php
$items    = get_sub_field( 'items' ) ?: [];
$image_id = get_sub_field( 'image' );
$position = get_sub_field( 'image_position' ) === 'right' ? 'right' : 'left';
?>
<section class="image-list image-list--image-<?php echo esc_attr( $position ); ?>">
	<div class="container image-list__inner">
		<?php if ( $image_id ) : ?>
			<div class="image-list__media"><?php echo wp_get_attachment_image( (int) $image_id, 'large', false, [ 'loading' => 'lazy' ] ); ?></div>
		<?php endif; ?>
		<div class="image-list__content">
			<div class="section-title section-title--compact">
				<?php if ( $heading = get_sub_field( 'heading' ) ) : ?>
					<h2 class="section-title__heading"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>
				<?php vineyard_lead_text( get_sub_field( 'lead' ), get_sub_field( 'text' ), 'section-title__text' ); ?>
			</div>
			<?php if ( $items ) : ?>
				<ul class="image-list__items">
					<?php foreach ( $items as $item ) : ?>
						<li class="image-list__item">
							<?php if ( ! empty( $item['title'] ) ) : ?>
								<h3 class="image-list__title"><?php echo esc_html( $item['title'] ); ?></h3>
							<?php endif; ?>
							<?php if ( ! empty( $item['text'] ) ) : ?>
								<p class="image-list__text"><?php echo esc_html( $item['text'] ); ?></p>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</section>

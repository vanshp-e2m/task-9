<?php
$image_id = get_sub_field( 'image' );
$position = get_sub_field( 'image_position' ) === 'left' ? 'left' : 'right';
$lead     = get_sub_field( 'lead' );
$text     = get_sub_field( 'text' );
?>
<section class="image-text image-text--image-<?php echo esc_attr( $position ); ?>">
	<div class="image-text__inner container">
		<div class="image-text__content">
			<?php if ( $heading = get_sub_field( 'heading' ) ) : ?>
				<h2 class="image-text__title"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<?php if ( $lead || $text ) : ?>
				<p class="image-text__text">
					<?php if ( $lead ) : ?><span class="image-text__lead"><?php echo esc_html( $lead ); ?></span><?php endif; ?>
					<?php echo esc_html( $text ); ?>
				</p>
			<?php endif; ?>
			<?php vineyard_button( get_sub_field( 'button' ) ); ?>
		</div>
		<?php if ( $image_id ) : ?>
			<div class="image-text__media">
				<?php echo wp_get_attachment_image( $image_id, 'large' ); ?>
			</div>
		<?php endif; ?>
	</div>
</section>

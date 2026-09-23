<?php
$image_id = get_sub_field( 'background_image' );
$bg_url   = $image_id ? wp_get_attachment_image_url( $image_id, 'full' ) : '';
?>
<section class="hero"<?php echo $bg_url ? ' style="background-image:url(\'' . esc_url( $bg_url ) . '\')"' : ''; ?>>
	<div class="hero__content">
		<?php if ( $heading = get_sub_field( 'heading' ) ) : ?>
			<h1 class="hero__title"><?php echo esc_html( $heading ); ?></h1>
		<?php endif; ?>
		<?php if ( $subheading = get_sub_field( 'subheading' ) ) : ?>
			<p class="hero__subtitle"><?php echo esc_html( $subheading ); ?></p>
		<?php endif; ?>
		<?php if ( $text = get_sub_field( 'text' ) ) : ?>
			<p class="hero__text"><?php echo esc_html( $text ); ?></p>
		<?php endif; ?>
		<?php vineyard_button( get_sub_field( 'button' ) ); ?>
	</div>
</section>

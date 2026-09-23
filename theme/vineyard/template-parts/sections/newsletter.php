<?php
$bg_id  = get_sub_field( 'background_image' );
$bg_url = $bg_id ? wp_get_attachment_image_url( (int) $bg_id, 'full' ) : '';
$terms  = get_sub_field( 'terms_link' );
?>
<section class="newsletter"<?php echo $bg_url ? ' style="--newsletter-bg:url(\'' . esc_url( $bg_url ) . '\')"' : ''; ?>>
	<div class="container newsletter__inner">
		<div class="newsletter__content">
			<?php if ( $heading = get_sub_field( 'heading' ) ) : ?>
				<h2 class="newsletter__heading"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<?php if ( $text = get_sub_field( 'text' ) ) : ?>
				<p class="newsletter__text"><?php echo esc_html( $text ); ?></p>
			<?php endif; ?>
		</div>
		<div class="newsletter__actions">
			<form class="newsletter__form" action="#" method="post" onsubmit="return false;">
				<label class="screen-reader-text" for="newsletter-email"><?php esc_html_e( 'Email address', 'vineyard' ); ?></label>
				<input class="newsletter__input" id="newsletter-email" type="email" name="email" required placeholder="<?php echo esc_attr( get_sub_field( 'placeholder' ) ?: __( 'Enter your email', 'vineyard' ) ); ?>">
				<button class="btn newsletter__button" type="submit"><?php echo esc_html( get_sub_field( 'button_label' ) ?: __( 'Sign Up', 'vineyard' ) ); ?></button>
			</form>
			<?php if ( ( $disclaimer = get_sub_field( 'disclaimer' ) ) || ! empty( $terms['url'] ) ) : ?>
				<p class="newsletter__disclaimer">
					<?php echo esc_html( $disclaimer ); ?>
					<?php if ( ! empty( $terms['url'] ) ) : ?>
						<a href="<?php echo esc_url( $terms['url'] ); ?>"><?php echo esc_html( $terms['title'] ?: $terms['url'] ); ?></a>.
					<?php endif; ?>
				</p>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
$cards = get_sub_field( 'cards' ) ?: [];
?>
<section class="product-cards has-arch">
	<div class="container">
		<div class="section-title section-title--center">
			<?php vineyard_icon( 'sprig', 'section-title__sprig' ); ?>
			<?php if ( $heading = get_sub_field( 'heading' ) ) : ?>
				<h2 class="section-title__heading"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<?php vineyard_lead_text( get_sub_field( 'lead' ), get_sub_field( 'text' ), 'section-title__text' ); ?>
		</div>
		<?php if ( $cards ) : ?>
			<div class="product-cards__row">
				<?php foreach ( $cards as $card ) :
					$bg   = sanitize_hex_color( $card['color'] ?? '' ) ?: '#a4d866';
					$ink  = sanitize_hex_color( $card['text_color'] ?? '' ) ?: '#105742';
					$link = $card['link'] ?? null;
					?>
					<article class="product-card" style="--card-bg:<?php echo esc_attr( $bg ); ?>;--card-ink:<?php echo esc_attr( $ink ); ?>">
						<div class="product-card__media">
							<span class="product-card__shadow" aria-hidden="true"></span>
							<?php if ( ! empty( $card['image'] ) ) {
								echo wp_get_attachment_image( (int) $card['image'], 'large', false, [ 'class' => 'product-card__image', 'loading' => 'lazy' ] );
							} ?>
						</div>
						<div class="product-card__body">
							<div class="product-card__content">
								<?php if ( ! empty( $card['heading'] ) ) : ?>
									<h3 class="product-card__heading"><?php echo esc_html( $card['heading'] ); ?></h3>
								<?php endif; ?>
								<?php vineyard_lead_text( $card['lead'] ?? '', $card['text'] ?? '', 'product-card__text' ); ?>
							</div>
							<div class="product-card__actions">
								<?php vineyard_button( $card['button'] ?? null, 'btn btn--outline' ); ?>
								<?php if ( ! empty( $link['url'] ) ) : ?>
									<a class="text-link" href="<?php echo esc_url( $link['url'] ); ?>"<?php echo ! empty( $link['target'] ) ? ' target="_blank" rel="noopener"' : ''; ?>>
										<?php echo esc_html( $link['title'] ?: $link['url'] ); ?><?php vineyard_icon( 'chevron-right', 'text-link__icon' ); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

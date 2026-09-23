<?php
$cards = get_sub_field( 'cards' ) ?: [];
?>
<section class="cards-grid stripes-bg">
	<div class="container">
		<div class="section-title">
			<?php if ( $heading = get_sub_field( 'heading' ) ) : ?>
				<h2 class="section-title__heading"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<?php vineyard_lead_text( get_sub_field( 'lead' ), get_sub_field( 'text' ), 'section-title__text' ); ?>
		</div>
		<?php if ( $cards ) : ?>
			<div class="cards-grid__row">
				<?php foreach ( $cards as $card ) :
					$link = $card['link'] ?? null;
					?>
					<article class="post-card">
						<?php if ( ! empty( $card['image'] ) ) : ?>
							<div class="post-card__media"><?php echo wp_get_attachment_image( (int) $card['image'], 'large', false, [ 'loading' => 'lazy' ] ); ?></div>
						<?php endif; ?>
						<div class="post-card__content">
							<?php if ( ! empty( $card['tag'] ) ) : ?>
								<span class="post-card__tag"><?php echo esc_html( $card['tag'] ); ?></span>
							<?php endif; ?>
							<?php if ( ! empty( $card['title'] ) ) : ?>
								<h3 class="post-card__title">
									<?php if ( ! empty( $link['url'] ) ) : ?>
										<a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $card['title'] ); ?></a>
									<?php else : ?>
										<?php echo esc_html( $card['title'] ); ?>
									<?php endif; ?>
								</h3>
							<?php endif; ?>
							<?php if ( ! empty( $card['text'] ) ) : ?>
								<p class="post-card__text"><?php echo esc_html( $card['text'] ); ?></p>
							<?php endif; ?>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<?php if ( $button = get_sub_field( 'button' ) ) : ?>
			<div class="cards-grid__actions"><?php vineyard_button( $button ); ?></div>
		<?php endif; ?>
	</div>
</section>

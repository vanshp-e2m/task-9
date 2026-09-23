<?php
$socials = array_filter( [
	'facebook'  => vineyard_setting( 'social_facebook' ),
	'instagram' => vineyard_setting( 'social_instagram' ),
	'x'         => vineyard_setting( 'social_x' ),
	'linkedin'  => vineyard_setting( 'social_linkedin' ),
	'youtube'   => vineyard_setting( 'social_youtube' ),
] );
?>
<footer class="site-footer">
	<div class="site-footer__main">
		<div class="container">
			<div class="site-footer__top">
				<a class="site-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php vineyard_logo(); ?></a>
				<?php if ( $tagline = vineyard_setting( 'footer_tagline' ) ) : ?>
					<p class="site-footer__tagline"><?php echo esc_html( $tagline ); ?></p>
				<?php endif; ?>
				<nav class="site-footer__nav" aria-label="<?php esc_attr_e( 'Footer', 'vineyard' ); ?>">
					<?php
					wp_nav_menu( [
						'theme_location' => 'footer',
						'container'      => false,
						'fallback_cb'    => false,
						'depth'          => 1,
					] );
					?>
				</nav>
			</div>
			<?php if ( $socials ) : ?>
				<ul class="site-footer__social">
					<?php foreach ( $socials as $network => $url ) : ?>
						<li><a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( ucfirst( $network ) ); ?>"><?php vineyard_icon( 'social-' . $network ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<div class="site-footer__credits">
				<p class="site-footer__copyright"><?php echo esc_html( str_replace( '{year}', gmdate( 'Y' ), (string) vineyard_setting( 'footer_copyright' ) ) ); ?></p>
				<nav class="site-footer__legal" aria-label="<?php esc_attr_e( 'Legal', 'vineyard' ); ?>">
					<?php
					wp_nav_menu( [
						'theme_location' => 'legal',
						'container'      => false,
						'fallback_cb'    => false,
						'depth'          => 1,
					] );
					?>
				</nav>
			</div>
		</div>
	</div>
	<div class="site-footer__stripes stripes"></div>
</footer>
<script>
document.querySelectorAll(".site-nav-toggle").forEach(function (btn) {
	btn.addEventListener("click", function () {
		var header = btn.closest(".site-header");
		var open = header.classList.toggle("is-open");
		btn.setAttribute("aria-expanded", open ? "true" : "false");
	});
});
</script>
<?php wp_footer(); ?>
</body>
</html>

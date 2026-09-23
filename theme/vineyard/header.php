<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'vineyard' ); ?></a>

<header class="site-header">
	<div class="site-header__stripes stripes"></div>
	<div class="site-header__bar">
		<div class="site-header__inner container">
			<a class="site-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php vineyard_logo(); ?>
			</a>
			<button class="site-nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav">
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'vineyard' ); ?></span>
				<svg width="28" height="28" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
			</button>
			<nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e( 'Main', 'vineyard' ); ?>">
				<?php
				wp_nav_menu( [
					'theme_location' => 'primary',
					'container'      => false,
					'fallback_cb'    => false,
					'depth'          => 2,
				] );
				?>
			</nav>
		</div>
	</div>
</header>

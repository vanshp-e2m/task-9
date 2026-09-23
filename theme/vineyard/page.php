<?php get_header(); ?>
<main id="main">
	<?php
	while ( have_posts() ) :
		the_post();
		if ( function_exists( 'have_rows' ) && have_rows( 'sections' ) ) :
			while ( have_rows( 'sections' ) ) :
				the_row();
				get_template_part( 'template-parts/sections/' . str_replace( '_', '-', get_row_layout() ) );
			endwhile;
		else :
			?>
			<article class="container page-content">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
			<?php
		endif;
	endwhile;
	?>
</main>
<?php get_footer(); ?>

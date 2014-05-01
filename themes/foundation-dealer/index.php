<?php get_header(); ?>

	<div class="small-12 large-8 columns" role="main">
		
		<?php
		
			$featured_posts_query = new WP_Query('category_name=featured&posts_per_page=1');

			while ($featured_posts_query->have_posts()) : $featured_posts_query->the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;
			
		?>
	
	<?php if ( have_posts() ) : ?>
		
		<?php do_action('foundationPress_before_content'); ?>
		
		<?php while ( have_posts() ) : the_post(); ?>
			<?php if ( !in_category('3') ): ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endif; ?>
		<?php endwhile; ?>
		
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		
		<?php do_action('foundationPress_before_pagination'); ?>
		
	<?php endif;?>
	
	
	
	<?php if ( function_exists('FoundationPress_pagination') ) { FoundationPress_pagination(); } else if ( is_paged() ) { ?>
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'FoundationPress' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'FoundationPress' ) ); ?></div>
		</nav>
	<?php } ?>
	
	<?php do_action('foundationPress_after_content'); ?>
	
	</div>
	<?php get_sidebar(); ?>
		
<?php get_footer(); ?>
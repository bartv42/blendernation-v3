<?php 

/**
 * Singular Content Template
 */

?>

<?php get_header(); ?>

<div class="main wrap cf">
	<div class="row">
		<div class="col-8 main-content">
		
			<?php while (have_posts()) : the_post(); ?>

				<?php include( 'ads/responsive.php' ); ?>

				<?php 

					$panels = get_post_meta(get_the_ID(), 'panels_data', true);
					
					if (!empty($panels) && !empty($panels['grid'])):
						
						get_template_part('content', 'builder');
					
					else:
					
						get_template_part('content', 'single');
						
					endif; 
				?>

				<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>

				<div class="comments">
				<?php comments_template('', true); ?>
				</div>

			<?php endwhile; // end of the loop. ?>

		</div>
		
		<?php Bunyad::core()->theme_sidebar(); ?>
		
	</div> <!-- .row -->
</div> <!-- .main -->

<?php get_footer(); ?>
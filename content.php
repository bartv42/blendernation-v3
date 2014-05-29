<?php

/**
 * Content Template is used for every post format and used on single posts
 */

// post has review? 
$review = Bunyad::posts()->meta('reviews');

?>

<article id="post-<?php the_ID(); ?>" class="<?php
	// hreview has to be first class because of rich snippet classes limit 
	echo ($review ? 'hreview ' : '') . join(' ', get_post_class()); ?>" itemscope itemtype="http://schema.org/Article">

	<?php if (!is_page() OR Bunyad::posts()->meta('page_title') == 'yes'): // page title can be disabled on pages ?>
	
	<header class="post-header cf">

	<?php if (!Bunyad::posts()->meta('featured_disable')): ?>
		<div class="featured">
			<?php if (get_post_format() == 'gallery'): // get gallery template ?>
			
				<?php get_template_part('partial-gallery'); ?>
				
			<?php elseif (Bunyad::posts()->meta('featured_video')): // featured video available? ?>
			
				<div class="featured-vid">
					<?php echo apply_filters('bunyad_featured_video', Bunyad::posts()->meta('featured_video')); ?>
				</div>
				
			<?php else: // normal featured image ?>
			
				<a href="<?php $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo $url[0]; ?>" title="<?php the_title_attribute(); ?>" itemprop="image">
				
				<?php if (Bunyad::options()->blog_thumb != 'thumb-left'): // normal container width image ?>
				
					<?php if ((!in_the_loop() && Bunyad::posts()->meta('layout_style') == 'full') OR Bunyad::core()->get_sidebar() == 'none'): // largest images - no sidebar? ?>
				
						<?php the_post_thumbnail('main-full', array('title' => strip_tags(get_the_title()))); ?>
				
					<?php else: ?>
					
						<?php the_post_thumbnail('main-slider', array('title' => strip_tags(get_the_title()))); ?>
					
					<?php endif; ?>
					
				<?php else: ?>
					<?php the_post_thumbnail('thumbnail', array('title' => strip_tags(get_the_title()))); ?>
				<?php endif; ?>
				
				</a>
				
			<?php endif; ?>
		</div>
	<?php endif; // featured check ?>

		<h1 class="post-title" itemprop="name">
		<?php if (is_singular()): the_title(); else: ?>
		
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
				<?php the_title(); ?></a>
				
		<?php endif;?>
		</h1>
		
		<a href="<?php comments_link(); ?>" class="comments"><i class="fa fa-comments-o"></i> <?php echo get_comments_number(); ?></a>
		
	</header><!-- .post-header -->
	
	<div class="post-meta">
		<span class="posted-by"><?php _ex('By', 'Post Meta', 'bunyad'); ?> 
			<span class="reviewer" itemprop="author"><?php the_author_posts_link(); ?></span>
		</span>
		 
		<span class="posted-on"><?php _ex('on', 'Post Meta', 'bunyad'); ?>
			<span class="dtreviewed">
				<time class="value-datetime" datetime="<?php echo esc_attr(get_the_time('c')); ?>" itemprop="datePublished"><?php echo esc_html(get_the_date()); ?></time>
			</span>
		</span>
		
		<span class="cats"><?php echo get_the_category_list(__(', ', 'bunyad')); ?></span>
			
	</div>
	
	<?php endif; ?>
	
<?php
	// page builder for posts enabled?
	$panels = get_post_meta(get_the_ID(), 'panels_data', true);
	if (!empty($panels) && !empty($panels['grids']) && is_singular()):
?>
	
	<?php Bunyad::posts()->the_content(); ?>

<?php 
	else: 
?>

	<div class="post-container cf">
	
		<div class="post-content-right">
			<div class="post-content description" itemprop="articleBody">
			
				<?php
				if (is_singular() OR !Bunyad::options()->blog_excerpts): 
					Bunyad::posts()->the_content();
				else:
					echo Bunyad::posts()->excerpt();
					
				?>
				
				<?php
				endif;
				?>
			
				<?php wp_link_pages(array(
						'before' => '<div class="main-pagination post-pagination">', 
						'after' => '</div>', 
						'link_before' => '<span>',
						'link_after' => '</span>')); ?>
						
				<?php if (Bunyad::options()->show_tags): ?>
					<div class="tagcloud"><?php the_tags('', ' '); ?></div>
				<?php endif; ?>
			</div><!-- .post-content -->
		</div>
		
	</div>
	
<?php 
	endif; // end page builder blocks test
?>
	
</article>


<?php if (is_single() && Bunyad::options()->author_box) : // author box? ?>

	<h3 class="section-head"><?php _e('About Author', 'bunyad'); ?></h3>

	<?php get_template_part('partial-author'); ?>

<?php endif; ?>
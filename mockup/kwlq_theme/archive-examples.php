<?php get_header();?>
<article class="under-page">
	<section id="examples">
		<div class="container">
			<ul class="cf">
			<?php if(have_posts()): while(have_posts()): the_post();?>
				<li>
					<p><a href="<?php the_permalink();?>"><?php the_post_thumbnail('full-size'); ?></a></p>
					<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
					<p class="date"><?php the_time('Y.m.d');?></p>
				</li>
			<?php endwhile; endif;?>
			</ul>
			<?php if (function_exists("pagination")) { pagination($additional_loop->max_num_pages); } ?>
		</div>
	</section>
</article>
<?php get_footer();?>
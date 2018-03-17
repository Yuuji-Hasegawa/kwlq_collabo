<?php get_header();?>
<article class="under-page">
	<section id="news">
		<div class="container">
			<?php if(have_posts()): while(have_posts()): the_post();?>
				<dl class="dlh">
					<dt><?php the_time('Y.m.d');?></dt>
					<dd><a href="<?php the_permalink();?>"><?php the_title();?></a></dd>
				</dl>
			<?php endwhile; endif;?>
			<?php if (function_exists("pagination")) { pagination($additional_loop->max_num_pages); } ?>
		</div>
	</section>
</article>
<?php get_footer();?>
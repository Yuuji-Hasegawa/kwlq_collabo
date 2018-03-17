<?php get_header();?>
<article class="under-page">
	<section id="voice">
		<div class="container">
			<ul class="cf">
			<?php if(have_posts()): while(have_posts()): the_post();?>
				<li>
					<div class="cf">
						<div class="fl">
							<a href="<?php the_permalink();?>"><?php the_post_thumbnail('full-size'); ?></a>
						</div>
						<div class="fr">
							<p class="date"><?php the_time('Y.m.d');?></p>
							<h3><a href="<?php the_permalink();?>"><?php the_title();?> さま</a></h3>
							<p><?php echo mb_strimwidth(get_the_excerpt(), 0, 80, "…", "UTF-8"); ?></p>
							<p>タグ、タクソノミーを入れる？</p>
						</div>
					</div>	
				</li>
			<?php endwhile; endif;?>
			</ul>
			<?php if (function_exists("pagination")) { pagination($additional_loop->max_num_pages); } ?>
		</div>
	</section>
</article>
<?php get_footer();?>
<?php get_header();?>
<article class="under-page">
	<div class="container">
		<?php if(have_posts()): while(have_posts()): the_post();?>
			<?php the_content();?>
		<?php endwhile; endif;?>
	</div>
</article>
<?php get_footer();?>
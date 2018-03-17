<section id="news">
	<div class="container">
		<h2>news-title</h2>
		<?php
			$args = array(
					'post_type' => 'news', /* 投稿タイプを指定 */
					'posts_per_page' => 3, // 表示件数
					'order' => 'date',
					'order' => 'DESC',
					);
			$the_query = new WP_Query( $args );?>
		<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<dl class="dlh">
					<dt><?php the_time('Y.m.d');?></dt>
					<dd><a href="<?php the_permalink();?>"><?php the_title();?></a></dd>
				</dl>
			<?php endwhile;?>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>	
		<button><a href="<?php echo home_url();?>/news">news-list btn</a></button>
	</div>
</section>
<section id="blogs">
	<div class="container">
		<h2>blog-title</h2>
		<ul class="cf">
		<?php
			$args = array(
					'post_type' => 'blog', /* 投稿タイプを指定 */
					'posts_per_page' => 4, // 表示件数
					'order' => 'date',
					'order' => 'DESC',
					);
			$the_query = new WP_Query( $args );?>
		<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<li>
					<div class="cf">
						<div class="fl">
							<a href="<?php the_permalink();?>"><?php the_post_thumbnail('full-size'); ?></a>
						</div>
						<div class="fr">
							<p class="date"><?php the_time('Y.m.d');?></p>
							<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
							<p><?php echo mb_strimwidth(get_the_excerpt(), 0, 80, "…", "UTF-8"); ?></p>
						</div>
					</div>	
				</li>
			<?php endwhile;?>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
				<li><?php _e( 'Sorry, no posts matched your criteria.' ); ?></li>
		<?php endif; ?>	
		</ul>
		<button><a href="<?php echo home_url();?>/blog">blog-list btn</a></button>
	</div>
</section>
<section id="follow">
	<div class="container">
		<h2>follow me</h2>
		<ul>
			<li><a href="#" target="_blank"><i class="fab fa-3x fa-facebook"></i></a></li>
			<li><a href="#" target="_blank"><i class="fab fa-3x fa-twitter"></i></a></li>
			<li><a href="#" target="_blank"><i class="fab fa-3x fa-google-plus"></i></a></li>
		</ul>
	</div>
</section>
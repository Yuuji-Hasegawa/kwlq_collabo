</main>
<aside>
<?php if(is_front_page()): ?>
	<?php get_sidebar();?>
<?php else: ?>
	<?php get_sidebar('under');?>
<?php endif;?>
</aside>
</section>
<footer>
	<nav>
		<div class="container">
			<ul>
				<li><a href="<?php echo home_url();?>">トップページ</a></li>
				<li><a href="<?php echo home_url();?>/company">会社概要</a></li>
				<li><a href="<?php echo home_url();?>/site-policy">利用規約</a></li>
				<li><a href="<?php echo home_url();?>/privacy-policy">個人情報保護方針</a></li>
				<li><a href="<?php echo home_url();?>/inquiry">お問い合わせ</a></li>
				<li><a href="<?php echo home_url();?>/sitemaps">サイトマップ</a></li>
			</ul>
		</div>
	</nav>
	<p><small>© <?php bloginfo('site-name');?></small></p>
</footer>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<script src="<?php echo get_template_directory_uri();?>/js/header.min.js" async></script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<!-- 最後の +1 ボタン タグの後に次のタグを貼り付けてください。 -->
<script type="text/javascript">
  window.___gcfg = {lang: 'ja'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<?php wp_footer(); ?>
</body>
</html>
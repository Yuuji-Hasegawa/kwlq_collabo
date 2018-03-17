<?php get_header();?>
<article class="under-page">
	<div class="container">
		<p class="lead">お探しのページは見つかりませんでした。</p>
		<p>大変申し訳ありません。お探しのページは</p>
		<ul class="inner-ul">
			<li>すでに削除されている・公開期間が終わっている</li>
			<li>アクセスしたアドレスが異なっている</li>
		</ul>
		<p>などの理由で見つかりませんでした。</p>
		<p>引き続き、このサイトをご利用いただく場合は、</p>
		<ul class="inner-ul">
			<li><a href="<?php echo home_url();?>">トップページ</a>から改めてリンクをたどる</li>
			<li><a href="<?php echo home_url();?>/sitemaps">サイトマップ</a>を参照する</li>
		</ul>
		<p>上記の方法をご利用ください。</p>
		<button><a href="<?php echo home_url();?>">トップページへ戻る</a></button>
	</div>
</article>
<?php get_footer();?>
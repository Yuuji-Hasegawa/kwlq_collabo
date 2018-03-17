<!DOCTYPE html>
<html lang="ja" itemscope itemtype="http://schema.org/Blog">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width,initial-scale=1" name="viewport">
<meta content="telephone=no" name="format-detection">
<meta content="address=no" name="format-detection">
<link href="<?php echo get_template_directory_uri();?>/favicon.ico" rel="icon">
<link href="<?php echo get_template_directory_uri();?>/img/touch-icon.png" rel="apple-touch-icon">
<title><?php bloginfo('name');?><?php wp_title(' : ');?></title>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/style.css">
<!--OGP開始-->
<meta property="fb:app_id" content="1710207302335501" />
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="website">

<?php
if (is_single()){// 投稿記事
     if(have_posts()): while(have_posts()): the_post();
          echo '<meta property="og:description" content="'.mb_substr(get_the_excerpt(), 0, 100).'">';echo "\n";//抜粋から
     endwhile; endif;
     echo '<meta property="og:title" content="'; the_title(); echo '">';echo "\n";//投稿記事タイトル
     echo '<meta property="og:url" content="'; the_permalink(); echo '">';echo "\n";//投稿記事パーマリンク
} else {//投稿記事以外（ホーム、カテゴリーなど）
     echo '<meta property="og:description" content="'; bloginfo('description'); echo '">';echo "\n";//「一般設定」で入力したブログの説明文
     echo '<meta property="og:title" content="'; bloginfo('name'); echo '">';echo "\n";//「一般設定」で入力したブログのタイトル
     echo '<meta property="og:url" content="'; bloginfo('url'); echo '">';echo "\n";//「一般設定」で入力したブログのURL
}
?>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<?php
$str = $post->post_content;
$searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';//投稿記事に画像があるか調べる
if (is_single() or is_page() or !is_front_page()){//投稿記事か固定ページの場合
if (has_post_thumbnail()){//アイキャッチがある場合
     $image_id = get_post_thumbnail_id();
     $image = wp_get_attachment_image_src( $image_id, 'full');
     echo '<meta property="og:image" content="'.$image[0].'">';echo "\n";
} else if ( preg_match( $searchPattern, $str, $imgurl ) && !is_archive()) {//アイキャッチは無いが画像がある場合
     echo '<meta property="og:image" content="'.$imgurl[2].'">';echo "\n";
} else {//画像が1つも無い場合
     echo '<meta property="og:image" content="'; echo get_template_directory_uri(); echo '/img/ogp.png">';echo "\n";
}
} else {//投稿記事や固定ページ以外の場合（ホーム、カテゴリーなど）
     echo '<meta property="og:image" content="'; echo get_template_directory_uri(); echo '/img/ogp.png">';echo "\n";
}
?>
<!--OGP完了-->

<!-- g+_ogp -->
<?php
if (is_single()){// 投稿記事
     if(have_posts()): while(have_posts()): the_post();
          echo '<meta itemprop="description" content="'.mb_substr(get_the_excerpt(), 0, 100).'">';echo "\n";//抜粋から
     endwhile; endif;
     echo '<meta itemprop="name" content="'; the_title(); echo '">';echo "\n";//投稿記事タイトル
} else {//投稿記事以外（ホーム、カテゴリーなど）
     echo '<meta itemprop="description" content="'; bloginfo('description'); echo '">';echo "\n";//「一般設定」で入力したブログの説明文
     echo '<meta itemprop="name" content="'; bloginfo('name'); echo '">';echo "\n";//「一般設定」で入力したブログのタイトル
}
?>
<?php
$str = $post->post_content;
$searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';//投稿記事に画像があるか調べる
if (is_single() or is_page() or !is_front_page()){//投稿記事か固定ページの場合
if (has_post_thumbnail()){//アイキャッチがある場合
     $image_id = get_post_thumbnail_id();
     $image = wp_get_attachment_image_src( $image_id, 'full');
     echo '<meta itemprop="image" content="'.$image[0].'">';echo "\n";
} else if ( preg_match( $searchPattern, $str, $imgurl ) && !is_archive()) {//アイキャッチは無いが画像がある場合
     echo '<meta itemprop="image" content="'.$imgurl[2].'">';echo "\n";
} else {//画像が1つも無い場合
     echo '<meta itemprop="image" content="'; echo get_template_directory_uri(); echo '/img/ogp.png">';echo "\n";
}
} else {//投稿記事や固定ページ以外の場合（ホーム、カテゴリーなど）
     echo '<meta itemprop="image" content="'; echo get_template_directory_uri(); echo '/img/ogp.png">';echo "\n";
}
?>
<!-- g+_ogp終了 -->

<?php wp_head();?>
</head>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1710207302335501',
      xfbml      : true,
      version    : 'v2.12'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<body <?php body_class();?>>
<header>
	<div class="container">
		<p class="site-logo"><a href="<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri();?>/img/logo.png" width="473" height="99" alt="xxxxxx株式会社"></a></p>
		<button class="navBtn" aria-label="ナビゲーション" aria-controls="gnav" aria-expanded="true">
			<span></span>
		</button>
	</div>
	<nav class="gnav" role="navigation">
		<ul>
			<li><a href="<?php echo home_url();?>/aboutus">xxxについて</a></li>
			<li><a href="<?php echo home_url();?>/service">事業案内</a></li>
			<li><a href="#">その他コンテンツ1</a></li>
			<li><a href="<?php echo home_url();?>/examples">導入事例</a></li>
			<li><a href="<?php echo home_url();?>/voice">お客様の声</a></li>
			<li><a href="<?php echo home_url();?>/inquiry">お問い合わせ</a></li>
		</ul>
	</nav>
</header>
<section id="main-contents">
	<main>
		<?php if(!is_front_page()):?>
		<div class="page-title">
		  <h1><?php if(is_post_type_archive()):?><?php post_type_archive_title();?><?php elseif(is_search()):?><?php printf( __( 'Search Results for: %s', 'altitude' ), '<span>' . get_search_query() . '</span>' ); ?><?php elseif(is_404()):?>404 Not found.<?php else:?><?php the_title();?><?php endif;?></h1>
		</div>
		<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
		    <?php breadcrumb(); ?>
		</div>
		<?php endif;?>
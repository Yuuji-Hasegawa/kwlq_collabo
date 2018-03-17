<?php

add_theme_support('post-thumbnails');

function shortcode_sitename(){
    return get_bloginfo('name');
}
add_shortcode('site_name','shortcode_sitename');

function shortcode_url() {
    return home_url();
}
add_shortcode('url', 'shortcode_url');

function shortcode_templateurl() {
    return get_template_directory_uri();
}
add_shortcode('template_url', 'shortcode_templateurl');

add_filter('widget_text', 'do_shortcode' );

function custom_login_logo_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'custom_login_logo_url' );

function custom_login_logo_title() {
  return get_option( 'blogname' );
}
add_filter( 'login_headertitle', 'custom_login_logo_title' );

// バージョン更新を非表示にする
if (!current_user_can( 'administrator')) {
add_filter('pre_site_transient_update_core', '__return_zero');
}
// APIによるバージョンチェックの通信をさせない
if (!current_user_can( 'administrator')) {
remove_action('wp_version_check', 'wp_version_check');
remove_action('admin_init', '_maybe_update_core');
}

// フッターWordPressリンクを非表示に
function custom_admin_footer() {
 echo '<a href="mailto:info@kamenwriter.com">管理者へのお問い合わせ</a>';
 }
add_filter('admin_footer_text', 'custom_admin_footer');

// 管理バーの項目を非表示
if (!current_user_can( 'administrator')) {
function remove_admin_bar_menu( $wp_admin_bar ) {
 $wp_admin_bar->remove_menu( 'wp-logo' ); // WordPressシンボルマーク
 $wp_admin_bar->remove_menu('my-account'); // マイアカウント
 }
add_action( 'admin_bar_menu', 'remove_admin_bar_menu', 70 );
}

// 管理バーのヘルプメニューを非表示にする
function my_admin_head(){
 echo '<style type="text/css">#contextual-help-link-wrap{display:none;}</style>';
 }
add_action('admin_head', 'my_admin_head');

// 管理バーにログアウトを追加
function add_new_item_in_admin_bar() {
 global $wp_admin_bar;
 $wp_admin_bar->add_menu(array(
 'id' => 'new_item_in_admin_bar',
 'title' => __('ログアウト'),
 'href' => wp_logout_url()
 ));
 }
add_action('wp_before_admin_bar_render', 'add_new_item_in_admin_bar');

// ダッシュボードウィジェット非表示
function example_remove_dashboard_widgets() {
 if (!current_user_can('level_7')) { //level10以下のユーザーの場合ウィジェットをunsetする
 global $wp_meta_boxes;
 unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // 現在の状況
 unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // 最近のコメント
 unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // 被リンク
 unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // プラグイン
 unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // クイック投稿
 unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // 最近の下書き
 unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPressブログ
 unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // WordPressフォーラム
 }
 }
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets');

// 投稿画面の項目を非表示にする
function remove_default_post_screen_metaboxes() {
 if (!current_user_can('level_7')) { // level10以下のユーザーの場合メニューをremoveする
 remove_meta_box( 'postcustom','post','normal' ); // カスタムフィールド
 remove_meta_box( 'postexcerpt','post','normal' ); // 抜粋
 remove_meta_box( 'commentstatusdiv','post','normal' ); // ディスカッション
 remove_meta_box( 'commentsdiv','post','normal' ); // コメント
 remove_meta_box( 'trackbacksdiv','post','normal' ); // トラックバック
 remove_meta_box( 'authordiv','post','normal' ); // 作成者
 remove_meta_box( 'slugdiv','post','normal' ); // スラッグ
 remove_meta_box( 'revisionsdiv','post','normal' ); // リビジョン
 }
 }
add_action('admin_menu','remove_default_post_screen_metaboxes');

/*
 * メディアの抽出条件にログインユーザーの絞り込み条件を追加する
 */
function display_only_self_uploaded_medias( $wp_query ) {
    if ( is_admin() && ( $wp_query->is_main_query() || ( defined( 'DOING_QUERY_ATTACHMENT' ) && DOING_QUERY_ATTACHMENT ) ) && $wp_query->get( 'post_type' ) == 'attachment' ) {
        $user = wp_get_current_user();
        $wp_query->set( 'author', $user->ID );
    }
}
function define_doing_query_attachment_const() {
    if ( ! defined( 'DOING_QUERY_ATTACHMENT' ) ) {
        define( 'DOING_QUERY_ATTACHMENT', true );
    }
}

get_currentuserinfo();
if($current_user->user_level < 7){
    add_action( 'pre_get_posts', 'display_only_self_uploaded_medias' );
    add_action( 'wp_ajax_query-attachments', 'define_doing_query_attachment_const', 0 );
}

//入力画面 現在の状況　のWordPress表示を消す
function my_admin_print_styles(){
    if (!current_user_can('level_7')) {
        echo '<style type="text/css">.versions p,#wp-version-message{display:none;}</style>';
    }
}
add_action('admin_print_styles', 'my_admin_print_styles', 21);

function remove_menus () {
 if (!current_user_can('level_7')) { //level10以下のユーザーの場合メニューをunsetする
 remove_menu_page('wpcf7'); //Contact Form 7
 global $menu;
 unset($menu[2]); // ダッシュボード
 //unset($menu[4]); // メニューの線1
 unset($menu[5]); // 投稿
 //unset($menu[10]); // メディア
 unset($menu[15]); // リンク
 unset($menu[20]); // ページ
 unset($menu[25]); // コメント
 //unset($menu[59]); // メニューの線2
 unset($menu[60]); // テーマ
 unset($menu[65]); // プラグイン
 //unset($menu[70]); // プロフィール
 unset($menu[75]); // ツール
 unset($menu[80]); // 設定
 unset($menu[90]); // メニューの線3
 }
 }
add_action('admin_menu', 'remove_menus');

/* カスタム投稿 */
/* カスタム投稿タイプの追加 */
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'news', /* post-type */
    array(
      'labels' => array(
        'name' => 'お知らせ',
        'singular_name' => 'お知らせ',
        'add_new_item' => 'お知らせの新規追加',
        'edit_item' => 'お知らせの編集'
      ),
      'public' => true,
      'menu_position' =>6,
      'has_archive' => true,
      'supports' => array('title','editor')
    )
  );
  register_post_type( 'blog', /* post-type */
    array(
      'labels' => array(
        'name' => 'ブログ',
        'singular_name' => 'ブログ',
        'add_new_item' => 'ブログの新規追加',
        'edit_item' => 'ブログの編集'
      ),
      'public' => true,
      'menu_position' =>10,
      'has_archive' => true,
      'supports' => array('title','editor','excerpt','thumbnail')
    )
  );
  register_post_type( 'examples', /* post-type */
    array(
      'labels' => array(
        'name' => '実績',
        'singular_name' => '実績',
        'add_new_item' => '実績の新規追加',
        'edit_item' => '実績の編集'
      ),
      'public' => true,
      'menu_position' =>11,
      'has_archive' => true,
      'supports' => array('title','editor','excerpt','thumbnail')
    )
  );
  register_post_type( 'voice', /* post-type */
    array(
      'labels' => array(
        'name' => 'お客様の声',
        'singular_name' => 'お客様の声',
        'add_new_item' => 'お客様の声の新規追加',
        'edit_item' => 'お客様の声の編集'
      ),
      'public' => true,
      'menu_position' =>12,
      'has_archive' => true,
      'supports' => array('title','editor','excerpt','thumbnail')
    )
  );
}

/* post_id.htmlにRewrite */
add_action('init', 'myposttype_rewrite');
function myposttype_rewrite() {
    global $wp_rewrite;

    $queryarg = 'post_type=news&p=';
    $wp_rewrite->add_rewrite_tag('%news_id%', '([^/]+)',$queryarg);
    $wp_rewrite->add_permastruct('news', '/news/%news_id%.html', false);

    $queryarg = 'post_type=blog&p=';
    $wp_rewrite->add_rewrite_tag('%blog_id%', '([^/]+)',$queryarg);
    $wp_rewrite->add_permastruct('blog', '/blog/%blog_id%.html', false);

    $queryarg = 'post_type=examples&p=';
    $wp_rewrite->add_rewrite_tag('%examples_id%', '([^/]+)',$queryarg);
    $wp_rewrite->add_permastruct('examples', '/examples/%examples_id%.html', false);

    $queryarg = 'post_type=voice&p=';
    $wp_rewrite->add_rewrite_tag('%voice_id%', '([^/]+)',$queryarg);
    $wp_rewrite->add_permastruct('voice', '/voice/%voice_id%.html', false);

}

add_filter('post_type_link', 'myposttype_permalink', 1, 3);
 
function myposttype_permalink($post_link, $id = 0, $leavename) {
    global $wp_rewrite;
    $post = &get_post($id);
    if ( is_wp_error( $post ) )
        return $post;
    $newlink = $wp_rewrite->get_extra_permastruct($post->post_type);
    $newlink = str_replace('%'.$post->post_type.'_id%', $post->ID, $newlink);
    $newlink = home_url(user_trailingslashit($newlink));
    return $newlink;
}

add_action( 'save_post', 'save_default_thumbnail' );
function save_default_thumbnail( $post_id ) {
	$post_thumbnail = get_post_meta( $post_id, $key = '_thumbnail_id', $single = true );
	if ( !wp_is_post_revision( $post_id ) ) {
		if ( empty( $post_thumbnail ) ) {
			update_post_meta( $post_id, $meta_key = '_thumbnail_id', $meta_value = '34' );
		}
	}
}

add_filter('the_content', 'wpautop_filter', 9);
function wpautop_filter($content) {
global $post;
$remove_filter = false;
 
$arr_types = array('page','blog','examples','voice'); /*自動整形を解除・無効にする投稿タイプを記述*/
$post_type = get_post_type( $post->ID );
if (in_array($post_type, $arr_types)) $remove_filter = true;
 
if ( $remove_filter ) {
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
}
return $content;
}

// self_pinback
function no_self_ping( &$links ) {
    $home = get_option( 'home' );
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );

//パンくず
function breadcrumb(){
  global $post;
  $str ='';
  $pNum = 2;
  $str.= '<ul itemprop="Breadcrumb" itemscope itemtype="http://data-vocabulary.org/BreadcrumbList">';
  $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'.home_url('/').'" class="home"><span itemprop="name"><i class="fas fa-home"></i></span></a><meta itemprop="position" content="1"></li>';
  /* 通常の投稿ページ */
  if(is_singular('post')){
    $categories = get_the_category($post->ID);
    $cat = $categories[0];
    if($cat->parent != 0){
      $ancestors = array_reverse(get_ancestors($cat->cat_ID, 'category'));
      foreach($ancestors as $ancestor){
        $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_category_link($ancestor).'"><span itemprop="name">'.get_cat_name($ancestor).'</span></a><meta itemprop="position" content="'.$pNum.'"></li>';
        $pNum++;
      }
    }
    $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_category_link($cat-> term_id). '"><span itemprop="name">'. $cat-> cat_name . '</span></a><meta itemprop="position" content="'.$pNum.'"></li>';
    $pNum++;
    $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'.$post->post_title.'</span><meta itemprop="position" content="'.$pNum.'"></li>';
  } 
  /* カスタムポスト */
  elseif(is_single() && !is_singular('post')){
    $cp_name = get_post_type_object(get_post_type())->label;
    $cp_url = home_url('/').get_post_type_object(get_post_type())->name;
    $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'.$cp_url.'"><span itemprop="name">'.$cp_name.'</span></a><meta itemprop="position" content="2"></li>';
    $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'.$post->post_title.'</span><meta itemprop="position" content="3"></li>'; 
  }
  /* 固定ページ */
  elseif(is_page()){
    $pNum = 2;
    if($post->post_parent != 0){
      $ancestors = array_reverse(get_post_ancestors($post->ID));
      foreach($ancestors as $ancestor){
        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_permalink($ancestor).'"><span itemprop="name">'.get_the_title($ancestor).'</span></a><meta itemprop="position" content="'.$pNum.'"></li>';
        $pNum++;
      }
    }
    $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $post->post_title.'</span><meta itemprop="position" content="'.$pNum.'"></li>';
  }
  /* カテゴリページ */ 
  elseif(is_category()) {
    $cat = get_queried_object();
    $pNum = 2;
    if($cat->parent != 0){
      $ancestors = array_reverse(get_ancestors($cat->cat_ID, 'category'));
      foreach($ancestors as $ancestor){
        $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_category_link($ancestor) .'"><span itemprop="name">'.get_cat_name($ancestor).'</span></a><meta itemprop="position" content="'.$pNum.'"></li>';
      }
    }
    $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'.$cat->name.'</span><meta itemprop="position" content="'.$pNum.'"></li>';
  }
  /* タグページ */
  elseif(is_tag()){
    $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. single_tag_title( '' , false ). '</span><meta itemprop="position" content="2"></li>';
  } 
  /* 時系列アーカイブページ */
  elseif(is_date()){
    if(get_query_var('day') != 0){
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_year_link(get_query_var('year')).'"><span itemprop="name">'.get_query_var('year').'年</span></a><meta itemprop="position" content="2"></li>';
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_month_link(get_query_var('year'), get_query_var('monthnum')).'"><span itemprop="name">'.get_query_var('monthnum').'月</span></a><meta itemprop="position" content="3"></li>';
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'.get_query_var('day'). '</span>日<meta itemprop="position" content="4"></li>';
    } elseif(get_query_var('monthnum') != 0){
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_year_link(get_query_var('year')).'"><span itemprop="name">'.get_query_var('year').'年</span.</a><meta itemprop="position" content="2"></li>';
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'.get_query_var('monthnum'). '</span>月<meta itemprop="position" content="3"></li>';
    } else {
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'.get_query_var('year').'年</span><meta itemprop="position" content="2"></li>';
    }
  }
  /* 投稿者ページ */
  elseif(is_author()){
    $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">投稿者 : '. get_the_author_meta('display_name', get_query_var('author')).'</span><meta itemprop="position" content="2"></li>';
  } 
  /* 添付ファイルページ */
  elseif(is_attachment()){
    $pNum = 2;
    if($post -> post_parent != 0 ){
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'.get_permalink($post-> post_parent).'"><span itemprop="name">'.get_the_title($post->post_parent).'</span></a><meta itemprop="position" content="'.$pNum.'"></li>';
      $pNum++;
    }
    $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'.$post->post_title.'</span><meta itemprop="position" content="'.$pNum.'"></li>';
  }
  /* 検索結果ページ */
  elseif(is_search()){
    $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">「'.get_search_query().'」で検索した結果</span><meta itemprop="position" content="2"></li>';
  } 
  /* 404 Not Found ページ */
  elseif(is_404()){
    $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">お探しの記事は見つかりませんでした。</span><meta itemprop="position" content="2"></li>';
  } 
  /* その他のページ */
  else{
    $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'.wp_title('', false).'</span><meta itemprop="position" content="2"></li>';
  }
  
  $str.= '</ul>';
  echo $str;
}
/*
function replace_jquery() {
  if (!is_admin()) {
    // comment out the next two lines to load the local copy of jQuery
    wp_deregister_script('jquery');
  }
}
add_action('init', 'replace_jquery');
*/

// pagination
function pagination($pages = '', $range = 1)
{
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><div class=\"pagination-box\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div></div>\n";
     }
}

// 不要なヘッダタグ削除
remove_action( 'wp_head', 'feed_links', 2 ); //サイト全体のフィード
remove_action( 'wp_head', 'feed_links_extra', 3 ); //その他のフィード
remove_action( 'wp_head', 'rsd_link' ); //Really Simple Discoveryリンク
remove_action( 'wp_head', 'wlwmanifest_link' ); //Windows Live Writerリンク
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); //前後の記事リンク
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); //ショートリンク
remove_action( 'wp_head', 'rel_canonical' ); //canonical属性
remove_action( 'wp_head', 'wp_generator' ); //WPバージョン

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('admin_print_styles', 'print_emoji_styles');

//last-modified
function get_last_modified_date(){
  $date = array(
    get_the_modified_time("Y"),
    get_the_modified_time("m"),
    get_the_modified_time("d")
  );
  $time = array(
    get_the_modified_time("H"),
    get_the_modified_time("i"),
    get_the_modified_time("s"),
  );

  $time_str = implode("-", $date) . "T" . implode(":", $time) . "+09:00";

  // UNIXタイムスタンプに変換後、日付（RFC2822）を返す
  return date( "r", strtotime($time_str) );
}

function add_last_modified(){
  if( is_single() ){
    header( sprintf( "Last-Modified: %s", get_last_modified_date() ) );
  }
}

add_action( "template_redirect", "add_last_modified" );

add_action( "wp_head", "add_last_modified_meta" );
function add_last_modified_meta(){
  echo '<meta http-equiv="Last-Modified" content="'.
  get_last_modified_date().
  '">';
}

?>
<?php
//javascript読込
function custom_print_scripts() {
        if (!is_admin()) {
        //デフォルトjquery削除
        wp_deregister_script('jquery');
        //CDNから読み込む
        wp_enqueue_script('jquery-js', '//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js' );
        }
    }
    add_action('wp_print_scripts', 'custom_print_scripts');

// アイキャッチ画像を有効化
if( function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
}

function mytheme_widgets()
{
    register_sidebar(array(
        'id' => 'sidebar-1',
        'name' => ' サイドメニュー ',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
    ));
}  add_action('widgets_init', 'mytheme_widgets');

add_filter( 'widget_archives_args', 'hook_widget_archives_args' );

function hook_widget_archives_args( $args ) {
// 月別表示
$args['type'] = 'monthly';
// 最大出力件数を●件に設定
$args['limit'] = 16;
return $args;
}


// 不要メタの追加と削除
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head',10);

// titleタグ出力時のセパレーターを変更
function change_title_separator( $sep ){
    $sep = '|';
    return $sep;
}
add_filter( 'document_title_separator', 'change_title_separator' );

/**
* ページネーション出力関数
* $paged : 現在のページ
* $pages : 全ページ数
* $range : 左右に何ページ表示するか
* $show_only : 1ページしかない時に表示するかどうか
*/
function pagination( $pages, $paged, $range = 2, $show_only = false ) {

    $pages = ( int ) $pages;    //float型で渡ってくるので明示的に int型 へ
    $paged = $paged ?: 1;       //get_query_var('paged')をそのまま投げても大丈夫なように

    //表示テキスト
    $text_first   = "« 最初へ";
    $text_before  = "‹ 前へ";
    $text_next    = "次へ ›";
    $text_last    = "最後へ »";

    if ( $show_only && $pages === 1 ) {
        // １ページのみで表示設定が true の時
        echo '<div class="pagination"><span class="current pager">1</span></div>';
        return;
    }

    if ( $pages === 1 ) return;    // １ページのみで表示設定もない場合

    if ( 1 !== $pages ) {
        //２ページ以上の時
        echo '<div class="pagination"><span class="page_num">Page ', $paged ,' of ', $pages ,'</span>';
        if ( $paged > $range + 1 ) {
            // 「最初へ」 の表示
            echo '<a href="', get_pagenum_link(1) ,'" class="first">', $text_first ,'</a>';
        }
        if ( $paged > 1 ) {
            // 「前へ」 の表示
            echo '<a href="', get_pagenum_link( $paged - 1 ) ,'" class="prev">', $text_before ,'</a>';
        }
        for ( $i = 1; $i <= $pages; $i++ ) {
            if ( $i <= $paged + $range && $i >= $paged - $range ) {
                // $paged +- $range 以内であればページ番号を出力
                if ( $paged === $i ) {
                    echo '<span class="current pager">', $i ,'</span>';
                } else {
                    echo '<a href="', get_pagenum_link( $i ) ,'" class="pager">', $i ,'</a>';
                }
            }
        }
        if ( $paged < $pages ) {
            // 「次へ」 の表示
            echo '<a href="', get_pagenum_link( $paged + 1 ) ,'" class="next">', $text_next ,'</a>';
        }
        if ( $paged + $range < $pages ) {
            // 「最後へ」 の表示
            echo '<a href="', get_pagenum_link( $pages ) ,'" class="last">', $text_last ,'</a>';
        }
        echo '</div>';
    }
}



/* ----- 管理画面用 ----- */

// ダッシュボードの非表示
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // 最近のコメント
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // 被リンク
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // プラグイン
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPressブログ
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // WordPressフォーラム
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // クイック投稿
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

// サイドメニューの非表示
function remove_menus() {
	global $menu;
	unset($menu[15]); // リンク
	unset($menu[25]); // コメント
	remove_submenu_page('index.php', 'update-core.php'); // ダッシュボード⇒更新
	//remove_submenu_page('themes.php', 'themes.php'); // 外観⇒テーマ
}
add_action('admin_menu', 'remove_menus');

// 管理者以外のアップデート通知オフ
function remove_plugin_update(){
	global $menu,$submenu;
	$menu[65][0] = 'プラグイン';
	$submenu['index.php'][10][0] = 'Updates';
}
if (!current_user_can('administrator')) {
	add_filter('pre_site_transient_update_core', create_function('$a', "return null;"));
	add_action('admin_menu', 'remove_plugin_update');
}

// 管理画面のロゴ削除
function remove_admin_bar_menu($wp_admin_bar) {
	$wp_admin_bar->remove_menu('wp-logo');
}
add_action('admin_bar_menu','remove_admin_bar_menu',70);

//投稿内でコメントアウトできるようにする
function ignore_shortcode( $atts, $content = null ) {
	return null;
}
add_shortcode('ignore', 'ignore_shortcode');

?>
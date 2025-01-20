<?php
/**
 * Lightning Child theme functions
 *
 * @package lightning
 */

// 親テーマと子テーマのCSSを読み込む
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    // 親テーマのスタイルを読み込む
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    // 子テーマのスタイルを読み込む
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
}

// // コメント機能を完全に無効化
function disable_comments_completely() {
    // 投稿タイプ全てでコメントを無効化
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }

    // コメントのRSSフィードを無効化
    add_filter('feed_links_show_comments_feed', '__return_false');

    // 管理バーからコメントを削除
    add_action('admin_init', function () {
        remove_menu_page('edit-comments.php');
        remove_submenu_page('options-discussion.php', 'options-discussion.php');
    });

    // 既存のコメントを非表示
    add_filter('comments_array', '__return_empty_array');

    // コメントステータスを閉じる
    add_filter('comments_open', '__return_false');
    add_filter('pings_open', '__return_false');
}
add_action('init', 'disable_comments_completely');

// 管理バーからコメントを削除
function remove_comments_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'remove_comments_admin_bar');

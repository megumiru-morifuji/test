<?php
// WordPressのヘッダーを読み込む
get_header();
// 関数定義（ファイルの先頭付近に配置）
function get_blog_headings() {
    // ここで配列を定義
    $heading_fields = array('heding_one', 'heding_two', 'heding_three');
    $headings = array();
    
    foreach ($heading_fields as $field) {
        $heading_text = get_field($field);
        if (!empty($heading_text)) {
            // フィールド名とテキストの両方を保存
            $headings[] = array(
                'id' => $field,
                'text' => $heading_text
            );
        }
    }
    
    return $headings;
}


?>

<main id="main" class="site-main">
    <div class="container container-flex c-section__body">
        <?php
        // WordPressのメインループ
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
        ?>
                <article class="article-contents" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div>
						<img class="mainimg" src="<?php the_field('mainimg'); ?>" />
					</div>
					<div class="entry-meta">
                       <span><?php echo get_the_date('Y.m.d'); ?></span>
                        
                    </div>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
					<div>
						<p><?php the_field('supplement'); ?>
						</p>
					</div>
					
					<?php 
					// テンプレートファイルの任意の場所で
					$headings = get_blog_headings();

					// 見出しを表示する例
					// 目次を表示する部分
					$headings = get_blog_headings();

					if (!empty($headings)) {
						echo '<div class="headings-list contents-index__list">';
						echo '<p class="contents-index__ttl">目次</p>';
						echo '<ul>';
						foreach ($headings as $heading) {
							echo '<li><a href="#' . $heading['id'] . '">' . esc_html($heading['text']) . '</a></li>';
						}
						echo '</ul>';
						echo '</div>';
					}
					?>
					
					<div>
						<p><?php the_field('index_bottom_textarea'); ?>
							
						</p>
					</div>
					
						<?php 
					// セクション1
					if(get_field('heding_one')) : // heding_oneに値が存在する場合のみ表示
					?>
						<section id="heding_one">
							<div class="section1">
								<h2 ><?php the_field('heding_one'); ?></h2>

							</div>
							<div>
								<div><?php the_field('edita1'); ?></div>
							</div>
						</section>
					<?php endif; ?>
					<?php
					// セクション2
					if(get_field('heding_two')) : // heding_twoに値が存在する場合のみ表示
					?>
						<section id="heding_two">
							<div class="section2">
								<h2 ><?php the_field('heding_two'); ?></h2>

							</div>
							<div>
								<div><?php the_field('edita2'); ?></div>
							</div>
						</section>
					<?php endif; ?>
					
					<?php 
					// セクション3
					if(get_field('heding_three')) : // heding_threeに値が存在する場合のみ表示
					?>
						<section id="heding_three">
							<div class="section3">
								<h2 ><?php the_field('heding_three'); ?></h2>

							</div>
							<div>
								<div><?php the_field('edita3'); ?></div>
							</div>
						</section>
					<?php endif; ?>
					
					
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

<!--                     <div class="post-navigation">
                        <div class="prev"><?php previous_post_link('&laquo; %link', '前の記事'); ?></div>
                        <div class="next"><?php next_post_link('%link &raquo;', '次の記事'); ?></div>
                    </div> -->
                </article>
        <?php
            endwhile;
        else :
        ?>
            <p>投稿が見つかりませんでした。</p>
        <?php endif; ?>
		<aside class="sidebar">
    <!-- 人気記事 -->
    <div class="widget popular-posts">
        <h3 class="widget-title">人気記事</h3>
        <?php
        // 閲覧数の多い記事を取得
        $args = array(
            'post_type' => 'your_custom_post_type', // あなたのカスタム投稿タイプ名に変更
            'posts_per_page' => 5,
            'meta_key' => 'post_views_count', // 閲覧数を保存するカスタムフィールド
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        );
        $popular_posts = new WP_Query($args);
        
        if($popular_posts->have_posts()) : ?>
            <ul class="popular-posts-list">
                <?php while($popular_posts->have_posts()) : $popular_posts->the_post(); ?>
                    <li class="popular-post-item">
                        <?php if(has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="post-info">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <span class="post-date"><?php echo get_the_date('Y.m.d'); ?></span>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; wp_reset_postdata(); ?>
    </div>

    <!-- カテゴリー -->
    <div class="widget categories">
        <h3 class="widget-title">カテゴリー</h3>
        <?php
        $terms = get_terms(array(
            'taxonomy' => 'your_custom_taxonomy', // あなたのカスタムタクソノミー名に変更
            'hide_empty' => true,
        ));
        
        if($terms) : ?>
            <ul class="category-list">
                <?php foreach($terms as $term) : ?>
                    <li class="category-item">
                        <a href="<?php echo get_term_link($term); ?>">
                            <?php echo $term->name; ?>
                            <span class="post-count">(<?php echo $term->count; ?>)</span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</aside>
    </div>
	
</main>
<!-- <script>
	jQuery(document).ready(function() {
		console.log("読み込みさ れました");
      jQuery('a[href^="#"]').on('click', function(event) {
     console.log("クリックさ れました");
        // デフォルトの動作を防止
        event.preventDefault();
        
        // クリックされたリンクのhref属性（リンク先のID）を取得
        var targetId = jQuery(this).attr('href');
        
        // リンク先の要素を取得
        var $targetElement = $(targetId);
        
        if ($targetElement.length) {
            // 要素をブラウザウィンドウの一番上に持ってくる
            jQuery('html, body').animate({
                // スクロール位置を要素の上端に設定
                scrollTop: $targetElement.offset().top
            }, 500); // アニメーション時間（ミリ秒）
        }
    });
});
</script> -->

<?php
// WordPressのフッターを読み込む
get_footer();
?>

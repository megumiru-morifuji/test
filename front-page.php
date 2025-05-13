<?php
/*
Template Name: フロントページ
*/
?>

<?php get_header(); ?>

<main id="main" class="site-main">
	<div class="main-slide">
		<div class="mainimge">
			<img src="https://megumiru.jp/wine/wp-content/uploads/2025/05/test.png" loading="lazy">
		</div>
	<div class="box-text">
		<h3>ワイン片手にアートを描く<br>新スタイルのアクティビティ</h3>
    </div>
	</div>
	
	<!-- ブログ最新記事セクション -->
<section class="blog-latest-posts">
	<div class="ttl"><h2>View</h2></div>
    <div class="blog-wrap">
		<div class="posts-grid">
        <?php
        /* ページネーション用の変数設定 - フロントページ対応版 */
        // フロントページでは'page'パラメータを使用、それ以外では'paged'を使用
        $paged = (is_front_page()) ? get_query_var('page') : get_query_var('paged');
        $paged = ($paged) ? $paged : 1; // 値がない場合は1を設定

        /* パラメーター設定 */
        $args = array(
            'post_type' => 'blog', // カスタム投稿タイプ名
            'posts_per_page' => 12, // 表示する記事数
            'orderby' => 'date',   // 日付順
            'order' => 'DESC',     // 降順（最新順）
            'post_status'=> 'publish', // 公開状態を選択
            'paged' => $paged // ページネーション用設定
        );
        
        $blog_query = new WP_Query($args);
        
        if ($blog_query->have_posts()) :
            while ($blog_query->have_posts()) : $blog_query->the_post();
            
            // 使用するタクソノミーのリスト
            $taxonomies = array('ship', 'entry_preparation','event_style','japan_opportunities','price_guide','business_education','usage_scene'); // 必要に応じて追加や変更
            $all_terms = array();
            
            // すべてのタクソノミーからタームを収集
            foreach ($taxonomies as $taxonomy) {
                $terms = get_the_terms(get_the_ID(), $taxonomy);
                if ($terms && !is_wp_error($terms)) {
                    $all_terms = array_merge($all_terms, $terms);
                }
            }
        ?>
            <article class="post-card">
                <?php if (get_field('mainimg')) : ?>
                    <div class="post-thumbnail">
                        <img src="<?php the_field('mainimg'); ?>" alt="<?php the_title(); ?>">
                    </div>
                <?php endif; ?>
                <div class="post-content">
                    <div class="post-meta">
                        <time datetime="<?php echo get_the_date('c'); ?>">
                            <?php echo get_the_date('Y.m.d'); ?>
                        </time>
                        
                        <?php if (!empty($all_terms)) : ?>
                        <div class="post-terms">
                            <?php foreach ($all_terms as $term) : ?>
                                <span class="term-tag">#<?php echo $term->name; ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php if (get_field('supplement')) : ?>
                        <div class="post-excerpt">
                            <?php echo wp_trim_words(get_field('supplement'), 40); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        <?php
            endwhile; ?>
			</div>
	<?php
        /* ページネーションがあるかどうかを確認 */
        if ($blog_query->max_num_pages > 1) {
            /* ページネーションを表示 - フロントページ対応版 */
            $big = 999999999;
            
            // フロントページ用のページネーションパラメータ調整
            if (is_front_page()) {
                $pagination_base = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));
                // WordPressがフロントページで/page/2/形式を使用するようにする
                $pagination_base = str_replace('/\?page=', '/page/', $pagination_base);
                
                echo paginate_links(array(
                    'base' => $pagination_base,
                    'format' => is_front_page() ? '/page/%#%/' : '?paged=%#%',
                    'current' => max(1, $paged),
                    'total' => $blog_query->max_num_pages
                ));
            } else {
                // 通常のページネーション
                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, $paged),
                    'total' => $blog_query->max_num_pages
                ));
            }
        }
        
        wp_reset_postdata();
        endif;
        ?>
    </div>
</section>

    <div class="container">
    <!-- コメントアウトされた部分は省略しています -->
    </div>
	
	<div class="c-section section-about">
        <div class="c-section__body">
          <h2 class="c-title">
            About
          </h2>
			<p>
				Paint & Sipマガジンとは
			</p>
          <p class="u-center">シップ（お酒などをちびちびもむ）をしながらペイント（絵画）を描くという新しいスタイル、paintShip。
自己発見や、リラクゼーション、企業のチームビルディングなどあらゆる場面で活躍しています。
その魅力を知っていただくために、当ブログではPaint＆Sip に関する疑問や歴史などあらゆる有益な情報をお伝えます。

</p>
    
        </div>
      </div>
	
	<div class="c-section section-about">
        <div class="c-section__body">
          <h2 class="c-title">
            Writer
          </h2>
			<p>Paint＆Sip JAPAN
</p>
          <p class="u-center">Paint＆Sip JAPANは、Paint＆Sip を気軽に体験できる場所「artwinebarNAGOYA」を提供しています。




</p>
    
        </div>
      </div>
</main>

<?php get_footer(); ?>

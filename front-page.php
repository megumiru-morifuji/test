<?php
/*
Template Name: フロントページ
*/
?>

<?php get_header(); ?>

<main id="main" class="site-main">
	<div class="main-slide">
		<div class="mainimge">
			<img src="http://megumiru.jp/wine/wp-content/uploads/2025/01/art-7917562_1280.jpg">
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
			/* ページネーション用の変数設定 */

/* パラメーター設定 */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'blog', // カスタム投稿タイプ名
    'posts_per_page' => 6, // 表示する記事数
    'orderby' => 'date',   // 日付順
    'order' => 'DESC',     // 降順（最新順）
    'post_status'=> 'publish', // 公開状態を選択
    'paged' => $paged // ページネーション用設定
);
        $blog_query = new WP_Query($args);
        
        if ($blog_query->have_posts()) :
            while ($blog_query->have_posts()) : $blog_query->the_post();
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
	<?php 		/* ページネーションがあるかどうかを確認 */
if ($blog_query->max_num_pages > 1){
    /* ページネーションを表示 */
    $big = 999999999999; 
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), // ベースURLをセットします。
        'format' => '?paged=%#%', // ページ番号のフォーマット
        'current' => max(1, get_query_var('paged')), // 現在のページ番号
        'total' => $blog_query->max_num_pages // 総ページ数
    ));
}
            wp_reset_postdata();
        endif;
        ?>
    </div>
			
</section>
    <div class="container">
<!--         <!-- ヒーローセクション -->
<!--         <section class="hero-section">
            <div class="hero-content">
                <h1><?php the_title(); ?></h1>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; endif; ?>
            </div>
        </section>  -->

<!--         <!-- 最新の記事セクション -->
<!--         <section class="latest-posts">
            <h2>最新記事</h2>
            <div class="posts-grid">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3
                );
                $latest_posts = new WP_Query($args);
                
                if ($latest_posts->have_posts()) :
                    while ($latest_posts->have_posts()) : $latest_posts->the_post();
                ?>
                    <article class="post-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="post-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="post-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            </div>
                            <div class="post-meta">
                                <time datetime="<?php echo get_the_date('c'); ?>">
                                    <?php echo get_the_date(); ?>
                                </time>
                            </div>
                        </div>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </section> -->

         <!-- お知らせセクション -->
<!--         <section class="news-section">
            <h2>お知らせ</h2>
            <div class="news-list">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'category_name' => 'news',
                    'posts_per_page' => 5
                );
                $news_query = new WP_Query($args);

                if ($news_query->have_posts()) :
                    while ($news_query->have_posts()) : $news_query->the_post();
                ?>
                    <article class="news-item">
                        <time datetime="<?php echo get_the_date('c'); ?>">
                            <?php echo get_the_date(); ?>
                        </time>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </section> -->
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
その魅力を知っていただくために、当ブログではPaint＆Sip に関する疑問や歴史などあらゆる有益な情報をお伝えします。

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

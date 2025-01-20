<?php
/*
Template Name: フロントページ
*/
?>

<?php get_header(); ?>

<main id="main" class="site-main">
	<div class="mainimge">
		<img src="http://megumiru.jp/wine/wp-content/uploads/2025/01/art-7917562_1280.jpg">
	</div>
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
</main>

<?php get_footer(); ?>

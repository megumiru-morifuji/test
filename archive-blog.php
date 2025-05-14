<?php
/**
 * The template for displaying blog archive pages
 *
 * @package Lightning
 */
?>

<?php get_header(); ?>

<main id="main" class="site-main archive-blog">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">ブログ記事一覧</h1>
        </header>

        <div class="blog-archive-container">
            <div class="blog-archive-main">
                <?php if ( have_posts() ) : ?>
                    <div class="posts-grid">
                        <?php
                        while ( have_posts() ) : the_post();
                            // 使用するタクソノミーのリスト
                            $taxonomies = array('ship', 'entry_preparation','event_style','japan_opportunities','price_guide','business_education','usage_scene','mind_body_effects'); // 必要に応じて追加や変更
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
                        <?php endwhile; ?>
                    </div>

                    <?php
                    // アーカイブページのページネーション
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => '&laquo;',
                        'next_text' => '&raquo;',
                        'screen_reader_text' => 'ページ送り'
                    ));
                    ?>

                <?php else : ?>
                    <p class="no-posts-found">記事が見つかりませんでした。</p>
                <?php endif; ?>
            </div>

            <div class="blog-archive-sidebar">
                <?php get_sidebar(); // サイドバーを表示する場合 ?>
                <!-- または、カスタムサイドバーコンテンツをここに記述 -->
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>

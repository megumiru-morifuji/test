<?php
// WordPressのヘッダーを読み込む
get_header();
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
						<img src="<?php the_field('mainimg'); ?>" />
					</div>
					<div class="entry-meta">
                       <span><?php echo get_the_date('Y.m.d'); ?></span>
                        
                    </div>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
					<div>
						<p><?php the_field('supplement'); ?>
						</p>
					</div>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-navigation">
                        <div class="prev"><?php previous_post_link('&laquo; %link', '前の記事'); ?></div>
                        <div class="next"><?php next_post_link('%link &raquo;', '次の記事'); ?></div>
                    </div>
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

<?php
// WordPressのフッターを読み込む
get_footer();
?>

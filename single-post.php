<?php

/**
 * Single Post Template (News Detail)
 */
if (!defined('ABSPATH')) exit; ?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<main id="news-detail-page" class="main-content">
    
    <div class="container">
        <!-- ニュース記事 -->
        <article class="news-article">
            <div class="article-container">
                <!-- 記事メタ情報 -->
                <header class="news-header">
                    <time class="news-date"><?php echo get_the_date('Y/m/d'); ?></time>
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo '<span class="news-category">' . esc_html(strtoupper($categories[0]->name)) . '</span>';
                    }
                    ?>
                    <h2 class="news-title"><?php the_title(); ?></h2>
                </header>

                <!-- 記事本文 -->
                <div class="news-content">
                    <?php
                    // アイキャッチ画像がある場合は表示
                    if (has_post_thumbnail()) {
                        echo '<div class="news-featured-image">';
                        the_post_thumbnail('large', array('alt' => get_the_title()));
                        echo '</div>';
                    }
                    
                    // 記事本文を表示
                    the_content();
                    
                    // ページネーション（複数ページの記事の場合）
                    wp_link_pages(array(
                        'before' => '<div class="page-links">',
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
            </div>
        </article>
        
        <!-- Back to List ボタン -->
        <a href="<?php echo get_permalink( get_page_by_path( 'news-list' ) ); ?>" class="section-button">BACK TO LIST</a>
    </div>
</main>

<?php endwhile; endif; ?>

<?php get_footer(); ?>

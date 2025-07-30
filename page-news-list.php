<?php

/**
 * Post Archive Page Template (News List)
 */
if (!defined('ABSPATH')) exit; ?>
<?php get_header(); ?>

<main id="news-page" class="main-content">

    <!-- ニュース一覧 -->
    <section class="news-list">
        <div class="container">
            <div class="filter-bar">
                <div class="filter-tags">
                    <a href="<?php echo get_permalink(get_page_by_path('news-list')); ?>" class="<?php echo !isset($_GET['category']) ? 'active' : ''; ?>">
                        すべて
                    </a>
                    <?php
                    // カテゴリーフィルターを動的に生成
                    $categories = get_categories(array(
                        'orderby' => 'name',
                        'order'   => 'ASC',
                        'hide_empty' => true
                    ));
                    
                    foreach ($categories as $category) {
                        $is_active = isset($_GET['category']) && $_GET['category'] == $category->slug ? 'active' : '';
                        $category_link = add_query_arg('category', $category->slug, get_post_type_archive_link('post'));
                        echo '<a href="'.get_permalink(get_page_by_path('news-list')). esc_url('?category='.$category->slug) . '" class="' . $is_active . '">';
                        echo esc_html($category->name);
                        echo '</a>';
                    }
                    ?>
                </div>
            </div>
            
            <div class="news-container">
                <?php
                // クエリの設定
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 10,
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                    'post_status' => 'publish'
                );

                // カテゴリーフィルターが設定されている場合
                if (isset($_GET['category']) && !empty($_GET['category'])) {
                    $args['category_name'] = sanitize_text_field($_GET['category']);
                }

                $news_query = new WP_Query($args);

                // ページネーションのための変数
                $args['total_page'] = $news_query->max_num_pages;

                if ($news_query->have_posts()) :
                    while ($news_query->have_posts()) : $news_query->the_post();
                        $categories = get_the_category();
                ?>
                    <a href="<?php the_permalink(); ?>" class="">
                        <article class="news-item">
                            <div class="news-content">
                                <div class="news-info">
                                    <time class="news-date"><?php echo get_the_date('Y/m/d'); ?></time>
                                    <?php foreach ($categories as $cat) : ?>
                                        <span class="news-category"><?php echo esc_html($cat->name); ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <h3 class="news-title"><?php the_title(); ?></h3>
                            </div>
                            <div class="news-arrow">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.375 12.75L10.625 8.5L6.375 4.25" stroke="#E65D3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </article>
                    </a>
                <?php
                    endwhile;
                else :
                ?>
                    <div class="no-posts">
                        <p>まだニュースがありません。</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
         <?php get_template_part('pagination', null, $args) ?>
    </section>
    <!-- ページネーション -->
    <?php wp_reset_postdata(); ?>
</main>

<?php get_footer(); ?>

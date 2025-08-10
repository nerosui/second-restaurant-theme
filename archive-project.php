<?php

/**
 * Project Archive Page Template
 */
if (!defined('ABSPATH')) exit; ?>
<?php get_header(); ?>

<main id="project-page" class="main-content simple-page">

    <section class="page-intro project-intro">
        <div class="container">
            <h2 class="page-section-title">セカンドレストラン開催情報</h2>
            <p class="section-description">
                地域パートナーとシェフが出会い、期間限定で生まれる"もうひとつのレストラン"。これまでに開催されたプロジェクトと、これから予定されている開催情報をご紹介します。
            </p>
        </div>
    </section>

    <section class="bg-list">
        <div class="container">
            <div class="filter-tags">
                <a href="<?php echo get_post_type_archive_link('project'); ?>" class="<?php echo !isset($_GET['filter']) ? 'active' : ''; ?>">
                    すべて
                </a>
                <a href="<?php echo add_query_arg('filter', 'upcoming', get_post_type_archive_link('project')); ?>" class="<?php echo (isset($_GET['filter']) && $_GET['filter'] == 'upcoming') ? 'active' : ''; ?>">
                    近日開催
                </a>
                <a href="<?php echo add_query_arg('filter', 'current', get_post_type_archive_link('project')); ?>" class="<?php echo (isset($_GET['filter']) && $_GET['filter'] == 'current') ? 'active' : ''; ?>">
                    開催中
                </a>
                <a href="<?php echo add_query_arg('filter', 'ended', get_post_type_archive_link('project')); ?>" class="<?php echo (isset($_GET['filter']) && $_GET['filter'] == 'ended') ? 'active' : ''; ?>">
                    終了
                </a>
            </div>

            <section class="project">
                <div class="container">
                    <div class="project-grid">
                        <?php
                        // フィルタリング用のクエリ設定
                        $args = array(
                            'post_type' => 'project',
                            'posts_per_page' => 12,
                            'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                            'post_status' => 'publish'
                        );

                        // フィルタに応じた日付クエリ
                        if (isset($_GET['filter'])) {
                            $filter = sanitize_text_field($_GET['filter']);
                            $today = date('Y-m-d');
                            
                            switch ($filter) {
                                case 'upcoming':
                                    $args['meta_query'] = array(
                                        array(
                                            'key' => 'start_date',
                                            'value' => $today,
                                            'compare' => '>',
                                            'type' => 'DATE'
                                        )
                                    );
                                    break;
                                case 'current':
                                    $args['meta_query'] = array(
                                        'relation' => 'AND',
                                        array(
                                            'key' => 'start_date',
                                            'value' => $today,
                                            'compare' => '<=',
                                            'type' => 'DATE'
                                        ),
                                        array(
                                            'key' => 'end_date',
                                            'value' => $today,
                                            'compare' => '>=',
                                            'type' => 'DATE'
                                        )
                                    );
                                    break;
                                case 'ended':
                                    $args['meta_query'] = array(
                                        array(
                                            'key' => 'end_date',
                                            'value' => $today,
                                            'compare' => '<',
                                            'type' => 'DATE'
                                        )
                                    );
                                    break;
                            }
                        }

                        $projects = new WP_Query($args);

                        if ($projects->have_posts()) :
                            $i = 0;
                            while ($projects->have_posts()) : $projects->the_post();
                                $i++;
                                $start_date = get_post_meta(get_the_ID(), 'start_date', true);
                                $end_date = get_post_meta(get_the_ID(), 'end_date', true);
                                $is_pickup = get_post_meta(get_the_ID(), 'is_pickup', true);
                                
                                // 日付のフォーマット
                                $formatted_start = $start_date ? date('Y/m/d', strtotime($start_date)) : '';
                                $formatted_end = $end_date ? date('Y/m/d', strtotime($end_date)) : '';
                                $date_range = $formatted_start && $formatted_end ? $formatted_start . ' - ' . $formatted_end : get_the_date('Y/m/d');
                        ?>
                            <a href="<?php the_permalink(); ?>" class="project-card">
                                <?php if ($is_pickup) : ?>
                                <!-- PICK UPバッジ -->
                                <div class="pick-up-badge">
                                    <span>PICK UP</span>
                                </div>
                                <?php endif; ?>
                                <div class="project-image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/comingsoon_localproject.png" alt="<?php the_title_attribute(); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="project-info">
                                    <div class="project-date"><?php echo esc_html($date_range); ?></div>
                                    <h4 class="project-title title-underline"><?php the_title(); ?></h4>
                                    <div class="project-tags">
                                        <?php
                                        // プロジェクトカテゴリーを取得
                                        $terms = get_the_terms(get_the_ID(), 'project_category');
                                        if ($terms && !is_wp_error($terms)) {
                                            foreach ($terms as $term) {
                                                echo '<span class="tag">' . esc_html($term->name) . '</span>';
                                            }
                                        }
                                        
                                        // タグも取得
                                        $tags = get_the_tags();
                                        if ($tags) {
                                            foreach ($tags as $tag) {
                                                echo '<span class="tag">' . esc_html($tag->name) . '</span>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </a>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <?php get_template_part( 'pagination' ) ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>

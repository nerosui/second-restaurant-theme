<?php

/**
 * Front Page Template
 */
if (!defined('ABSPATH')) exit; ?>
<?php get_header(); ?>

<main id="index-page">
    <!-- トップヒーローセクション -->
    <section class="hero">
        <div class="hero-image">
            <div class="swiper hero-swiper">
                <div class="swiper-wrapper">
                    <?php
                    $hero_images = get_sr_hero_images();
                    foreach ($hero_images as $image_data) :
                    ?>
                        <div class="swiper-slide">
                            <img
                                src="<?php echo esc_url($image_data['url']); ?>"
                                alt="<?php echo esc_attr($image_data['alt']); ?>"
                                class="hero-bg" />
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="hero-content">
            <h1 class="hero-title">
                地域にもっと、美味しい時間を。<br />
                シェフにもっと、自由な挑戦を。
            </h1>
            <p class="hero-subtitle">
                料理人が旅した先で、その土地だけの「美味しい時間」をつくる。<br />
                料理人と地域が近づけば、食はもっとおもしろくなる。
            </p>
        </div>

        <div class="hero-button">
            <?php
            // 今日の日付を取得
            $today = date('Y-m-d');

            // PICK UPのプロジェクトで開催日が今日に一番近いものを取得
            $pickup_project = new WP_Query(array(
                'post_type' => 'project',
                'posts_per_page' => 1,
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key' => 'is_pickup',
                        'value' => '1',
                        'compare' => '='
                    )
                ),
                'meta_key' => 'start_date',
                'orderby' => 'meta_value',
                'order' => 'ASC',
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'is_pickup',
                        'value' => '1',
                        'compare' => '='
                    ),
                    array(
                        'key' => 'start_date',
                        'value' => $today,
                        'compare' => '>=',
                        'type' => 'DATE'
                    )
                )
            ));

            if ($pickup_project->have_posts()) :
                while ($pickup_project->have_posts()) : $pickup_project->the_post();
                    $start_date = get_post_meta(get_the_ID(), 'start_date', true);
                    $end_date = get_post_meta(get_the_ID(), 'end_date', true);
                    
                    $formatted_start = $start_date ? date('Y/m/d', strtotime($start_date)) : '';
                    $formatted_end = $end_date ? date('Y/m/d', strtotime($end_date)) : '';
                    $date_range = $formatted_start && $formatted_end ? $formatted_start . ' - ' . $formatted_end : '';
            ?>
                    <a href="<?php the_permalink(); ?>" class="link-banner">
                        <div class="link-banner-badge">
                            <span class="badge-text">PICK UP!</span>
                        </div>
                        <div class="link-banner-content">
                            <div class="link-banner-date"><?php echo esc_html($date_range); ?></div>
                            <div class="link-banner-title"><?php the_title(); ?></div>
                        </div>
                    </a>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>

    <!-- ABOUTセクション -->
    <section class="about" id="about">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">ABOUT</h2>
                <span class="section-dot"></span>
            </div>
            <div class="about-content">
                <h3 class="about-subtitle">
                    Second Restaurantは、「地域」と「シェフ」をつなぎ<br />
                    "多拠点レストラン"という新たな文化を創出するプロジェクトです
                </h3>
                <div class="about-text">
                    <p>
                        暮らす場所や働き方がかつてないほど自由になった今、都市と地方の差は以前にも増して小さくなりました。<br />
                        しかし「飲食店」という視点で見れば、店舗も人材も、そして料理人としてのキャリアもまた、都市部に集中しているのが現状です。<br />
                        けれど本来、シェフにこそ食材の産地である地域で学び、挑戦できる機会がもっと必要なはず。<br />
                        地域とシェフの距離が近づけば、地域にもっと豊かな食体験が生まれるのではないでしょうか。
                    </p>
                    <p>
                        Second
                        Restaurantは、都市部で活躍するシェフが、地域に滞在し期間限定のレストランを構える"多拠点レストラン"という新しい飲食店のあり方を提案します。
                    </p>
                </div>
            </div>
            <div class="about-illust">
                <!-- イラストのプレースホルダー -->
            </div>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>" class="section-button">LEARN MORE</a>
        </div>
    </section>

    <!-- LOCAL PARTNERセクション -->
    <section class="local-partner">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">LOCAL PARTNER</h2>
                <span class="section-dot"></span>
            </div>
            <h3 class="section-subtitle">
                Second Restaurantに参画している地域パートナー
            </h3>

            <div class="partner-grid">
                <!-- Swiper -->
                <div class="swiper partner-swiper">
                    <div class="swiper-wrapper">
                        <?php
                        $local_partners = new WP_Query(array(
                            'post_type' => 'local_partner',
                            'posts_per_page' => 5,
                            'post_status' => 'publish'
                        ));

                        if ($local_partners->have_posts()) :
                            while ($local_partners->have_posts()) : $local_partners->the_post();
                                $location = get_post_meta(get_the_ID(), 'location', true);
                                $terms = get_the_terms(get_the_ID(), 'partner_category');
                                $term_names = array();
                                if ($terms && !is_wp_error($terms)) {
                                    foreach ($terms as $term) {
                                        $term_names[] = '#' . $term->name;
                                    }
                                }
                        ?>
                                <div class="swiper-slide">
                                    <a href="<?php the_permalink(); ?>" class="partner-link">
                                        <div class="partner-card">
                                            <div class="partner-image">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                                                <?php else : ?>
                                                    <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/restaurant.png" alt="<?php the_title_attribute(); ?>">
                                                <?php endif; ?>
                                            </div>
                                            <div class="partner-info">
                                                <div class="partner-location"><?php echo esc_html($location ?: '地域未設定'); ?></div>
                                                <h4 class="partner-name title-underline"><?php the_title(); ?></h4>
                                                <p class="partner-tags"><?php echo esc_html(implode('　', $term_names)); ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        endif; ?>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Navigation -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>

            <a href="<?php echo get_post_type_archive_link('local_partner'); ?>" class="section-button">VIEW LIST</a>
        </div>
    </section>

    <!-- TRAVELING CHEFセクション -->
    <section class="chef">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">TRAVELING CHEF</h2>
                <span class="section-dot"></span>
            </div>
            <h3 class="section-subtitle">
                Second Restaurantに参画している旅するシェフたち
            </h3>

            <div class="chef-grid">
                <?php
                $chefs = new WP_Query(array(
                    'post_type' => 'chef',
                    'posts_per_page' => 6,
                    'post_status' => 'publish'
                ));

                if ($chefs->have_posts()) :
                    while ($chefs->have_posts()) : $chefs->the_post();
                        $position = get_post_meta(get_the_ID(), 'position', true);
                ?>
                    <a href="<?php the_permalink(); ?>" class="chef-card">
                        <div class="chef-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/comingsoon_chef.png" alt="<?php the_title_attribute(); ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="chef-info">
                            <h4 class="chef-name"><?php the_title(); ?></h4>
                            <p class="chef-position"><?php echo esc_html($position ?: '料理人'); ?></p>
                        </div>
                    </a>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif; ?>
            </div>
            <a href="<?php echo get_post_type_archive_link('chef'); ?>" class="section-button">VIEW LIST</a>
        </div>
    </section>

    <!-- PROJECTセクション -->
    <section class="project">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">PROJECT</h2>
                <span class="section-dot"></span>
            </div>
            <h3 class="section-subtitle">Second Restaurantの開催事例</h3>

            <div class="project-grid">
                <?php
                $projects = new WP_Query(array(
                    'post_type' => 'project',
                    'posts_per_page' => 3,
                    'post_status' => 'publish'
                ));
                if ($projects->have_posts()) :
                    while ($projects->have_posts()) : $projects->the_post();
                        $start_date = get_post_meta(get_the_ID(), 'start_date', true);
                        $end_date = get_post_meta(get_the_ID(), 'end_date', true);
                        $is_pickup = get_post_meta(get_the_ID(), 'is_pickup', true);

                        // 日付のフォーマット
                        $formatted_start = $start_date ? date('Y/m/d', strtotime($start_date)) : '';
                        $formatted_end = $end_date ? date('Y/m/d', strtotime($end_date)) : '';
                        $date_range = $formatted_start && $formatted_end ? $formatted_start . ' - ' . $formatted_end : get_the_date('Y/m/d');
                ?>
                        <div>
                            <a href="<?php the_permalink(); ?>" class="project-card">
                                <!-- PICK UPバッジ -->
                                <?php if ($is_pickup) : ?>
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
                                        $tags = get_the_terms( get_the_ID(), 'project_category' );
                                        if ( !empty( $tags ) ) {
                                            foreach ( $tags as $tag ) {
                                                echo '<span class="tag">' . esc_html($tag->name) . '</span>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif; ?>
            </div>
            <a href="<?php echo get_post_type_archive_link('project'); ?>" class="section-button">VIEW LIST</a>
        </div>
    </section>

    <!-- NEWSセクション -->
    <section class="news">
        <div class="container flex">
            <div class="section-header">
                <h2 class="section-title">NEWS</h2>
                <span class="section-dot"></span>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('news-list'))); ?>" class="section-button hiddenSP">VIEW LIST</a>
            </div>

            <div class="news-content">
                <div class="news-list">
                    <?php
                    $news = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'post_status' => 'publish'
                    ));

                    if ($news->have_posts()) :
                        while ($news->have_posts()) : $news->the_post();
                            $categories = get_the_category();
                            $category_name = $categories ? $categories[0]->name : 'ニュースリリース';
                    ?>
                            <a href="<?php the_permalink(); ?>" class="news-item">
                                <span class="news-date"><?php echo get_the_date('Y/m/d'); ?></span>
                                <span class="news-category"><?php echo esc_html($category_name); ?></span>
                                <h4 class="news-title"><?php the_title(); ?></h4>
                            </a>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    endif; ?>
                </div>

                <a href="<?php echo get_post_type_archive_link('post'); ?>" class="section-button hiddenPC">VIEW LIST</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
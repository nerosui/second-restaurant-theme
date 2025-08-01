<?php
/**
 * Template for displaying the chef category archive page.
 */

get_header(); ?>

<main id="chef-page" class="main-content simple-page">

    <section class="chef-intro">
        <div class="container">
            <h2 class="page-section-title">旅するシェフ</h2>
            <p class="section-description">
                セカンドレストランプロジェクトに参画している"旅するシェフたち"をご紹介します。これからはもっと自由に、好きな場所で料理をしてもいいじゃないか。地域での新たな出会いによってより広がっていく料理人としての可能性にご注目ください！
            </p>
        </div>
    </section>

    <!-- CTA Banner -->
    <section class="sr-cta-banner">
        <a href="<?php echo home_url('/join'); ?>">
            <div class="sr-cta-content">
                <div class="sr-cta-image">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/html_template/images/join-traveling-chef.jpg" alt="Join Traveling Chef">
                </div>
                <div class="sr-cta-text">
                    <h3 class="sr-cta-title">旅するシェフ募集！</h3>
                    <p class="sr-cta-subtitle">私たちと一緒に多拠点レストラン文化を育てませんか</p>
                    <div class="sr-cta-button">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/html_template/images/arrow-button.svg" alt="Arrow">
                    </div>
                </div>
            </div>
        </a>
    </section>

    <section class="chef-list">
        <div class="container">
            <div class="filter-bar">
                <div class="filter-title">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/html_template/images/search-icon.svg" alt="Search" />
                    <span>絞り込む</span>
                </div>
                <div class="filter-tags">
                    <a href="<?php echo get_post_type_archive_link('chef'); ?>" class="tag">#すべて</a>
                    <?php
                    // シェフカテゴリータグを動的に表示
                    $chef_categories = get_terms(array(
                        'taxonomy' => 'chef_category',
                        'hide_empty' => true,
                    ));
                    
                    $current_term = get_queried_object();
                    
                    if (!is_wp_error($chef_categories) && !empty($chef_categories)) {
                        foreach ($chef_categories as $category) {
                            $category_link = get_term_link($category);
                            $active_class = ($current_term && $current_term->term_id == $category->term_id) ? ' active' : '';
                            echo '<a href="' . esc_url($category_link) . '" class="tag' . $active_class . '">#' . esc_html($category->name) . '</a>';
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="chef-grid">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        ?>
                        <div class="chef-card">
                            <a href="<?php the_permalink(); ?>">
                                <div class="chef-image">
                                    <?php 
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('medium', array('alt' => get_the_title()));
                                    } else {
                                        // デフォルト画像を表示
                                        echo '<img src="' . get_stylesheet_directory_uri() . '/html_template/images/chef-profile.jpg" alt="' . get_the_title() . '">';
                                    }
                                    ?>
                                </div>
                                <div class="chef-info">
                                    <h3 class="chef-name"><?php the_title(); ?></h3>
                                    <p class="chef-title">
                                        <?php 
                                        $chef_title = get_post_meta(get_the_ID(), 'chef_title', true);
                                        echo $chef_title ? esc_html($chef_title) : '料理人';
                                        ?>
                                    </p>
                                </div>
                            </a>
                        </div>
                        <?php
                    endwhile;
                else :
                    ?>
                    <div class="no-posts">
                        <p>現在、このカテゴリーに登録されているシェフはいません。</p>
                    </div>
                    <?php
                endif;
                ?>
            </div>
            <?php get_template_part('pagination'); ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>

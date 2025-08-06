<?php get_header(); ?>

<main id="local-partner-detail-page">
    <?php while (have_posts()) : the_post(); ?>

        <!-- 地域パートナー記事 -->
        <article class="local-partner-article">
            <div class="article-container">

                <!-- ヘッダー情報 -->
                <header class="partner-header">
                    <h2 class="partner-name"><?php the_title(); ?></h2>
                    <div class="partner-location">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/pin.svg" alt="" class="location-icon">
                        <span class="location-text">
                            <?php echo esc_html(get_post_meta(get_the_ID(), 'location', true) ?: '地域未設定'); ?>
                        </span>
                    </div>
                    <div class="partner-tags">
                        <?php
                        $terms = get_the_terms(get_the_ID(), 'partner_category');
                        if ($terms && !is_wp_error($terms)) {
                            $term_names = array();
                            foreach ($terms as $term) {
                                $term_names[] = '#' . $term->name;
                            }
                            echo esc_html(implode('　', $term_names));
                        }
                        ?>
                    </div>
                </header>
                <div class="partner-content">
                    <?php the_content(); ?>
                </div>
            </div>

            <!-- Back to List ボタン -->
            <a href="<?php echo get_post_type_archive_link('local_partner'); ?>" class="section-button">BACK TO LIST</a>
        </article>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
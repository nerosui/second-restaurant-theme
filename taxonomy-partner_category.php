<?php get_header(); ?>

<?php
$current_term = get_queried_object();
?>

<main id="local-partner-page" class="main-content">
    <section class="local-partner-intro">
        <div class="container">
            <h2 class="page-section-title">地域パートナー - <?php echo esc_html($current_term->name); ?></h2>
            <?php if ($current_term->description) : ?>
                <p class="section-description">
                    <?php echo wp_kses_post($current_term->description); ?>
                </p>
            <?php else : ?>
                <p class="section-description">
                    「<?php echo esc_html($current_term->name); ?>」カテゴリの地域パートナーをご紹介します。その地域だからこそ生まれる唯一無二の「美味しい時間」によって、地域の新たな魅力を育てます。
                </p>
            <?php endif; ?>
        </div>
    </section>

    <section class="sr-cta-banner">
        <div class="sr-cta-content">
            <div class="sr-cta-image">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/joinbanner_local.jpg" alt="Join Local Partner">
            </div>
            <div class="sr-cta-text">
                <h3 class="sr-cta-title">地域パートナー募集！</h3>
                <p class="sr-cta-subtitle">私たちと一緒に多拠点レストラン文化を育てませんか</p>
                <div class="sr-cta-button">
                    <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/arrow-button.svg" alt="Arrow">
                </div>
            </div>
        </div>
    </section>

    <section class="local-partner-list">
        <div class="container">
            <div class="filter-bar">
                <div class="filter-title">
                    <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/search-icon.svg" alt="Search" />
                    <span>絞り込む</span>
                </div>
                <div class="filter-tags">
                    <a href="<?php echo get_post_type_archive_link('local_partner'); ?>" class="tag">#すべて</a>
                    <?php
                    $terms = get_terms(array(
                        'taxonomy' => 'partner_category',
                        'hide_empty' => true,
                    ));
                    if (!empty($terms) && !is_wp_error($terms)) :
                        foreach ($terms as $term) :
                            $active_class = ($term->term_id === $current_term->term_id) ? 'active' : '';
                    ?>
                    <a href="<?php echo get_term_link($term); ?>" class="tag <?php echo $active_class; ?>">#<?php echo esc_html($term->name); ?></a>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>

            <div class="partner-grid">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="partner-card">
                            <div class="partner-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/comingsoon_localproject.png" alt="<?php the_title(); ?>">
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="partner-info">
                                <span class="partner-location">
                                    <?php echo esc_html(get_post_meta(get_the_ID(), 'location', true) ?: '地域未設定'); ?>
                                </span>
                                <h3 class="partner-name">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <p class="partner-tags">
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
                                </p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="no-posts">
                        <p>現在、「<?php echo esc_html($current_term->name); ?>」カテゴリの地域パートナーの情報がありません。</p>
                    </div>
                <?php endif; ?>
            </div>
            <?php get_template_part('pagination'); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>

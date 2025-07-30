<?php

/**
 * Single Project Page Template
 */
if (!defined('ABSPATH')) exit; ?>
<?php get_header(); ?>

<main id="project-detail-page" class="main-content simple-page">
    <?php while (have_posts()) : the_post(); ?>

    <!-- プロジェクト記事 -->
    <article class="project-article bg-list">
        <div class="article-container">
            <!-- プロジェクトタイトル -->
            <header class="project-header">
                <h2 class="project-title"><?php the_title(); ?></h2>
            </header>

            <!-- プロジェクトコンテンツ -->
            <div class="project-content">
                <?php the_content(); ?>
            </div>
        </div>

        <!-- Back to List ボタン -->
        <a href="<?php echo get_post_type_archive_link('project'); ?>" class="section-button">BACK TO LIST</a>
    </article>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>

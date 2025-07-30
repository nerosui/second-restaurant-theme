<?php

/**
 * Template for displaying single chef posts
 */
get_header(); ?>

<main id="chef-detail-page">
    <!-- シェフ記事 -->
    <article class="chef-article">
        <div class="article-container">
            <?php
            while (have_posts()) :
                the_post();

                // ブロックエディタのコンテンツを表示
                the_content();

            endwhile;
            ?>
        </div>

        <!-- Back to List ボタン -->
        <a href="<?php echo get_post_type_archive_link('chef'); ?>" class="section-button">BACK TO LIST</a>
    </article>

</main>

<?php get_footer(); ?>
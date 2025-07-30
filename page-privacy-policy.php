<?php

/**
 * Privacy Policy Page Template
 */
if (!defined('ABSPATH')) exit; ?>
<?php get_header(); ?>

<main id="privacy-policy-page">

    <!-- プライバシーポリシー内容 -->
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    endif;
    ?>

</main>

<?php get_footer(); ?>

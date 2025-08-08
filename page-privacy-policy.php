<?php

/**
 * Privacy Policy Page Template
 */
if (!defined('ABSPATH')) exit; ?>
<?php get_header(); ?>

<div id="privacy-policy-page" class="simple-page main-content">
    <!-- プライバシーポリシー内容 -->
    <section class="privacy-policy-content">	 
        <div class="container">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
            endif;
            ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>

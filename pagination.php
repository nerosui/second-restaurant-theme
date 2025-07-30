
<?php if (have_posts()) : ?>

    <div class="sr-pagination">
        <?php
        // WordPressの標準ページネーション
        // global $wp_query;
        
        $big = 999999999; // 大きな数値が必要

        $query_args = array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'prev_text' => '<',
            'next_text' => '>',
            'type' => 'array'
        );

        if( isset($args) && isset($args['total_page']) ) {
            $query_args['total'] = $args['total_page'];
        }


        $pagination_links = paginate_links($query_args);
        
        if ($pagination_links) {
            foreach ($pagination_links as $link) {
                if (strpos($link, 'current') !== false) {
                    echo '<span class="page-number current">' . strip_tags($link) . '</span>';
                } elseif (strpos($link, 'prev') !== false || strpos($link, 'next') !== false) {
                    echo str_replace('page-numbers', 'page-number', $link);
                } else {
                    echo str_replace('page-numbers', 'page-number', $link);
                }
            }
        }
        ?>
    </div>
<?php endif; ?>
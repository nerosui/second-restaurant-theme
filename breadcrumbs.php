<?php

if(is_page('news-list')) {
    $root_text = __('ホーム', THEME_NAME);
    $root_text = apply_filters('breadcrumbs_single_root_text', $root_text);
    echo '<div id="breadcrumb" class="breadcrumb breadcrumb-category' . get_additional_single_breadcrumbs_classes() . '" itemscope itemtype="https://schema.org/BreadcrumbList">';
    echo '<div class="breadcrumb-home" itemscope itemtype="https://schema.org/ListItem" itemprop="itemListElement"><a href="' . esc_url(get_home_url()) . '" itemprop="item"><span itemprop="name" class="breadcrumb-caption">' . esc_html($root_text) . '</span></a><meta itemprop="position" content="1" /><span class="sp"><span class="fa fa-angle-right" aria-hidden="true"></span></span></div><div class="breadcrumb-item" itemscope itemtype="https://schema.org/ListItem" itemprop="itemListElement">NEWS</div></div><!-- /#breadcrumb -->';
}


if ((get_post_type() === 'chef' || get_post_type() === 'project' || get_post_type() === 'local_partner' || get_post_type() === 'post')) {
    $echo = null;
    $root_text = __('ホーム', THEME_NAME);
    $root_text = apply_filters('breadcrumbs_single_root_text', $root_text);
    echo '<div id="breadcrumb" class="breadcrumb breadcrumb-category' . get_additional_single_breadcrumbs_classes() . '" itemscope itemtype="https://schema.org/BreadcrumbList">';
    echo '<div class="breadcrumb-home" itemscope itemtype="https://schema.org/ListItem" itemprop="itemListElement"><a href="' . esc_url(get_home_url()) . '" itemprop="item"><span itemprop="name" class="breadcrumb-caption">' . esc_html($root_text) . '</span></a><meta itemprop="position" content="1" /><span class="sp"><span class="fa fa-angle-right" aria-hidden="true"></span></span></div>';

    $count = 2;
    $post_type = get_post_type();
    $post_type_object = get_post_type_object($post_type);
    
    // 投稿タイプ別のアーカイブリンク名を設定
    $archive_name = $post_type_object->labels->name;
    if ($post_type === 'post') {
        $archive_name = 'ニュース';
        $archive_link = get_permalink( get_page_by_path( 'news-list' ) ) ?: home_url('/news-list/');
    } else {
        $archive_link = get_post_type_archive_link($post_type);
    }

    // カスタム投稿タイプのアーカイブページリンク
    echo '<div class="breadcrumb-item" itemscope itemtype="https://schema.org/ListItem" itemprop="itemListElement"><a href="' . esc_url($archive_link) . '" itemprop="item"><span itemprop="name" class="breadcrumb-caption">' . esc_html($archive_name) . '</span></a><meta itemprop="position" content="' . $count . '" />';

    //ページタイトルを含める場合はセパレーターを表示
    if (is_single_breadcrumbs_include_post() && is_singular()) {
        echo '<span class="sp"><span class="fa fa-angle-right" aria-hidden="true"></span></span>';
    }
    echo '</div>';

    //ページタイトルを含める場合
    if (is_single_breadcrumbs_include_post() && is_singular()) {
        echo '<div class="breadcrumb-item"><span class="breadcrumb-caption">' . esc_html(get_the_title()) . '</span></div>';
    }

    // カスタムタクソノミーのアーカイブページリンク
    if (is_tax() || is_category() || is_tag()) {
        $current_term = get_queried_object();
        $taxonomy = get_taxonomy($current_term->taxonomy);
        $taxonomy_name = $taxonomy->labels->name;
        $taxonomy_archive_link = get_term_link($current_term);
        echo '<span class="sp"><span class="fa fa-angle-right" aria-hidden="true"></span></span><div class="breadcrumb-item" itemscope itemtype="https://schema.org/ListItem" itemprop="itemListElement"><span itemprop="name" class="breadcrumb-caption">' . esc_html($current_term->name) . '</span><meta itemprop="position" content="' . ($count + 1) . '" /></div>';
    }

    echo '</div><!-- /#breadcrumb -->';
}

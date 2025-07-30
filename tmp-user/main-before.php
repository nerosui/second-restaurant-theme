
<!-- それぞれのページのpage-titleをこちらに集約する -->
 <!-- 固定ページはスラッグからタイトルを判定する -->
<?php
if(is_front_page()){
    return; // フロントページは除外
}
$post_type = get_post_type();
if ($post_type === 'local_partner') {
    $page_title = 'LOCAL PARTNER';
} elseif ($post_type === 'project') {
    $page_title = 'PROJECT';
} elseif ($post_type === 'chef') {
    $page_title = 'TRAVELING CHEF';
} elseif ($post_type === 'post') {
    $page_title = 'NEWS';
} elseif ($post_type === 'page') {
    $post = get_post();
    // 固定ページのスラッグに応じてタイトルを設定
    // 例: about, contact, news-list など
    // スラッグを取得
    $page_slug = $post->post_name;
    switch ($page_slug) {
        case 'about':
            return; // Aboutページは除外
        case 'join':
            return;
        case 'contact':
            $page_title = 'CONTACT';
            break;
        case 'news-list':
            $page_title = 'NEWS';
            break;
        default:
            $page_title = get_the_title();
    }
} elseif (is_archive()) {
    $page_title = get_the_archive_title();
} elseif (is_search()) {
    $page_title = 'SEARCH RESULTS';
} elseif (is_404()) {
    $page_title = 'PAGE NOT FOUND';
} else {
    $page_title = 'UNKNOWN';
}
?>

<div class="page-hero-simple">
    <div class="page-hero-content">
        <h1 class="page-title"><?php echo strtoupper($page_title); ?></h1>
        <div class="page-subtitle-dot"></div>
    </div>
</div>

<!-- パンくずリスト -->
<div class="breadcrumbs-container">
    <?php get_template_part('breadcrumbs'); ?>
</div>
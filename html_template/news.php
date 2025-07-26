<?php require 'header.php'; ?>

<main id="news-page">
    <!-- ページタイトル -->
    <div class="page-hero-simple">
        <div class="page-hero-content">
            <h1 class="page-title">NEWS</h1>
            <div class="page-subtitle-dot"></div>
        </div>
    </div>

    <!-- パンくずリスト -->
    <div class="breadcrumbs">
        <a href="/" class="breadcrumb-link">HOME</a>
        <span class="breadcrumb-arrow">></span>
        <span class="breadcrumb-current">NEWS</span>
    </div>

    <!-- ニュース一覧 -->
    <section class="news-list">

        <div class="container">
            <div class="filter-bar">
                <div class="filter-tags">
                    <a href="#" class="active">
                        すべて</a>
                    <a href="#">
                        ニュースリリース</a>
                    <a href="#">
                        メディア掲載</a>
                    <a href="#">
                        その他</a>
                </div>
            </div>
            <div class="news-container">
                <!-- ニュース記事1 -->
                <?php for ($i = 0; $i < 10; $i++): ?>
                    <a href="/news-detail.php" class="">

                        <article class="news-item">
                            <div class="news-content">
                                <div class="news-info">
                                    <time class="news-date">2025/00/00</time>
                                    <span class="news-category">ニュースリリース</span>
                                </div>
                                <h3 class="news-title">ダミーのお知らせタイトルです。新たな地域拠点が参画しました。ダミーのお知らせタイトルです。</h3>
                            </div>
                            <div class="news-arrow">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.375 12.75L10.625 8.5L6.375 4.25" stroke="#E65D3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </article>
                    </a>
                <?php endfor; ?>

            </div>
    </section>

    <!-- ページネーション -->
    <div class="pagination">
        <div class="pagination-container">
            <div class="pagination-pages">
                <span class="page-number active">1</span>
                <span class="page-number">2</span>
            </div>
            <div class="pagination-next">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.5 9L7.5 6L4.5 3" stroke="#303030" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>
    </div>
</main>

<?php require 'footer.php'; ?>
<?php require 'header.php'; ?>

<main id="chef-detail-page">
    <!-- ページタイトル -->
    <div class="page-hero-simple">
        <div class="page-hero-content">
            <h1 class="page-title">TRAVELING CHEF</h1>
            <div class="page-subtitle-dot"></div>
        </div>
    </div>

    <!-- パンくずリスト -->
    <div class="breadcrumbs">
        <a href="/" class="breadcrumb-link">HOME</a>
        <span class="breadcrumb-arrow">></span>
        <span>LOCAL PARTNER</span>
        <span class="breadcrumb-arrow">></span>
        <span class="breadcrumb-current">pageID</span>
    </div>

    <!-- シェフ記事 -->
    <article class="chef-article">
        <div class="article-container">
            <!-- シェフプロフィール -->
            <section class="chef-profile-section">
                <div class="chef-profile-content">
                    <div class="chef-profile-image">
                        <img src="images/chef-profile.jpg" alt="シェフプロフィール">
                    </div>
                    <div class="chef-profile-info">
                        <h2 class="chef-name">料理人 名前</h2>
                        <p class="chef-title">ダミー肩書き AAAレストランオーナーシェフ</p>
                        <div class="chef-tags">
                            #キーワードタグ０１　#キーワードタグ０２　#キーワードタグ０３　#キーワードタグジャンルなど
                        </div>

                        <div class="chef-description">
                            <p>
                                ダミーのシェフプロフィールテキストです。ここに各シェフの経歴を入れます。例えば以下のような内容です。<br><br>
                                0000年 SAMPLE県生まれ。OOO学校を卒業後、都内のレストランで研鑽を積み、0000年より渡仏。パリの星付きレストランをはじめ、著名なレストランで腕を磨く。0000年00月帰国と同時に独立し、東京都OO区に AAAレストランをオープン。オーナーシェフとして活躍する傍ら、0000年からはOO調理師学校で教鞭をとり、後進の育成にも尽力している。<br><br>
                                ダミーのシェフプロフィールテキストです。
                            </p>
                        </div>

                        <div class="chef-links">
                            <div class="link-item">
                                <span class="link-label">WEB</span>
                                <span class="link-url">www.sample-restaurant.com</span>
                            </div>
                            <div class="link-item">
                                <span class="link-label">SNS</span>
                                <span class="link-url">@sample-restaurant</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 過去に担当したセカンドレストラン -->
            <section class="past-restaurants-section">
                <h3 class="section-title">過去に担当したセカンドレストラン</h3>

                <div class="example-cards">
                    <div class="example-card">
                        <div class="example-image"></div>
                        <div class="example-content">
                            <h3 class="example-title">プロジェクト名称ダミー</h3>
                            <p class="example-description">
                                掲載テキストの冒頭部分がここに表示されます。掲載テキストの冒頭部分がここに表示されます。掲載テキストの冒頭部分がここに表示されます。
                            </p>
                            <p class="example-url">second-restaurant.jp/project</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Back to List ボタン -->
        <button class="section-button">BACK TO LIST</button>
    </article>

</main>

<?php require 'footer.php'; ?>
<?php

/**
 * Join Page Template
 */
if (!defined('ABSPATH')) exit; ?>
<?php get_header(); ?>

<main id="join-page">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-container">
            <picture class="hero-background">
                <source media="(max-width: 768px)" srcset="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/join-hero-bg-sp.png">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/join-hero-bg-pc.png" alt="">
            </picture>
            <div class="hero-content">
                <h1 class="hero-title">JOIN US</h1>
                <h2 class="hero-subtitle">私たちと一緒に多拠点レストラン文化を育てませんか</h2>
                <p class="hero-description">
                    セカンドレストランプロジェクトでは、地域でのプロジェクトオーナーである「地域パートナー」、地域に行ってポップアップレストラン営業を行う「旅するシェフ」を募集しています。
                </p>
            </div>
        </div>
    </section>

    <!-- What You Can Do Section -->
    <section class="join-benefits">
        <div class="container">
            <h2 class="section-title">セカンドレストランへの参画でできること</h2>

            <div class="benefits-content">
                <div class="benefit-item">
                    <div class="benefit-image benefit-image-local">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/join_local-partner.jpg" alt="Local Partner Icon" width="240" height="240">
                    </div>
                    <div class="benefit-text">
                        <div class="benefit-tag">地域</div>
                        <h3 class="benefit-subtitle">あなたのまちでしか味わえない「美味しい時間」で地域の新たな魅力を育てる</h3>
                        <ul class="benefit-list">
                            <li>物件の活用</li>
                            <li>地域食材や生産者の発掘</li>
                            <li>外部の料理人との関わりによる関係人口の増加</li>
                            <li>都市部から味やサービスが来ることによって、地域内に新たな食の楽しみができる</li>
                        </ul>
                    </div>
                </div>

                <div class="benefit-item">
                    <div class="benefit-image benefit-image-chef">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/join_traveling-chef.jpg" alt="Traveling Chef Icon" width="240" height="240">
                    </div>
                    <div class="benefit-text benefit-chef-text">
                        <div class="benefit-tag">料理人</div>
                        <h3 class="benefit-subtitle">もっと自由な挑戦をし、地域での新たな出会いが可能性で広げる</h3>
                        <ul class="benefit-list">
                            <li>シェアハウスのような感覚で、コストを抑えて地方のレストラン拠点での営業が可能に</li>
                            <li>生産現場に近い場所で地域の人と連携し、新たな食材や風土に出会う</li>
                            <li>地域での新たなファン作り、プロモーション</li>
                            <li>若手や独立を目指すシェフのトライアルの機会創出</li>
                            <li>無店舗料理人や海外を拠点にする料理人のスペシャルな営業の場として</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Roles Section -->
    <section class="join-roles">
        <div class="container">
            <h2 class="section-title">求める役割とマインド</h2>
            <p class="section-intro">セカンドレストランのビジョンに共感いただき、共に「美味しい時間」を創ってくださる方を募集しています</p>

            <div class="roles-content">
                <div class="role-item">
                    <div class="role-badge">
                        <div class="role-texts">
                            <span class="role-en">LOCAL PARTNER</span>
                            <span class="role-jp">地域パートナー</span>
                        </div>
                        <div class="role-icon role-icon-local">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/join_local-partner-icon.svg" alt="Local Partner Icon" width="85" height="90">
                        </div>
                    </div>
                    <div class="role-description">
                        <h3 class="role-title">プロジェクトオーナーとして地域でセカンドレストランを開催する</h3>
                        <ul class="role-list">
                            <li>レストラン拠点物件の所有、改修、設備保守</li>
                            <li>生産者をはじめとした地域コミュニティとシェフの繋ぎ役</li>
                            <li>シェフのレストラン運営および滞在サポート</li>
                            <li>告知集客</li>
                            <li>単にイベント的にシェフを招くという意識ではなく、プロジェクトの責任者としてシェフがしっかり稼げるレストラン拠点の運営に尽力できること</li>
                        </ul>
                    </div>
                </div>

                <div class="role-item">
                    <div class="role-badge">
                        <div class="role-texts">
                            <span class="role-en">TRAVELING CHEF</span>
                            <span class="role-jp">旅するシェフ</span>
                        </div>
                        <div class="role-icon role-icon-chef">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/join_traveling-chef-icon.svg" alt="Traveling Chef Icon" width="57" height="70">
                        </div>
                    </div>
                    <div class="role-description">
                        <h3 class="role-title">地域に美味しい時間を作る</h3>
                        <ul class="role-list">
                            <li>年数回の地域への出店</li>
                            <li>生産者や地域コミュニティと連携し地域食材を活用</li>
                            <li>集客やPRへの積極的参加</li>
                            <li>「若手を修行させたい」「地域食材を使ったメニューを開発したい」など達成したい目的を明確に描いてプロジェクトに参画すること</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Application Flow Section -->
    <section class="join-flow">
        <div class="container">
            <h2 class="section-title">応募の流れ</h2>

            <div class="flow-notice">
                <p class="notice-text">応募の前に、セカンドレストラン公式LINEからチャットでお問い合わせが可能です。応募に関してご質問がある方はお友だち追加をしてご利用ください。</p>
                <a href="#" class="line-button">
                    <div class="line-icon">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/line-icon.svg" alt="LINE Icon" width="24" height="24">
                    </div>
                    <span>LINEで友だち追加する</span>
                </a>
            </div>
            
            <div class="flow-content">
                <div class="flow-step">
                    <div class="step-content">
                        <div class="step-title-wrapper">
                            <div class="step-icon step-icon-form">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/join_form-icon.svg" alt="Form Icon" width="24" height="44">
                            </div>
                            <h3 class="step-title">仮エントリー</h3>
                        </div>
                        <div class="step-description">
                            <p class="step-description-text">以下のフォームに必要事項を記入して送付します。</p>
                            <div class="step-buttons">
                                <?php $form_urls = get_sr_entry_form_urls(); ?>
                                <a href="<?php echo esc_url($form_urls['local_partner']); ?>" class="step-button" <?php echo $form_urls['local_partner'] !== '#' ? 'target="_blank" rel="noopener"' : ''; ?>>【地域パートナー】仮エントリーフォームはこちら</a>
                                <a href="<?php echo esc_url($form_urls['traveling_chef']); ?>" class="step-button" <?php echo $form_urls['traveling_chef'] !== '#' ? 'target="_blank" rel="noopener"' : ''; ?>>【旅するシェフ】仮エントリーフォームはこちら</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flow-step">
                    <div class="step-content">
                        <div class="step-title-wrapper">
                            <div class="step-icon step-icon-meeting">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/join_meeting-person-icon.svg" alt="Meeting Person Icon" width="40" height="36">
                            </div>
                            <h3 class="step-title">オンライン説明会&面談</h3>
                        </div>
                        <p class="step-description">オンラインでの説明会にご参加いただくほか、運営事務局と個別に面談を行い、プロジェクトの詳細をご確認いただきます。</p>
                    </div>
                </div>

                <div class="flow-step">
                    <div class="step-content">
                        <div class="step-title-wrapper">
                            <div class="step-icon step-icon-entry">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/join_entry-icon.svg" alt="Entry Icon" width="24" height="44">
                            </div>
                            <h3 class="step-title">本エントリー</h3>
                        </div>
                        <p class="step-description">事務局指定の方法で本エントリーを行います。</p>
                    </div>
                </div>

                <div class="flow-step">
                    <div class="step-content">
                        <div class="step-title-wrapper">
                            <div class="step-icon step-icon-review">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/join_review-icon-group.svg" alt="Review Icon" width="32" height="40">
                            </div>
                            <h3 class="step-title">運営事務局による審査</h3>
                        </div>
                        <p class="step-description">本エントリー内容をもとに事務局で審査を行います。</p>
                    </div>
                </div>

                <div class="flow-step">
                    <div class="step-content">
                        <div class="step-title-wrapper">
                            <div class="step-icon step-icon-confirm">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/join_check-icon.svg" alt="Check Icon" width="40" height="24">
                            </div>
                            <h3 class="step-title">登録確定</h3>
                        </div>
                        <p class="step-description">審査を通過後、契約をし今後の参画にむけて具体的なアクションに移ります。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

<?php

/**
 * Contact Page Template
 */
if (!defined('ABSPATH')) exit; ?>
<?php get_header(); ?>

<main id="contact-page">

    <!-- よくある質問 -->
    <section class="faq-section">
        <div class="container">
            <h2 class="page-section-title">よくある質問</h2>
            <p class="faq-intro">お問い合わせの前に、当プロジェクトに寄せられる質問をご参照ください。</p>

            <div class="faq-list">
                <div class="faq-item">
                    <input type="checkbox" id="faq1" class="faq-toggle">
                    <label for="faq1" class="faq-question">
                        <span class="faq-q">Q</span>
                        <span class="faq-question-text">レストランはいつ営業していますか？</span>
                    </label>
                    <div class="faq-answer">
                        <p>Second Restaurantのプロジェクトとして行われるレストラン営業は、期間限定のポップアップレストランとして通常１ヶ月単位で行います。営業期間や担当シェフなどの最新情報は、PROJECTページでご確認ください。</p>
                    </div>
                </div>

                <div class="faq-item">
                    <input type="checkbox" id="faq2" class="faq-toggle">
                    <label for="faq2" class="faq-question">
                        <span class="faq-q">Q</span>
                        <span class="faq-question-text">食事の予約は必要ですか？</span>
                    </label>
                    <div class="faq-answer">
                        <p>予約制となっております。営業期間中は事前予約が必要ですので、お早めにご予約ください。</p>
                    </div>
                </div>

                <div class="faq-item">
                    <input type="checkbox" id="faq3" class="faq-toggle">
                    <label for="faq3" class="faq-question">
                        <span class="faq-q">Q</span>
                        <span class="faq-question-text">予約はどのように行えばいいですか？</span>
                    </label>
                    <div class="faq-answer">
                        <p>各プロジェクトページに記載されている予約方法に従ってお申し込みください。電話またはオンライン予約システムをご利用いただけます。</p>
                    </div>
                </div>

                <div class="faq-item">
                    <input type="checkbox" id="faq4" class="faq-toggle">
                    <label for="faq4" class="faq-question">
                        <span class="faq-q">Q</span>
                        <span class="faq-question-text">レストランの営業期間以外も地域拠点に訪問できますか？</span>
                    </label>
                    <div class="faq-answer">
                        <p>営業期間外でも地域拠点への見学は可能です。詳細については、各地域パートナーに直接お問い合わせください。</p>
                    </div>
                </div>

                <div class="faq-item">
                    <input type="checkbox" id="faq5" class="faq-toggle">
                    <label for="faq5" class="faq-question">
                        <span class="faq-q">Q</span>
                        <span class="faq-question-text">地域パートナー／シェフとして、プロジェクトへの参画を検討しています</span>
                    </label>
                    <div class="faq-answer">
                        <p>参画をご希望の方は、<a href="<?php echo esc_url(get_permalink(get_page_by_path('join'))); ?>">JOINページ</a>からお申し込みいただくか、こちらのお問い合わせフォームよりご連絡ください。詳細な条件や手続きについてご案内いたします。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- お問い合わせフォーム -->
    <section class="contact-form-section">
        <div class="container">
            <h2 class="page-section-title">お問い合わせフォーム</h2>
            <p class="form-intro">下記フォームに必要事項を入力のうえ、送信ボタンを押してください。後日担当者から返信いたします。</p>
            <div class="form-container">
                <?php
                    // 固定ページの内容を表示
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            the_content();
                        endwhile;
                    else :
                        echo '<p>お問い合わせ内容が見つかりません。</p>';
                    endif;
                 ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

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
                // Contact Form 7が有効な場合はそのフォームを表示
                if (function_exists('wpcf7_enqueue_scripts')) {
                    echo do_shortcode('[contact-form-7 id="1" title="お問い合わせフォーム"]');
                } else {
                    // Contact Form 7が無効な場合は標準のHTMLフォームを表示
                ?>
                <form class="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
                    <?php wp_nonce_field('contact_form_action', 'contact_form_nonce'); ?>
                    <input type="hidden" name="action" value="submit_contact_form">
                    
                    <div class="form-group">
                        <label class="form-label required">
                            氏名<span class="required-mark">*</span>
                        </label>
                        <input type="text" name="contact_name" class="form-input" placeholder="例）山田太郎" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">所属</label>
                        <input type="text" name="contact_organization" class="form-input" placeholder="会社名／団体名">
                    </div>

                    <div class="form-group">
                        <label class="form-label required">
                            メールアドレス<span class="required-mark">*</span>
                        </label>
                        <input type="email" name="contact_email" class="form-input" placeholder="例）mail@sample.com" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label required">
                            お問い合わせ種別<span class="required-mark">*</span>
                        </label>
                        <div class="select-wrapper">
                            <select name="contact_type" class="form-select" required>
                                <option value="">選択してください</option>
                                <option value="reservation">予約について</option>
                                <option value="partner">地域パートナーについて</option>
                                <option value="chef">旅するシェフについて</option>
                                <option value="other">その他</option>
                            </select>
                            <div class="select-arrow">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/dropdown-arrow.svg" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label required">
                            お問い合わせ内容<span class="required-mark">*</span>
                        </label>
                        <textarea name="contact_message" class="form-textarea" placeholder="メッセージを入力" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="privacy" name="privacy_agreement" class="form-checkbox" required>
                            <label for="privacy" class="checkbox-label">
                                <a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy-policy'))); ?>" target="_blank">プライバシーポリシー</a>に同意する
                            </label>
                        </div>
                    </div>

                    <div class="form-submit">
                        <button type="submit" class="submit-button">送信</button>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

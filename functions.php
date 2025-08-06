<?php //子テーマ用関数
if (!defined('ABSPATH')) exit;

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

//以下に子テーマ用の関数を書く

function enqueue_child_theme_styles()
{
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/html_template/style.css', array('cocoon-style'));
    wp_enqueue_script('child-script', get_stylesheet_directory_uri() . '/html_template/script.js', array('jquery'), '1.0.0', true);

    // Swiperのスタイルとスクリプトを読み込む
    wp_enqueue_style('swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script('swiper-script', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
    
    // GSAPを読み込む
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), null, true);
    
    // ローディングアニメーション用スクリプト
    wp_enqueue_script('loading-animation', get_stylesheet_directory_uri() . '/js/loading-animation.js', array('gsap', 'jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_child_theme_styles');

function sr_my_theme_setup() {
    // ブロックエディターをサポート
    add_theme_support( 'editor-styles' );
    // エディター用の CSS ファイルを読み込む
    add_editor_style( 'html_template/style.css' );
}
add_action( 'after_setup_theme', 'sr_my_theme_setup' );

// カスタマイザーでヒーロー画像を設定できるようにする
function sr_customize_register($wp_customize) {
    // ヒーロー画像セクションを追加
    $wp_customize->add_section('sr_hero_images', array(
        'title' => 'ヒーロー画像設定',
        'description' => 'トップページのヒーロー画像を最大5枚まで設定できます',
        'priority' => 30,
    ));

    // ヒーロー画像1-5の設定を追加
    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting("sr_hero_image_{$i}", array(
            'default' => '',
            'sanitize_callback' => 'absint',
        ));

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "sr_hero_image_{$i}", array(
            'label' => "ヒーロー画像 {$i}",
            'section' => 'sr_hero_images',
            'settings' => "sr_hero_image_{$i}",
            'mime_type' => 'image',
            'description' => $i === 1 ? '画像が設定されていない場合はデフォルト画像が表示されます' : '',
        )));
    }
}
add_action('customize_register', 'sr_customize_register');

// ヒーロー画像を取得する関数
function get_sr_hero_images() {
    $hero_images = array();
    $default_images = array(
        get_stylesheet_directory_uri() . '/images/keyvisual_01.jpg',
        get_stylesheet_directory_uri() . '/images/keyvisual_02.jpg',
    );

    // カスタマイザーで設定された画像を取得
    for ($i = 1; $i <= 5; $i++) {
        $image_id = get_theme_mod("sr_hero_image_{$i}");
        if ($image_id) {
            $image_url = wp_get_attachment_image_url($image_id, 'full');
            if ($image_url) {
                $hero_images[] = array(
                    'url' => $image_url,
                    'alt' => get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: "ヒーロー画像{$i}"
                );
            }
        }
    }

    // 設定された画像がない場合はデフォルト画像を使用
    if (empty($hero_images)) {
        foreach ($default_images as $index => $default_url) {
            $hero_images[] = array(
                'url' => $default_url,
                'alt' => "地域とシェフをつなぐメインビジュアル" . ($index > 0 ? ($index + 1) : '')
            );
        }
    }

    return $hero_images;
}

// デフォルト投稿タイプのラベルを「ニュース」に変更
function change_post_labels() {
    global $wp_post_types;
    
    if (isset($wp_post_types['post'])) {
        $wp_post_types['post']->labels->name = 'ニュース';
        $wp_post_types['post']->labels->singular_name = 'ニュース';
        $wp_post_types['post']->labels->menu_name = 'ニュース';
        $wp_post_types['post']->labels->name_admin_bar = 'ニュース';
        $wp_post_types['post']->labels->add_new = '新規追加';
        $wp_post_types['post']->labels->add_new_item = '新しいニュースを追加';
        $wp_post_types['post']->labels->edit_item = 'ニュースを編集';
        $wp_post_types['post']->labels->new_item = '新しいニュース';
        $wp_post_types['post']->labels->view_item = 'ニュースを表示';
        $wp_post_types['post']->labels->view_items = 'ニュースを表示';
        $wp_post_types['post']->labels->search_items = 'ニュースを検索';
        $wp_post_types['post']->labels->not_found = 'ニュースが見つかりません';
        $wp_post_types['post']->labels->not_found_in_trash = 'ゴミ箱にニュースが見つかりません';
        $wp_post_types['post']->labels->all_items = 'すべてのニュース';
        $wp_post_types['post']->labels->archives = 'ニュースアーカイブ';
        $wp_post_types['post']->labels->attributes = 'ニュース属性';
        $wp_post_types['post']->labels->insert_into_item = 'ニュースに挿入';
        $wp_post_types['post']->labels->uploaded_to_this_item = 'このニュースにアップロード';
        $wp_post_types['post']->labels->featured_image = 'アイキャッチ画像';
        $wp_post_types['post']->labels->set_featured_image = 'アイキャッチ画像を設定';
        $wp_post_types['post']->labels->remove_featured_image = 'アイキャッチ画像を削除';
        $wp_post_types['post']->labels->use_featured_image = 'アイキャッチ画像として使用';
        $wp_post_types['post']->labels->filter_items_list = 'ニュースリストを絞り込み';
        $wp_post_types['post']->labels->items_list_navigation = 'ニュースリストナビゲーション';
        $wp_post_types['post']->labels->items_list = 'ニュースリスト';
    }
}
add_action('init', 'change_post_labels');

// カスタム投稿タイプの登録
function register_custom_post_types()
{
    // シェフのカスタム投稿タイプ
    register_post_type('chef', array(
        'labels' => array(
            'name' => 'シェフ',
            'singular_name' => 'シェフ',
            'add_new' => '新規追加',
            'add_new_item' => '新しいシェフを追加',
            'edit_item' => 'シェフを編集',
            'new_item' => '新しいシェフ',
            'view_item' => 'シェフを表示',
            'search_items' => 'シェフを検索',
            'not_found' => 'シェフが見つかりません',
            'not_found_in_trash' => 'ゴミ箱にシェフが見つかりません'
        ),
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-admin-users'
    ));

    // ローカルパートナーのカスタム投稿タイプ
    register_post_type('local_partner', array(
        'labels' => array(
            'name' => 'ローカルパートナー',
            'singular_name' => 'ローカルパートナー',
            'add_new' => '新規追加',
            'add_new_item' => '新しいローカルパートナーを追加',
            'edit_item' => 'ローカルパートナーを編集',
            'new_item' => '新しいローカルパートナー',
            'view_item' => 'ローカルパートナーを表示',
            'search_items' => 'ローカルパートナーを検索',
            'not_found' => 'ローカルパートナーが見つかりません',
            'not_found_in_trash' => 'ゴミ箱にローカルパートナーが見つかりません'
        ),
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-groups'
    ));

    // プロジェクトのカスタム投稿タイプ
    register_post_type('project', array(
        'labels' => array(
            'name' => 'プロジェクト',
            'singular_name' => 'プロジェクト',
            'add_new' => '新規追加',
            'add_new_item' => '新しいプロジェクトを追加',
            'edit_item' => 'プロジェクトを編集',
            'new_item' => '新しいプロジェクト',
            'view_item' => 'プロジェクトを表示',
            'search_items' => 'プロジェクトを検索',
            'not_found' => 'プロジェクトが見つかりません',
            'not_found_in_trash' => 'ゴミ箱にプロジェクトが見つかりません'
        ),
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-portfolio'
    ));
}
add_action('init', 'register_custom_post_types');

// カスタムタクソノミーの登録
function register_custom_taxonomies()
{
    // シェフのタグ
    register_taxonomy('chef_category', 'chef', array(
        'labels' => array(
            'name' => 'シェフタグ',
            'singular_name' => 'シェフタグ',
            'search_items' => 'シェフタグを検索',
            'all_items' => 'すべてのシェフタグ',
            'edit_item' => 'シェフタグを編集',
            'update_item' => 'シェフタグを更新',
            'add_new_item' => '新しいシェフタグを追加',
            'new_item_name' => '新しいシェフタグ名'
        ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true
    ));

    // ローカルパートナーのタグ
    register_taxonomy('partner_category', 'local_partner', array(
        'labels' => array(
            'name' => 'パートナータグ',
            'singular_name' => 'パートナータグ',
            'search_items' => 'パートナータグを検索',
            'all_items' => 'すべてのパートナータグ',
            'edit_item' => 'パートナータグを編集',
            'update_item' => 'パートナータグを更新',
            'add_new_item' => '新しいパートナータグを追加',
            'new_item_name' => '新しいパートナータグ名'
        ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true
    ));

    // プロジェクトのタグ
    register_taxonomy('project_category', 'project', array(
        'labels' => array(
            'name' => 'プロジェクトタグ',
            'singular_name' => 'プロジェクトタグ',
            'search_items' => 'プロジェクトタグを検索',
            'all_items' => 'すべてのプロジェクトタグ',
            'edit_item' => 'プロジェクトタグを編集',
            'update_item' => 'プロジェクトタグを更新',
            'add_new_item' => '新しいプロジェクトタグを追加',
            'new_item_name' => '新しいプロジェクトタグ名'
        ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true
    ));
}
add_action('init', 'register_custom_taxonomies');

// コメント機能を無効化
function disable_comments_admin_menu()
{
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'disable_comments_admin_menu');

// 管理バーからコメントを削除
function disable_comments_admin_bar()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'disable_comments_admin_bar');

// リンクメニューを非表示にする
function hide_links_admin_menu()
{
    remove_menu_page('link-manager.php');
}
add_action('admin_menu', 'hide_links_admin_menu');

// 管理メニューの順番を変更する
function customize_admin_menu_order($menu_order)
{
    if (!$menu_order) return $menu_order;
    
    // 基本のメニュー順序
    $new_order = array(
        'index.php', // ダッシュボード
        'separator1', // セパレーター
        'edit.php', // ニュース（投稿）
        'edit.php?post_type=chef', // シェフ
        'edit.php?post_type=local_partner', // ローカルパートナー
        'edit.php?post_type=project', // プロジェクト
        'upload.php', // メディア
        'wpcf7', // Contact Form 7
        'edit.php?post_type=page', // 固定ページ
        'separator2', // セパレーター
        'themes.php', // 外観
        'plugins.php', // プラグイン
        'users.php', // ユーザー
        'tools.php', // ツール
        'options-general.php', // 設定
        'separator-last', // セパレーター
        'separator-last',
        'siteguard',
        'typesquare-admin-menu',
        'cwp_plugin',
        'theme-settings'
    );

    return $new_order;
}

function enable_custom_menu_order($bool)
{
    return true;
}

add_filter('custom_menu_order', 'enable_custom_menu_order');
add_filter('menu_order', 'customize_admin_menu_order');


// ブロックパターンを登録
function register_custom_block_patterns()
{
    // パターンタグを登録
    register_block_pattern_category(
        'second-restaurant',
        array('label' => 'Second Restaurant')
    );

    // シェフプロフィールパターンファイルを読み込み
    $chef_profile_pattern = file_get_contents(get_stylesheet_directory() . '/patterns/chef-profile-pattern.html');

    if ($chef_profile_pattern) {
        register_block_pattern(
            'second-restaurant/chef-profile',
            array(
                'title'       => 'シェフプロフィール',
                'description' => 'シェフの詳細プロフィール表示用パターン',
                'content'     => $chef_profile_pattern,
                'categories'  => array('second-restaurant'),
                'keywords'    => array('chef', 'profile', 'シェフ', 'プロフィール'),
            )
        );

        // local_partnerブロックパターンの登録
        $local_partner_profile_pattern_file = get_stylesheet_directory() . '/patterns/local-partner-profile-pattern.html';
        if (file_exists($local_partner_profile_pattern_file)) {
            $local_partner_profile_pattern = file_get_contents($local_partner_profile_pattern_file);
            register_block_pattern(
                'second-restaurant/local-partner-profile',
                array(
                    'title'       => '地域パートナープロフィール',
                    'description' => '地域パートナーの詳細プロフィール表示用パターン',
                    'content'     => $local_partner_profile_pattern,
                    'categories'  => array('second-restaurant'),
                    'keywords'    => array('local-partner', 'partner', 'profile', '地域パートナー', 'プロフィール'),
                )
            );
        }

        // プロジェクト詳細ブロックパターンの登録
        $project_detail_pattern_file = get_stylesheet_directory() . '/patterns/project-detail-pattern.html';
        if (file_exists($project_detail_pattern_file)) {
            $project_detail_pattern = file_get_contents($project_detail_pattern_file);
            register_block_pattern(
                'second-restaurant/project-detail',
                array(
                    'title'       => 'プロジェクト詳細',
                    'description' => 'プロジェクトの詳細情報表示用パターン',
                    'content'     => $project_detail_pattern,
                    'categories'  => array('second-restaurant'),
                    'keywords'    => array('project', 'detail', 'プロジェクト', '詳細'),
                )
            );
        }
    }
}
add_action('init', 'register_custom_block_patterns');

function add_local_partner_detail_class_to_editor_wrapper() {
    $script = "
    function addIdToEditorWrapper() {
        var wrapper = document.querySelector('.is-root-container');
        if (wrapper) {
            wrapper.id = 'local-partner-detail-page';
        } else {
            // 要素が見つからない場合は少し待ってから再試行
            setTimeout(addIdToEditorWrapper, 100);
        }
    }
    
    // 複数のタイミングで実行を試行
    document.addEventListener('DOMContentLoaded', addIdToEditorWrapper);
    window.addEventListener('load', addIdToEditorWrapper);
    
    // MutationObserverで要素の追加を監視
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                addIdToEditorWrapper();
            }
        });
    });
    observer.observe(document.body, { childList: true, subtree: true });
    ";
    wp_add_inline_script('wp-blocks', $script);
}
add_action('enqueue_block_editor_assets', 'add_local_partner_detail_class_to_editor_wrapper');


// テーマを適用後、固定ページABOUT、JOIN、CONTACT、PRIVACY-POLICYが存在しない場合は作成
function create_default_pages() {
    // 作成するページの設定
    $pages_to_create = array(
        array(
            'slug' => 'about',
            'title' => 'ABOUT',
            'content' => 'このページはABOUTの内容が入ります。',
            'set_as_front_page' => false
        ),
        array(
            'slug' => 'join',
            'title' => 'JOIN',
            'content' => 'このページはJOINの内容が入ります。',
            'set_as_front_page' => false
        ),
        array(
            'slug' => 'contact',
            'title' => 'CONTACT',
            'content' => 'このページはCONTACTの内容が入ります。',
            'set_as_front_page' => false
        ),
        array(
            'slug' => 'privacy-policy',
            'title' => 'PRIVACY POLICY',
            'content' => 'このページはプライバシーポリシーの内容が入ります。',
            'set_as_front_page' => false
        )
    );

    foreach ($pages_to_create as $page_config) {
        // ページが既に存在するかチェック
        $existing_page = get_page_by_path($page_config['slug']);
        
        if (!$existing_page) {
            // ページを作成
            $page_id = wp_insert_post(array(
                'post_title' => $page_config['title'],
                'post_content' => $page_config['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_name' => $page_config['slug'],
            ));
            
            // フロントページとして設定する場合
            if ($page_config['set_as_front_page'] && $page_id) {
                update_option('page_on_front', $page_id);
            }
        }
    }
}
add_action('after_setup_theme', 'create_default_pages');

// お問い合わせフォームの処理
function handle_contact_form_submission() {
    // nonce検証
    if (!wp_verify_nonce($_POST['contact_form_nonce'], 'contact_form_action')) {
        wp_die('セキュリティチェックに失敗しました。');
    }

    // フォームデータの取得とサニタイズ
    $name = sanitize_text_field($_POST['contact_name']);
    $organization = sanitize_text_field($_POST['contact_organization']);
    $email = sanitize_email($_POST['contact_email']);
    $contact_type = sanitize_text_field($_POST['contact_type']);
    $message = sanitize_textarea_field($_POST['contact_message']);
    $privacy_agreement = isset($_POST['privacy_agreement']);

    // 必須項目のチェック
    if (empty($name) || empty($email) || empty($contact_type) || empty($message) || !$privacy_agreement) {
        wp_redirect(add_query_arg('contact_error', '1', wp_get_referer()));
        exit;
    }

    // メールの件名と本文を作成
    $subject = '[Second Restaurant] お問い合わせ - ' . $contact_type;
    $body = "お問い合わせをいただきありがとうございます。\n\n";
    $body .= "氏名: " . $name . "\n";
    $body .= "所属: " . $organization . "\n";
    $body .= "メールアドレス: " . $email . "\n";
    $body .= "お問い合わせ種別: " . $contact_type . "\n";
    $body .= "お問い合わせ内容:\n" . $message . "\n\n";
    $body .= "このメールは自動送信されました。";

    // 管理者メールアドレスを取得
    $admin_email = get_option('admin_email');
    
    // メール送信
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $mail_sent = wp_mail($admin_email, $subject, nl2br($body), $headers);

    // 送信結果に応じてリダイレクト
    if ($mail_sent) {
        wp_redirect(add_query_arg('contact_success', '1', wp_get_referer()));
    } else {
        wp_redirect(add_query_arg('contact_error', '2', wp_get_referer()));
    }
    exit;
}
add_action('admin_post_submit_contact_form', 'handle_contact_form_submission');
add_action('admin_post_nopriv_submit_contact_form', 'handle_contact_form_submission');

// お問い合わせフォーム送信後のメッセージ表示
function display_contact_form_messages() {
    if (isset($_GET['contact_success'])) {
        echo '<div class="contact-message contact-success">お問い合わせを送信しました。ありがとうございます。</div>';
    } elseif (isset($_GET['contact_error'])) {
        $error_code = $_GET['contact_error'];
        if ($error_code == '1') {
            echo '<div class="contact-message contact-error">必須項目を入力してください。</div>';
        } elseif ($error_code == '2') {
            echo '<div class="contact-message contact-error">送信に失敗しました。しばらく経ってから再度お試しください。</div>';
        }
    }
}

// Contactページでメッセージを表示するためのフック
function add_contact_messages_to_contact_page() {
    if (is_page('contact')) {
        add_action('wp_footer', 'display_contact_form_messages');
    }
}
add_action('wp', 'add_contact_messages_to_contact_page');

// プロジェクト用カスタムフィールドのメタボックスを追加
function add_project_meta_boxes() {
    add_meta_box(
        'project_details',
        'プロジェクト詳細',
        'project_meta_box_callback',
        'project',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_project_meta_boxes');

// プロジェクトメタボックスのコールバック関数
function project_meta_box_callback($post) {
    // nonce フィールドを追加
    wp_nonce_field('project_meta_box', 'project_meta_box_nonce');
    
    // 現在の値を取得
    $start_date = get_post_meta($post->ID, 'start_date', true);
    $end_date = get_post_meta($post->ID, 'end_date', true);
    $is_pickup = get_post_meta($post->ID, 'is_pickup', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="start_date">開始日</label>
            </th>
            <td>
                <input type="date" id="start_date" name="start_date" value="<?php echo esc_attr($start_date); ?>" />
                <p class="description">プロジェクトの開始日を入力してください。</p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="end_date">終了日</label>
            </th>
            <td>
                <input type="date" id="end_date" name="end_date" value="<?php echo esc_attr($end_date); ?>" />
                <p class="description">プロジェクトの終了日を入力してください。</p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="is_pickup">PICK UP</label>
            </th>
            <td>
                <input type="checkbox" id="is_pickup" name="is_pickup" value="1" <?php checked($is_pickup, '1'); ?> />
                <label for="is_pickup">このプロジェクトをPICK UPとして表示する</label>
                <p class="description">チェックを入れると、プロジェクト一覧でPICK UPバッジが表示されます。</p>
            </td>
        </tr>
    </table>
    <?php
}

// プロジェクトメタデータの保存
function save_project_meta_data($post_id) {
    // nonce チェック
    if (!isset($_POST['project_meta_box_nonce']) || !wp_verify_nonce($_POST['project_meta_box_nonce'], 'project_meta_box')) {
        return;
    }
    
    // 自動保存時は処理しない
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // 権限チェック
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // 開始日の保存
    if (isset($_POST['start_date'])) {
        update_post_meta($post_id, 'start_date', sanitize_text_field($_POST['start_date']));
    }
    
    // 終了日の保存
    if (isset($_POST['end_date'])) {
        update_post_meta($post_id, 'end_date', sanitize_text_field($_POST['end_date']));
    }
    
    // PICK UPフラグの保存
    if (isset($_POST['is_pickup'])) {
        update_post_meta($post_id, 'is_pickup', '1');
    } else {
        update_post_meta($post_id, 'is_pickup', '0');
    }
}
add_action('save_post', 'save_project_meta_data');

// シェフ・地域パートナー用カスタムフィールドのメタボックスを追加
function add_chef_local_partner_meta_boxes() {
    // シェフ用メタボックス
    add_meta_box(
        'chef_details',
        'シェフ詳細',
        'chef_meta_box_callback',
        'chef',
        'normal',
        'high'
    );
    
    // 地域パートナー用メタボックス
    add_meta_box(
        'local_partner_details',
        '地域パートナー詳細',
        'local_partner_meta_box_callback',
        'local_partner',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_chef_local_partner_meta_boxes');

// シェフメタボックスのコールバック関数
function chef_meta_box_callback($post) {
    wp_nonce_field('chef_meta_box', 'chef_meta_box_nonce');
    
    $position = get_post_meta($post->ID, 'position', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="position">肩書・役職</label>
            </th>
            <td>
                <input type="text" id="position" name="position" value="<?php echo esc_attr($position); ?>" class="regular-text" />
                <p class="description">シェフの肩書や役職を入力してください。（例：料理長、オーナーシェフ）</p>
            </td>
        </tr>
    </table>
    <?php
}

// 地域パートナーメタボックスのコールバック関数
function local_partner_meta_box_callback($post) {
    wp_nonce_field('local_partner_meta_box', 'local_partner_meta_box_nonce');
    
    $location = get_post_meta($post->ID, 'location', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="location">所在地</label>
            </th>
            <td>
                <input type="text" id="location" name="location" value="<?php echo esc_attr($location); ?>" class="regular-text" />
                <p class="description">地域パートナーの所在地を入力してください。（例：香川県三豊市）</p>
            </td>
        </tr>
    </table>
    <?php
}

// シェフ・地域パートナーメタデータの保存
function save_chef_local_partner_meta_data($post_id) {
    // シェフの場合
    if (get_post_type($post_id) === 'chef') {
        if (!isset($_POST['chef_meta_box_nonce']) || !wp_verify_nonce($_POST['chef_meta_box_nonce'], 'chef_meta_box')) {
            return;
        }
        
        if (isset($_POST['position'])) {
            update_post_meta($post_id, 'position', sanitize_text_field($_POST['position']));
        }
    }
    
    // 地域パートナーの場合
    if (get_post_type($post_id) === 'local_partner') {
        if (!isset($_POST['local_partner_meta_box_nonce']) || !wp_verify_nonce($_POST['local_partner_meta_box_nonce'], 'local_partner_meta_box')) {
            return;
        }
        
        if (isset($_POST['location'])) {
            update_post_meta($post_id, 'location', sanitize_text_field($_POST['location']));
        }
    }
    
    // 権限チェック
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // 自動保存時は処理しない
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
}
add_action('save_post', 'save_chef_local_partner_meta_data');


// Contact Form 7で自動挿入されるPタグ、brタグを削除
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false() {
  return false;
}

// ニュースカテゴリーのデフォルト設定
function setup_default_news_categories() {
    // デフォルトカテゴリーが存在しない場合作成
    $default_categories = array(
        'news-release' => 'ニュースリリース',
        'media' => 'メディア掲載',
        'other' => 'その他'
    );
    
    foreach ($default_categories as $slug => $name) {
        if (!term_exists($slug, 'category')) {
            wp_insert_term($name, 'category', array('slug' => $slug));
        }
    }
}
add_action('after_setup_theme', 'setup_default_news_categories');

// add_filter('post_link', 'custom_post_permalink', 10, 2);

// ページネーションテスト用のサンプル投稿作成
function create_sample_news_posts() {
    // カテゴリーを取得または作成
    $categories = array(
        'news-release' => 'ニュースリリース',
        'media' => 'メディア掲載',
        'other' => 'その他'
    );
    
    $category_ids = array();
    
    // カテゴリーを作成または取得
    foreach ($categories as $slug => $name) {
        $category = get_term_by('slug', $slug, 'category');
        if (!$category) {
            $category = wp_insert_term($name, 'category', array('slug' => $slug));
            $category_ids[$slug] = $category['term_id'];
        } else {
            $category_ids[$slug] = $category->term_id;
        }
    }
    
    // 各カテゴリーに25件ずつ投稿を作成
    foreach ($category_ids as $slug => $category_id) {
        $category_name = $categories[$slug];
        
        for ($i = 1; $i <= 25; $i++) {
            $post_title = $category_name . 'のサンプル記事 ' . $i;
            $post_content = $category_name . 'のサンプル記事です。これはページネーションテスト用のダミー記事です。記事番号: ' . $i . '。' . 
                          'この記事は自動生成されました。実際のニュース記事ではありません。テスト用の内容となっています。' . 
                          'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
            
            // 既に同じタイトルの投稿が存在しないかチェック
            $existing_post = get_page_by_title($post_title, OBJECT, 'post');
            
            if (!$existing_post) {
                $post_id = wp_insert_post(array(
                    'post_title' => $post_title,
                    'post_content' => $post_content,
                    'post_status' => 'publish',
                    'post_type' => 'post',
                    'post_author' => 1,
                    'post_date' => date('Y-m-d H:i:s', strtotime('-' . rand(1, 365) . ' days'))
                ));
                
                if ($post_id) {
                    // カテゴリーを設定
                    wp_set_post_categories($post_id, array($category_id));
                    
                    // アイキャッチ画像をダミー画像として設定（オプション）
                    // set_post_thumbnail($post_id, $attachment_id);
                }
            }
        }
    }
    
    // 成功メッセージを管理画面に表示
    add_action('admin_notices', function() {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p>サンプルニュース記事を75件作成しました（各カテゴリー25件ずつ）。</p>';
        echo '</div>';
    });
}

// サンプル投稿削除関数（必要に応じて使用）
function delete_sample_news_posts() {
    $categories = array('news-release', 'media', 'other');
    
    foreach ($categories as $slug) {
        $category = get_term_by('slug', $slug, 'category');
        if ($category) {
            $posts = get_posts(array(
                'category' => $category->term_id,
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key' => 'is_sample_post',
                        'compare' => 'NOT EXISTS'
                    )
                )
            ));
            
            foreach ($posts as $post) {
                if (strpos($post->post_title, 'サンプル記事') !== false) {
                    wp_delete_post($post->ID, true);
                }
            }
        }
    }
    
    add_action('admin_notices', function() {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p>サンプルニュース記事を削除しました。</p>';
        echo '</div>';
    });
}


// カスタム投稿タイプ用サンプルデータ作成
function create_sample_custom_posts() {
    // シェフのサンプルデータを作成
    create_sample_chef_posts();
    
    // 地域パートナーのサンプルデータを作成
    create_sample_local_partner_posts();
    
    // プロジェクトのサンプルデータを作成
    create_sample_project_posts();
    
    // 成功メッセージを管理画面に表示
    add_action('admin_notices', function() {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p>すべてのカスタム投稿タイプのサンプルデータを作成しました。（シェフ20件、地域パートナー20件、プロジェクト30件）</p>';
        echo '</div>';
    });
}

// シェフのサンプルデータ作成
function create_sample_chef_posts() {
    // シェフカテゴリーを作成または取得
    $chef_categories = array(
        'french' => 'フレンチ',
        'italian' => 'イタリアン',
        'japanese' => '和食',
        'other-cuisine' => 'その他'
    );
    
    $category_ids = array();
    foreach ($chef_categories as $slug => $name) {
        $category = get_term_by('slug', $slug, 'chef_category');
        if (!$category) {
            $category = wp_insert_term($name, 'chef_category', array('slug' => $slug));
            $category_ids[$slug] = $category['term_id'];
        } else {
            $category_ids[$slug] = $category->term_id;
        }
    }
    
    // 20件のシェフデータを作成
    for ($i = 1; $i <= 20; $i++) {
        $post_title = 'シェフサンプル ' . $i;
        $post_content = 'シェフのプロフィール情報です。これはサンプルデータです。シェフ番号: ' . $i . '。' .
                       '経歴や得意料理、料理への想いなどが記載されます。実際の運用時には具体的な情報を入力してください。' .
                       'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
        
        $existing_post = get_page_by_title($post_title, OBJECT, 'chef');
        
        if (!$existing_post) {
            $post_id = wp_insert_post(array(
                'post_title' => $post_title,
                'post_content' => $post_content,
                'post_status' => 'publish',
                'post_type' => 'chef',
                'post_author' => 1,
                'post_date' => date('Y-m-d H:i:s', strtotime('-' . rand(1, 180) . ' days'))
            ));
            
            if ($post_id) {
                // ランダムなカテゴリーを設定
                $random_category = array_rand($category_ids);
                wp_set_post_terms($post_id, array($category_ids[$random_category]), 'chef_category');
                
                // 肩書を設定
                $positions = array('料理長', 'オーナーシェフ', 'スーシェフ', 'パティシエ', '専門シェフ');
                update_post_meta($post_id, 'position', $positions[array_rand($positions)]);
            }
        }
    }
}

// 地域パートナーのサンプルデータ作成
function create_sample_local_partner_posts() {
    // パートナーカテゴリーを作成または取得
    $partner_categories = array(
        'farm' => '農園',
        'winery' => 'ワイナリー',
        'fishery' => '漁業',
        'craft' => '工芸品',
        'tourism' => '観光'
    );
    
    $category_ids = array();
    foreach ($partner_categories as $slug => $name) {
        $category = get_term_by('slug', $slug, 'partner_category');
        if (!$category) {
            $category = wp_insert_term($name, 'partner_category', array('slug' => $slug));
            $category_ids[$slug] = $category['term_id'];
        } else {
            $category_ids[$slug] = $category->term_id;
        }
    }
    
    // 20件の地域パートナーデータを作成
    $locations = array('香川県三豊市', '愛媛県今治市', '徳島県美馬市', '高知県四万十市', '岡山県倉敷市');
    
    for ($i = 1; $i <= 20; $i++) {
        $post_title = '地域パートナーサンプル ' . $i;
        $post_content = '地域パートナーの詳細情報です。これはサンプルデータです。パートナー番号: ' . $i . '。' .
                       '地域の特産品や取り組み、生産者の想いなどが記載されます。実際の運用時には具体的な情報を入力してください。' .
                       'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
        
        $existing_post = get_page_by_title($post_title, OBJECT, 'local_partner');
        
        if (!$existing_post) {
            $post_id = wp_insert_post(array(
                'post_title' => $post_title,
                'post_content' => $post_content,
                'post_status' => 'publish',
                'post_type' => 'local_partner',
                'post_author' => 1,
                'post_date' => date('Y-m-d H:i:s', strtotime('-' . rand(1, 180) . ' days'))
            ));
            
            if ($post_id) {
                // ランダムなカテゴリーを設定
                $random_category = array_rand($category_ids);
                wp_set_post_terms($post_id, array($category_ids[$random_category]), 'partner_category');
                
                // 所在地を設定
                update_post_meta($post_id, 'location', $locations[array_rand($locations)]);
            }
        }
    }
}

// プロジェクトのサンプルデータ作成
function create_sample_project_posts() {
    // プロジェクトカテゴリーを作成または取得
    $project_categories = array(
        'collaboration' => 'コラボレーション',
        'popup' => 'ポップアップ',
        'event' => 'イベント',
        'seasonal' => 'シーズン限定'
    );
    
    $category_ids = array();
    foreach ($project_categories as $slug => $name) {
        $category = get_term_by('slug', $slug, 'project_category');
        if (!$category) {
            $category = wp_insert_term($name, 'project_category', array('slug' => $slug));
            $category_ids[$slug] = $category['term_id'];
        } else {
            $category_ids[$slug] = $category->term_id;
        }
    }
    
    // 30件のプロジェクトデータを作成
    for ($i = 1; $i <= 30; $i++) {
        $post_title = 'プロジェクトサンプル ' . $i;
        $post_content = 'プロジェクトの詳細情報です。これはサンプルデータです。プロジェクト番号: ' . $i . '。' .
                       'シェフと地域パートナーのコラボレーション詳細、開催場所、料理内容などが記載されます。' .
                       'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
        
        $existing_post = get_page_by_title($post_title, OBJECT, 'project');
        
        if (!$existing_post) {
            // プロジェクトの期間を設定（過去、現在、未来をランダムに）
            $status = rand(1, 3);
            switch ($status) {
                case 1: // 過去のプロジェクト
                    $start_days_ago = rand(30, 365);
                    $duration = rand(7, 30);
                    $start_date = date('Y-m-d', strtotime('-' . $start_days_ago . ' days'));
                    $end_date = date('Y-m-d', strtotime('-' . ($start_days_ago - $duration) . ' days'));
                    break;
                case 2: // 現在のプロジェクト
                    $start_days_ago = rand(1, 15);
                    $duration = rand(15, 45);
                    $start_date = date('Y-m-d', strtotime('-' . $start_days_ago . ' days'));
                    $end_date = date('Y-m-d', strtotime('+' . ($duration - $start_days_ago) . ' days'));
                    break;
                case 3: // 未来のプロジェクト
                    $start_days_future = rand(1, 90);
                    $duration = rand(7, 30);
                    $start_date = date('Y-m-d', strtotime('+' . $start_days_future . ' days'));
                    $end_date = date('Y-m-d', strtotime('+' . ($start_days_future + $duration) . ' days'));
                    break;
            }
            
            $post_id = wp_insert_post(array(
                'post_title' => $post_title,
                'post_content' => $post_content,
                'post_status' => 'publish',
                'post_type' => 'project',
                'post_author' => 1,
                'post_date' => date('Y-m-d H:i:s', strtotime('-' . rand(1, 30) . ' days'))
            ));
            
            if ($post_id) {
                // ランダムなカテゴリーを設定
                $random_category = array_rand($category_ids);
                wp_set_post_terms($post_id, array($category_ids[$random_category]), 'project_category');
                
                // プロジェクト詳細を設定
                update_post_meta($post_id, 'start_date', $start_date);
                update_post_meta($post_id, 'end_date', $end_date);
                
                // 20%の確率でPICK UPに設定
                $is_pickup = rand(1, 5) == 1 ? '1' : '0';
                update_post_meta($post_id, 'is_pickup', $is_pickup);
            }
        }
    }
}

// カスタム投稿タイプのサンプルデータ削除
function delete_sample_custom_posts() {
    // シェフのサンプルデータを削除
    delete_sample_posts_by_type('chef', 'シェフサンプル');
    
    // 地域パートナーのサンプルデータを削除
    delete_sample_posts_by_type('local_partner', '地域パートナーサンプル');
    
    // プロジェクトのサンプルデータを削除
    delete_sample_posts_by_type('project', 'プロジェクトサンプル');
    
    add_action('admin_notices', function() {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p>すべてのカスタム投稿タイプのサンプルデータを削除しました。</p>';
        echo '</div>';
    });
}

// 指定されたポストタイプのサンプル投稿を削除
function delete_sample_posts_by_type($post_type, $title_pattern) {
    $posts = get_posts(array(
        'post_type' => $post_type,
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ));
    
    foreach ($posts as $post) {
        if (strpos($post->post_title, $title_pattern) !== false) {
            wp_delete_post($post->ID, true);
        }
    }
}

function addSampleData(){

// 投稿作成を実行（一旦コメントアウト）
add_action('wp_loaded', 'create_sample_news_posts');

// サンプル投稿削除を実行（一旦コメントアウト）
// add_action('wp_loaded', 'delete_sample_news_posts');

// カスタム投稿タイプサンプル作成を実行（一旦コメントアウト）
add_action('wp_loaded', 'create_sample_custom_posts');

// カスタム投稿タイプサンプル削除を実行（一旦コメントアウト）
// add_action('wp_loaded', 'delete_sample_custom_posts'); 
}

// addSampleData();
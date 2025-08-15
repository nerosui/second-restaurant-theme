# Second Restaurant WordPress Theme

地域とシェフをつなぐ"多拠点レストラン"という新たな文化を創出するWordPressテーマ

## 概要

Second Restaurantは、都市部で活躍するシェフが地域に滞在し、期間限定のレストランを構える"多拠点レストラン"という新しい飲食店のあり方を提案するプロジェクトです。

## 機能

### カスタム投稿タイプ
- **シェフ（Chef）**: 旅するシェフの情報管理
- **地域パートナー（Local Partner）**: 地域パートナーの情報管理  
- **プロジェクト（Project）**: セカンドレストランの開催情報管理

### カスタムフィールド
- **シェフ**: 肩書・役職
- **地域パートナー**: 所在地
- **プロジェクト**: 開始日、終了日、PICK UPフラグ

### ページテンプレート
- フロントページ（`front-page.php`）
- 固定ページテンプレート（`page-{slug}.php`）
- カスタム投稿タイプ一覧ページ（`archive-{post_type}.php`）
- カスタム投稿タイプ個別ページ（`single-{post_type}.php`）
- ニュース一覧・個別ページ（`archive-post.php`, `single-post.php`）

### その他の機能
- レスポンシブ対応
- Gutenbergブロックパターン
- お問い合わせフォーム
- Swiper.jsによるカルーセル表示
- 日付によるプロジェクトフィルター機能

## 必要要件

- **WordPress**: 6.0以上
- **PHP**: 7.4以上
- **親テーマ**: Cocoon

## インストール

1. Cocoon親テーマをインストール・有効化
2. このテーマを`wp-content/themes/`にアップロード
3. WordPress管理画面でテーマを有効化

## 開発環境セットアップ

### 必要なVS Code拡張機能

- PHP Intelephense
- WordPress Snippets
- Hooks IntelliSense for WordPress  
- PHP DocBlocker
- Prettier - Code formatter

### コーディング規約

このプロジェクトはWordPress Coding Standardsに準拠しています。

```bash
# PHP_CodeSnifferでコードチェック
phpcs --standard=phpcs.xml

# 自動修正
phpcbf --standard=phpcs.xml
```

## ファイル構成

```
cocoon-child-master/
├── functions.php              # テーマ機能の定義
├── style.css                 # スタイルシート
├── front-page.php            # フロントページテンプレート
├── page-{slug}.php           # 固定ページテンプレート
├── archive-{post_type}.php   # 一覧ページテンプレート
├── single-{post_type}.php    # 個別ページテンプレート
├── breadcrumbs.php           # パンくずリストテンプレート
├── images/                   # 画像ファイル
├── patterns/                 # Gutenbergブロックパターン
└── .vscode/                  # VS Code設定
```

## カスタマイズ

### 新しいカスタム投稿タイプの追加

1. `functions.php`の`register_custom_post_types()`に追加
2. 必要に応じてカスタムタクソノミーを追加
3. テンプレートファイルを作成

### スタイルの変更

メインのスタイルは`scss/style.scss`で管理されています。

### ブロックパターンの追加

1. `patterns/`フォルダに`.html`ファイルを作成
2. `functions.php`の`register_custom_block_patterns()`に登録コードを追加

## サンプルデータ

開発・テスト用のサンプルデータ作成機能が含まれています。

```php
// functions.phpで以下のコメントアウトを外して実行
add_action('wp_loaded', 'create_sample_news_posts');        // ニュース75件
add_action('wp_loaded', 'create_sample_custom_posts');      // カスタム投稿70件
```

## トラブルシューティング

### よくある問題

**Q: カスタム投稿タイプが表示されない**
A: パーマリンク設定を更新してください（設定 > パーマリンク > 変更を保存）

**Q: 画像が表示されない**  
A: `images/`フォルダに必要な画像ファイルがアップロードされているか確認してください

**Q: スタイルが適用されない**
A: ブラウザキャッシュをクリアし、`scss/style.scss`が正しく読み込まれているか確認してください

## ライセンス

このテーマは[GPL v2 or later](https://www.gnu.org/licenses/gpl-2.0.html)の下で配布されています。

## 更新履歴

### v1.0.0 (2025-07-29)
- 初回リリース
- 基本機能の実装完了

## 開発者

Second Restaurant Development Team

## サポート

技術的な質問や問題については、GitHubのIssuesページでお知らせください。

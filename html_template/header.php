<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Second Restaurant - 旅するシェフのセカンドレストラン</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script defer src="script.js"></script>
</head>

<body>
  <!-- ローディング画面 -->
  <div id="loading" class="loading-wrapper">
    <div class="loading-content">
      <div class="loading-logo">
        <img src="images/loading_logo.png" alt="Second Restaurant Logo" class="loading-logo-img" />
      </div>
      <div class="loading-dots">
        <div class="loading-dot dot-1"></div>
        <div class="loading-dot dot-2"></div>
        <div class="loading-dot dot-3"></div>
      </div>
    </div>
  </div>

  <!-- ヘッダー -->
  <header class="sr-header">
    <div class="header-logo">
      <a href="/" class="logo-link">
        <img src="images/logo.svg" alt="Second Restaurant Logo" class="logo" />
      </a>
    </div>
    <button
      class="menu-button"
      id="menuButton"
      aria-label="メニューを開く"
      aria-expanded="false">
      <img
        src="images/menu-icon.svg"
        alt="メニューアイコン"
        class="menu-icon" />
    </button>
    <nav class="menu-drawer" id="menuDrawer" aria-hidden="true">
      <div class="drawer-bg" id="drawerBg"></div>
      <div class="drawer-content">
        <button
          class="drawer-close"
          id="drawerClose"
          aria-label="メニューを閉じる">
          <div class="close-icon">
            <span class="close-line"></span>
            <span class="close-line"></span>
          </div>
          <span class="close-text">CLOSE</span>
        </button>

        <div class="language-selector">
          <button class="language-btn">Language</button>
        </div>
        <div class="drawer-logo">
          <img src="images/menu-logo.svg" alt="Second Restaurant Logo" class="drawer-logo-img" />
        </div>
        <ul class="drawer-list">
          <li><a href="./about.php">ABOUT</a></li>
          <li><a href="./localpartner.php">LOCAL PARTNER</a></li>
          <li><a href="./chef.php">TRAVELING CHEF</a></li>
          <li><a href="./project.php">PROJECT</a></li>
          <li><a href="./news.php">NEWS</a></li>
        </ul>
        <div class="drawer-footer">
          <div class="drawer-social">
            <a href="#" class="social-link" aria-label="X (Twitter)">
              <img src="images/sns-icon-x.svg" alt="X" />
            </a>
            <a href="#" class="social-link" aria-label="Instagram">
              <img src="images/sns-icon-instagram.svg" alt="Instagram" />
            </a>
          </div>
          <div class="drawer-links">
            <a href="https://interlocalpartners.jp/">運営会社</a>
            <a href="#">プライバシーポリシー</a>
          </div>
          <div class="drawer-buttons">
            <a href="./join.php" class="drawer-btn join-btn">JOIN</a>
            <a href="./contact.php" class="drawer-btn contact-btn">CONTACT</a>
          </div>
        </div>
      </div>
    </nav>
  </header>
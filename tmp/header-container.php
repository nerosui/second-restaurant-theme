
<!-- ローディング画面 -->
<div id="loading" class="loading-wrapper">
  <div class="loading-content">
    <div class="loading-logo">
      <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/loading_logo.png" alt="Second Restaurant Logo" class="loading-logo-img" />
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
      <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/logo.svg" alt="Second Restaurant Logo" class="logo" />
    </a>
  </div>
  <button
    class="menu-button"
    id="menuButton"
    aria-label="メニューを開く"
    aria-expanded="false">
    <img
      src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/menu-icon.svg"
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
        <button class="language-btn">
          <?php echo do_shortcode('[gtranslate]'); ?>
        </button>
      </div>
      <div class="drawer-logo">
        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/menu-logo.svg" alt="Second Restaurant Logo" class="drawer-logo-img" />
      </div>
      <ul class="drawer-list">
        <li><a href="/about">ABOUT</a></li>
        <li><a href="/local_partner">LOCAL PARTNER</a></li>
        <li><a href="/chef">TRAVELING CHEF</a></li>
        <li><a href="/project">PROJECT</a></li>
        <li><a href="/news-list">NEWS</a></li>
      </ul>
      <div class="drawer-footer">
        <div class="drawer-social">
          <a href="#" class="social-link" aria-label="X (Twitter)">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/sns-icon-x.svg" alt="X" />
          </a>
          <a href="#" class="social-link" aria-label="Instagram">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/sns-icon-instagram.svg" alt="Instagram" />
          </a>
        </div>
        <div class="drawer-links">
          <a href="https://interlocalpartners.jp/">運営会社</a>
          <a href="/privacy-policy">プライバシーポリシー</a>
        </div>
        <div class="drawer-buttons">
          <a href="/join" class="drawer-btn join-btn">JOIN US</a>
          <a href="/contact" class="drawer-btn contact-btn">CONTACT</a>
        </div>
      </div>
    </div>
  </nav>
</header>
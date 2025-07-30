jQuery(document).ready(function ($) {
  // ローディング画面を表示
  const showLoader = () => {
    const loader = $('#loading');
    loader.removeClass('fade-out');

    gsap.set(loader, { display: 'flex', opacity: 0 });
    gsap.to(loader, {
      opacity: 1,
      duration: 0.3,
      ease: 'power2.out',
    });
  };

  // ローディング画面を非表示
  const hideLoader = () => {
    const loader = $('#loading');
    if (loader.length > 0) {
      gsap.to(loader, {
        opacity: 0,
        duration: 0.3,
        ease: 'power2.out',
        onComplete: () => {
          loader.addClass('fade-out');
        },
      });
    }
  };

  // ページ読み込み完了時の処理
  const onPageLoad = () => {
    // 画像の読み込み完了を待つ
    const images = $('img');
    let loadedImages = 0;
    const totalImages = images.length;

    if (totalImages === 0) {
      hideLoader();
      return;
    }

    images.each(function () {
      const img = new Image();
      img.onload = img.onerror = () => {
        loadedImages++;
        if (loadedImages === totalImages) {
          // 最小表示時間を設定（UX向上のため）
          setTimeout(hideLoader, 800);
        }
      };
      img.src = this.src;
    });
  };

  // リンククリック時の処理
  $(document).on(
    'click',
    'a:not([href^="#"]):not([href^="mailto:"]):not([href^="tel:"]):not([target="_blank"]):not(.no-loading)',
    function (e) {
      const href = $(this).attr('href');

      // 外部サイトや特殊なリンクは除外
      if (
        !href ||
        href.startsWith('javascript:') ||
        href.includes(window.location.hostname) === false
      ) {
        return;
      }
      console.log('Link clicked:');
      e.preventDefault();
      showLoader();
      console.log('Link clicked:showLoader');
      // 少し遅延してからページ遷移
      setTimeout(() => {
        window.location.href = href;
      }, 300);
    }
  );

  // フォーム送信時の処理
  $(document).on('submit', 'form:not(.no-loading)', function () {
    showLoader();
  });

  // 初回ページ読み込み時
  if (document.readyState === 'complete') {
    onPageLoad();
  } else {
    $(window).on('load', onPageLoad);
  }

  // ブラウザの戻る・進むボタン対応
  $(window).on('pageshow', function (e) {
    if (e.originalEvent.persisted) {
      hideLoader();
    }
  });

  // ページが隠れる前にローダーを表示
  $(window).on('beforeunload', function () {
    showLoader();
  });
});

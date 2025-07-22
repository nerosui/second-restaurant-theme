// スムーススクロール
document.addEventListener('DOMContentLoaded', function() {
    // スムーススクロールの実装
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = targetElement.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });


    // メニュードロワーの開閉
    const menuDrawer = document.getElementById('menuDrawer');
    const drawerBg = document.getElementById('drawerBg');
    const drawerClose = document.getElementById('drawerClose');
    const menuButton = document.getElementById('menuButton');

    function openDrawer() {
        menuDrawer.classList.add('open');
        menuDrawer.setAttribute('aria-hidden', 'false');
        menuButton.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }
    function closeDrawer() {
        menuDrawer.classList.remove('open');
        menuDrawer.setAttribute('aria-hidden', 'true');
        menuButton.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }
    menuButton.addEventListener('click', openDrawer);
    drawerBg.addEventListener('click', closeDrawer);
    drawerClose.addEventListener('click', closeDrawer);
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDrawer();
    });

    // カードの順次表示アニメーション
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // カード要素を監視
    const cards = document.querySelectorAll('.chef-card, .project-card, .news-item');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });

    // セクションタイトルのアニメーション
    const sectionTitles = document.querySelectorAll('.section-title');
    sectionTitles.forEach(title => {
        title.style.opacity = '0';
        title.style.transform = 'translateY(20px)';
        title.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        observer.observe(title);
    });

    // ボタンのリップルエフェクト
    const buttons = document.querySelectorAll('.section-button, .cta-button, .link-banner');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            // リップルエフェクトの要素を作成
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                left: ${x}px;
                top: ${y}px;
                transform: scale(0);
                animation: ripple 0.6s ease-out;
                pointer-events: none;
            `;
            
            // ボタンに相対位置を設定
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            
            this.appendChild(ripple);
            
            // アニメーション終了後にリップル要素を削除
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // フッターリンクのホバーエフェクト
    const footerLinks = document.querySelectorAll('.footer-nav li, .footer-links li');
    
    footerLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.color = '#E65D3E';
            this.style.transform = 'translateX(4px)';
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.color = '#ffffff';
            this.style.transform = 'translateX(0)';
        });
    });
});

// CSSアニメーションの定義を追加
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(2);
            opacity: 0;
        }
    }
    
    .section-dot {
        animation: pulse 2s infinite;
    }
    
`;
document.head.appendChild(style);

// Swiperの初期化
document.addEventListener('DOMContentLoaded', function() {
    // 他の初期化コードの後にSwiperを初期化
    setTimeout(() => {
        const partnerSwiper = new Swiper(".partner-swiper", {
          slidesPerView: 1,
          spaceBetween: 16,
          centeredSlides: true,
          loop: true,

          // ページネーション
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },

          // ナビゲーション
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },

          // レスポンシブ設定
          breakpoints: {
            390: {
              slidesPerView: 1,
              spaceBetween: 16,
            },
            768: {
              slidesPerView: 2,
              spaceBetween: 24,
            },
            1024: {
              slidesPerView: 3,
              spaceBetween: 80,
            },
          },

          // スクロールでの自動再生を無効化
          autoplay: false,
        });

        // Chef Swiperの初期化
        const chefSwiper = new Swiper(".chef-swiper", {
          slidesPerView: 3,
          spaceBetween: 40,
          centeredSlides: false,
          loop: true,

          // ページネーション
          pagination: {
            el: ".chef-grid .swiper-pagination",
            clickable: true,
          },

          // ナビゲーション
          navigation: {
            nextEl: ".chef-grid .swiper-button-next",
            prevEl: ".chef-grid .swiper-button-prev",
          },

          // レスポンシブ設定
          breakpoints: {
            320: {
              slidesPerView: 1,
              spaceBetween: 20,
            },
            768: {
              slidesPerView: 2,
              spaceBetween: 30,
            },
            1024: {
              slidesPerView: 3,
              spaceBetween: 40,
            },
          },

          // スクロールでの自動再生を無効化
          autoplay: false,
        });
    }, 100);
});

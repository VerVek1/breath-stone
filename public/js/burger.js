// Accessible burger menu: toggle nav drawer + overlay, close on Esc and link click
(function(){
  function init(){
    let burger = document.querySelector('.burger');
    let navList = document.querySelector('.nav-list');
    let overlay = document.querySelector('.menu-overlay');
    if (!overlay && navList){
      overlay = document.createElement('div');
      overlay.className = 'menu-overlay';
      document.body.appendChild(overlay);
    }
    if (!burger || !navList || !overlay) return;

    // ARIA for accessibility
    burger.setAttribute('aria-expanded', 'false');
    burger.setAttribute('aria-controls', 'main-menu');
    navList.setAttribute('id', 'main-menu');
    navList.setAttribute('role', 'menu');

    let openedAtMs = 0;
    function open(){
      navList.classList.add('open');
      burger.classList.add('open');
      overlay.classList.add('active');
      burger.setAttribute('aria-expanded', 'true');
      document.body.style.overflow='hidden';
      openedAtMs = Date.now();
    }
    function close(){
      if (openedAtMs && (Date.now() - openedAtMs) < 150) return; // ignore closes for 150ms after open
      navList.classList.remove('open');
      burger.classList.remove('open');
      overlay.classList.remove('active');
      burger.setAttribute('aria-expanded', 'false');
      document.body.style.overflow='';
    }
    function toggle(){ (navList.classList.contains('open') ? close : open)(); }

    // Кнопка закрытия внутри меню не используется — закрытие по бургеру/оверлею/ссылкам/ESC

    // Move header CTA button into mobile menu (no duplication)
    let headerBtn = document.querySelector('.header-btn');
    let ctaItem = null;
    let originalParent = null;
    let originalNext = null;
    if (headerBtn) {
      originalParent = headerBtn.parentNode;
      originalNext = headerBtn.nextSibling;
    }

    function attachCtaToMenu(){
      if (!headerBtn) return;
      if (!ctaItem) {
        ctaItem = document.createElement('li');
        ctaItem.className = 'menu-cta';
      }
      if (headerBtn.parentNode !== ctaItem) {
        ctaItem.appendChild(headerBtn);
      }
      if (!ctaItem.parentNode) {
        navList.appendChild(ctaItem);
      }
    }

    function restoreCtaToHeader(){
      if (!headerBtn || !originalParent) return;
      if (ctaItem && ctaItem.parentNode) ctaItem.parentNode.removeChild(ctaItem);
      if (originalNext && originalNext.parentNode === originalParent) {
        originalParent.insertBefore(headerBtn, originalNext);
      } else {
        originalParent.appendChild(headerBtn);
      }
    }

    // Click / Touch / Keyboard
    burger.addEventListener('click', toggle);
    burger.addEventListener('touchstart', function(){ toggle(); }, { passive: true });
    burger.addEventListener('keydown', function(e){
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggle();
      }
    });
    overlay.addEventListener('click', close);
    // Закрываем при клике по ссылке или кнопке из хедера внутри меню (reuse header actions)
    navList.addEventListener('click', function(e){
      let interactive = e.target.closest('a, button');
      if (interactive) close();
    });
    document.addEventListener('keydown', function(e){ if (e.key === 'Escape') close(); });

    // Ensure correct state on resize: desktop from 1061px to match layout
    let mql = window.matchMedia('(min-width: 1061px)');
    function handle(){
      if (mql.matches) {
        // desktop
        close();
        restoreCtaToHeader();
      } else {
        // mobile
        attachCtaToMenu();
      }
    }
    if (mql.addEventListener) mql.addEventListener('change', handle); else mql.addListener(handle);
    // initial attach based on current viewport
    handle();
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init); else init();
})();




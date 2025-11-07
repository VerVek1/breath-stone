(() => {
  const STORAGE_KEY = 'cookie_notice_accepted_v1';
  function hasAccepted() {
    try { return localStorage.getItem(STORAGE_KEY) === '1'; } catch (_) { return false; }
  }
  function setAccepted() {
    try { localStorage.setItem(STORAGE_KEY, '1'); } catch (_) {}
  }
  function show(el) { el.hidden = false; requestAnimationFrame(() => el.classList.add('is-visible')); }
  function hide(el) { el.classList.remove('is-visible'); el.addEventListener('transitionend', () => { el.hidden = true; }, { once: true }); }

  function init() {
    const banner = document.getElementById('cookie-notice');
    if (!banner) return;
    const acceptBtn = document.getElementById('cookie-accept');
    if (hasAccepted()) return; // do not show if already accepted
    show(banner);
    acceptBtn && acceptBtn.addEventListener('click', () => {
      setAccepted();
      hide(banner);
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();







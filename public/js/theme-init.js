// Early theme bootstrap: decide theme before CSS/HTML paint
(function(){
  let key = 'site_theme';
  let mql = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)');
  let pref = null;
  try { pref = localStorage.getItem(key); } catch(e) {}
  let theme = pref ? pref : (mql && mql.matches ? 'light' : 'dark');

  // Hide page and disable transitions until theme is fully applied
  document.documentElement.classList.add('theme-init');
  document.documentElement.classList.add('no-anim');

  // Apply to body as soon as it's available
  function applyToBody(){
    if (document.body){
      if (theme === 'light') document.body.classList.add('light');
    } else {
      document.addEventListener('DOMContentLoaded', applyToBody, { once: true });
    }
  }
  applyToBody();
})();























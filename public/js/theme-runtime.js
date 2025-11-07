// Runtime theme controller: toggling, sync across tabs, system follow when no pref
(function(){
  let key = 'site_theme';
  let mql = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)');

  function apply(theme){
    let isLight = theme === 'light';
    let b = document.body; if (b) b.classList.toggle('light', isLight);
    let btn = document.getElementById('themeToggle');
    if (btn){ btn.classList.toggle('on', isLight); btn.setAttribute('aria-pressed', String(isLight)); }
  }

  function resolved(){
    let pref = null; try { pref = localStorage.getItem(key); } catch(e) {}
    return pref ? pref : (mql && mql.matches ? 'light' : 'dark');
  }

  // Apply current and reveal page
  apply(resolved());
  requestAnimationFrame(function(){
    document.documentElement.classList.remove('no-anim');
    document.documentElement.classList.remove('theme-init');
  });

  // Listen system changes only if no manual pref
  let hasPref = false; try { hasPref = localStorage.getItem(key) !== null; } catch(e) {}
  if (!hasPref && mql){
    let handler = function(e){ apply(e.matches ? 'light' : 'dark'); };
    if (mql.addEventListener) mql.addEventListener('change', handler); else if (mql.addListener) mql.addListener(handler);
  }

  // Toggle
  window.addEventListener('DOMContentLoaded', function(){
    let btn = document.getElementById('themeToggle');
    if (!btn) return;
    btn.addEventListener('click', function(){
      let next = document.body.classList.contains('light') ? 'dark' : 'light';
      try { localStorage.setItem(key, next); } catch(e) {}
      apply(next);
    });
  });

  // Cross-tab sync and fix on history navigation
  window.addEventListener('storage', function(e){
    if (e.key === key) apply(e.newValue ? e.newValue : resolved());
  });
  window.addEventListener('pageshow', function(){ apply(resolved()); });
})();























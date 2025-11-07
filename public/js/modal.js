(function(){
  function init(){
    var modal = document.querySelector('[data-modal]');
    var modalOverlay = document.querySelector('[data-modal-overlay]');
    var openButtons = document.querySelectorAll('[data-modal-open], .header-btn');
    var closeButtons = document.querySelectorAll('[data-modal-close]');
    if (!modal || !modalOverlay) return;

    function open(){ modal.classList.add('open'); modalOverlay.classList.add('active'); document.body.style.overflow='hidden'; }
    function close(){ modal.classList.remove('open'); modalOverlay.classList.remove('active'); document.body.style.overflow=''; }

    openButtons.forEach(function(btn){ btn.addEventListener('click', function(e){ e.preventDefault(); open(); }); });
    closeButtons.forEach(function(btn){ btn.addEventListener('click', function(e){ e.preventDefault(); close(); }); });
    modalOverlay.addEventListener('click', close);

    // Close on Escape
    document.addEventListener('keydown', function(e){ if (e.key === 'Escape') close(); });
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init); else init();
})();



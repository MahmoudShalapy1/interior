/**
 * INTERIOR Atmosphere Preset Switcher (Section 12 White-Label System)
 * Toggles between Dark Noir, Limestone Light, and Bronze Gulf architectural palettes.
 *
 * @package Blockskit_Child
 */

(function() {
  'use strict';

  function initThemeSwitcher() {
    var savedTheme = localStorage.getItem('interior_theme') || 'noir';
    if (savedTheme !== 'noir') {
      document.documentElement.setAttribute('data-theme', savedTheme);
    }

    var buttons = document.querySelectorAll('.luxe-theme-btn');
    if (!buttons.length) return;

    function updateActiveState(activeTheme) {
      buttons.forEach(function(btn) {
        if (btn.getAttribute('data-theme-target') === activeTheme) {
          btn.classList.add('is-active');
        } else {
          btn.classList.remove('is-active');
        }
      });
    }

    updateActiveState(savedTheme);

    buttons.forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        var targetTheme = btn.getAttribute('data-theme-target') || 'noir';
        document.documentElement.setAttribute('data-theme', targetTheme);
        localStorage.setItem('interior_theme', targetTheme);
        updateActiveState(targetTheme);
      });
    });
  }

  // Register with InteriorApp
  if (window.InteriorApp) {
    window.InteriorApp.register('themeSwitcher', {
      init: initThemeSwitcher,
      destroy: function() {}
    });
  } else {
    document.addEventListener('DOMContentLoaded', initThemeSwitcher);
  }
})();

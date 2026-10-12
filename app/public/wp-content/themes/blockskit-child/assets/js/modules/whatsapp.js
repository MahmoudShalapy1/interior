/**
 * INTERIOR Module: Velvet Circular WhatsApp Action Ring
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var cleanupFns = [];

  function initWhatsApp() {
    var pill = document.querySelector('.luxe-whatsapp-float') || document.querySelector('.luxe-whatsapp-pill');
    if (!pill) return;

    // Hide when scrolling into private brief / modal
    var briefSection = document.getElementById('funnel');
    var observer = null;

    if (briefSection && 'IntersectionObserver' in window) {
      observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            pill.classList.add('is-hidden');
          } else {
            pill.classList.remove('is-hidden');
          }
        });
      }, { threshold: 0.1 });

      observer.observe(briefSection);
      cleanupFns.push(function () { observer.disconnect(); });
    }
  }

  function destroyWhatsApp() {
    cleanupFns.forEach(function (fn) { fn(); });
    cleanupFns = [];
  }

  if (window.InteriorApp) {
    window.InteriorApp.register('whatsapp', initWhatsApp, destroyWhatsApp);
  }
})();

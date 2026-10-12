/**
 * INTERIOR Architectural Master Controller
 * Initializes core registry, vendor sync, and registered modules
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  function initScrollReveal() {
    var revealElements = document.querySelectorAll('.luxe-reveal');
    if (!revealElements.length) return;

    if (!('IntersectionObserver' in window)) {
      revealElements.forEach(function (el) { el.classList.add('is-visible'); });
      return;
    }

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
        }
      });
    }, {
      threshold: 0.1,
      rootMargin: '0px 0px -40px 0px'
    });

    revealElements.forEach(function (el) {
      observer.observe(el);
    });
  }

  // Register reveal in global app
  if (window.InteriorApp) {
    window.InteriorApp.register('scrollReveal', initScrollReveal);
  }

  // Master Boot
  document.addEventListener('DOMContentLoaded', function () {
    if (window.InteriorApp) {
      window.InteriorApp.initAll();
    }
  });
})();

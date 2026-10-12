/**
 * INTERIOR Module: Studio Manifesto Word-by-Word Scroll Highlight (Section 7.2)
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var cleanupFns = [];

  function initManifesto() {
    var statement = document.querySelector('.luxe-manifesto__statement');
    if (!statement) return;

    var words = statement.querySelectorAll('.luxe-word');
    if (!words.length) return;

    function onScroll() {
      var rect = statement.getBoundingClientRect();
      var windowH = window.innerHeight;

      // Start highlighting when top enters 75% of viewport, finish by 30%
      var progress = (windowH * 0.75 - rect.top) / (rect.height + windowH * 0.45);
      progress = Math.max(0, Math.min(1, progress));

      var targetIndex = Math.floor(progress * words.length);

      words.forEach(function (word, idx) {
        if (idx <= targetIndex) {
          word.classList.add('is-highlighted');
        } else {
          word.classList.remove('is-highlighted');
        }
      });
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll(); // Initial check

    cleanupFns.push(function () {
      window.removeEventListener('scroll', onScroll);
    });
  }

  function destroyManifesto() {
    cleanupFns.forEach(function (fn) { fn(); });
    cleanupFns = [];
  }

  if (window.InteriorApp) {
    window.InteriorApp.register('manifesto', initManifesto, destroyManifesto);
  }
})();

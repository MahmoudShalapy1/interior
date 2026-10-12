/**
 * INTERIOR Module: Monumental Numeric Counter (Section 7.4)
 * Smooth Eased Count-Up upon Entering Viewport
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var cleanupFns = [];

  function initCounter() {
    var statSection = document.getElementById('scale');
    if (!statSection) return;

    var numElements = statSection.querySelectorAll('[data-counter]');
    if (!numElements.length) return;

    var hasAnimated = false;

    function animateNumbers() {
      if (hasAnimated) return;
      hasAnimated = true;

      numElements.forEach(function (el) {
        var rawText = (el.textContent || '').trim();
        var prefix = el.getAttribute('data-prefix') || (rawText.startsWith('+') ? '+' : '');
        var suffix = el.getAttribute('data-suffix') || (rawText.endsWith('%') ? '%' : '');
        var targetAttr = el.getAttribute('data-counter');
        var target = parseFloat(targetAttr) || parseFloat(rawText.replace(/[^\d.]/g, '')) || 0;
        var isInt = Number.isInteger(target);
        var duration = 2000;
        var start = 0;
        var startTime = null;

        function step(timestamp) {
          if (!startTime) startTime = timestamp;
          var progress = Math.min((timestamp - startTime) / duration, 1);
          // Easing out quint
          var easeProgress = 1 - Math.pow(1 - progress, 5);
          var currentVal = start + (target - start) * easeProgress;

          var formatted = isInt
            ? Math.floor(currentVal).toLocaleString('en-US')
            : currentVal.toFixed(1);

          el.textContent = prefix + formatted + suffix;

          if (progress < 1) {
            requestAnimationFrame(step);
          } else {
            var finalFormatted = isInt
              ? target.toLocaleString('en-US')
              : target.toString();
            el.textContent = prefix + finalFormatted + suffix;
          }
        }

        requestAnimationFrame(step);
      });
    }

    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            animateNumbers();
            observer.disconnect();
          }
        });
      }, { threshold: 0.25 });

      observer.observe(statSection);
      cleanupFns.push(function () { observer.disconnect(); });
    } else {
      animateNumbers();
    }
  }

  function destroyCounter() {
    cleanupFns.forEach(function (fn) { fn(); });
    cleanupFns = [];
  }

  if (window.InteriorApp) {
    window.InteriorApp.register('counter', initCounter, destroyCounter);
  }
})();

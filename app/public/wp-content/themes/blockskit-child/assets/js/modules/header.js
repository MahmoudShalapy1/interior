/**
 * INTERIOR Module: Adaptive Smart Header & Progress Bar
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var lastScrollTop = 0;
  var threshold = 80;
  var scrollHandler = null;
  var observer = null;

  function initHeader() {
    var header = document.querySelector('.luxe-header');
    var progressBar = document.getElementById('luxe-scroll-progress');
    if (!header) return;

    // 1. Scroll Direction & Progress Handler
    scrollHandler = function () {
      var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

      // Update progress bar
      if (progressBar) {
        var docHeight = document.documentElement.scrollHeight - window.innerHeight;
        var percent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        progressBar.style.width = percent + '%';
      }

      // Add solid scrolled class if past top
      if (scrollTop > 40) {
        header.classList.add('is-scrolled');
      } else {
        header.classList.remove('is-scrolled');
      }

      // Hide on scroll down, show on scroll up
      if (scrollTop > threshold) {
        if (scrollTop > lastScrollTop && scrollTop - lastScrollTop > 10) {
          // Scrolling down
          header.classList.add('is-hidden');
          header.classList.remove('is-visible');
        } else if (lastScrollTop - scrollTop > 8) {
          // Scrolling up
          header.classList.remove('is-hidden');
          header.classList.add('is-visible');
        }
      } else {
        header.classList.remove('is-hidden');
        header.classList.add('is-visible');
      }

      lastScrollTop = Math.max(0, scrollTop);
    };

    window.addEventListener('scroll', scrollHandler, { passive: true });

    // 2. Light Section Detection (Color Adaptation)
    var lightSections = document.querySelectorAll('.luxe-section--limestone, [data-tone="light"]');
    if (lightSections.length && 'IntersectionObserver' in window) {
      observer = new IntersectionObserver(function (entries) {
        var isAnyLightIntersecting = false;
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            isAnyLightIntersecting = true;
          }
        });

        if (isAnyLightIntersecting) {
          header.classList.add('is-over-light');
        } else {
          header.classList.remove('is-over-light');
        }
      }, {
        threshold: 0.1,
        rootMargin: '-5% 0px -90% 0px'
      });

      lightSections.forEach(function (sec) {
        observer.observe(sec);
      });
    }
  }

  function destroyHeader() {
    if (scrollHandler) {
      window.removeEventListener('scroll', scrollHandler);
      scrollHandler = null;
    }
    if (observer) {
      observer.disconnect();
      observer = null;
    }
  }

  // Register in global app registry
  if (window.InteriorApp) {
    window.InteriorApp.register('header', initHeader, destroyHeader);
  }
})();

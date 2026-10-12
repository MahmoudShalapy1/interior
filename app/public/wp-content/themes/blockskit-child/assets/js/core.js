/**
 * INTERIOR Core Animation & State Engine
 * Local Lenis Smooth Scroll + GSAP ScrollTrigger + Module Lifecycle System
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  // Global App Registry
  window.InteriorApp = window.InteriorApp || {
    modules: {},
    lenis: null,
    isReducedMotion: window.matchMedia('(prefers-reduced-motion: reduce)').matches,

    /**
     * Register an interactive module with init and optional destroy lifecycle hooks
     */
    register: function (name, initFn, destroyFn) {
      var actualInit = (typeof initFn === 'function') ? initFn : (initFn && typeof initFn.init === 'function' ? initFn.init : function () {});
      var actualDestroy = destroyFn || (initFn && typeof initFn.destroy === 'function' ? initFn.destroy : function () {});
      this.modules[name] = {
        init: actualInit,
        destroy: actualDestroy,
        active: false
      };
    },

    /**
     * Initialize all registered modules
     */
    initAll: function () {
      var self = this;
      Object.keys(this.modules).forEach(function (name) {
        var mod = self.modules[name];
        try {
          if (!mod.active) {
            mod.init();
            mod.active = true;
          }
        } catch (e) {
          console.warn('[InteriorApp] Error initializing module:', name, e);
        }
      });

      // Refresh ScrollTrigger after all elements are initialized
      if (typeof ScrollTrigger !== 'undefined') {
        ScrollTrigger.refresh();
      }
    },

    /**
     * Destroy all registered modules (called before page transition)
     */
    destroyAll: function () {
      var self = this;
      Object.keys(this.modules).forEach(function (name) {
        var mod = self.modules[name];
        try {
          if (mod.active) {
            mod.destroy();
            mod.active = false;
          }
        } catch (e) {
          console.warn('[InteriorApp] Error destroying module:', name, e);
        }
      });

      // Kill orphaned ScrollTriggers
      if (typeof ScrollTrigger !== 'undefined') {
        ScrollTrigger.getAll().forEach(function (st) {
          st.kill();
        });
      }
    },

    /**
     * Initialize Smooth Scroll with Lenis and sync with GSAP
     */
    initScroll: function () {
      if (this.isReducedMotion) return;
      if (typeof Lenis === 'undefined') return;

      var self = this;
      this.lenis = new Lenis({
        duration: 0.75,
        easing: function (t) {
          return Math.min(1, 1.001 - Math.pow(2, -10 * t));
        },
        direction: 'vertical',
        gestureDirection: 'vertical',
        smoothWheel: true,
        smoothTouch: false,
        wheelMultiplier: 1.15,
        touchMultiplier: 1.5
      });

      // Connect Lenis to GSAP ScrollTrigger if available
      if (typeof ScrollTrigger !== 'undefined' && typeof gsap !== 'undefined') {
        this.lenis.on('scroll', ScrollTrigger.update);

        gsap.ticker.add(function (time) {
          self.lenis.raf(time * 1000);
        });

        gsap.ticker.lagSmoothing(0);
      } else {
        function raf(time) {
          self.lenis.raf(time);
          requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);
      }
    },

    /**
     * Smooth scroll to target element or position
     */
    scrollTo: function (target, offset) {
      var off = offset || 0;
      if (this.lenis) {
        this.lenis.scrollTo(target, { offset: off, duration: 1.4 });
      } else {
        var el = typeof target === 'string' ? document.querySelector(target) : target;
        if (el) {
          var y = el.getBoundingClientRect().top + window.pageYOffset + off;
          window.scrollTo({ top: y, behavior: 'smooth' });
        }
      }
    }
  };

  // Auto-init core on DOM ready
  document.addEventListener('DOMContentLoaded', function () {
    window.InteriorApp.initScroll();
  });
})();

/**
 * INTERIOR Module: Architectural Page Transitions & Lifecycle Synchronization
 * Dual Ink Curtain Slices + Brand Emblem + init()/destroy() Synchronization
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var isTransitioning = false;

  function initTransitions() {
    var curtain = document.getElementById('luxe-transition-curtain');
    if (!curtain) {
      curtain = document.createElement('div');
      curtain.id = 'luxe-transition-curtain';
      curtain.className = 'luxe-transition-curtain';
      curtain.innerHTML = 
        '<div class="luxe-transition-slice"></div>' +
        '<div class="luxe-transition-slice"></div>' +
        '<div class="luxe-transition-emblem">' +
          '<div class="luxe-transition-emblem__logo">INTERIOR</div>' +
          '<div class="luxe-transition-emblem__line"></div>' +
        '</div>';
      document.body.appendChild(curtain);
    }

    function scrollToHashTarget(hash) {
      if (!hash || hash === '#') return false;
      var targetEl = null;
      try {
        targetEl = document.querySelector(hash) || document.getElementById(decodeURIComponent(hash.slice(1)));
      } catch (err) {
        targetEl = document.getElementById(hash.slice(1));
      }
      if (!targetEl) return false;

      if (window.InteriorApp && typeof window.InteriorApp.scrollTo === 'function') {
        window.InteriorApp.scrollTo(targetEl, -90);
      } else {
        targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
      return true;
    }

    // Intercept internal navigation links
    function interceptLinks(e) {
      var link = e.target.closest('a');
      if (!link) return;

      var href = link.getAttribute('href');
      if (!href) return;

      // Skip external protocols, new tabs, downloads, and language switchers
      if (href.startsWith('mailto:') || href.startsWith('tel:') || href.startsWith('javascript:')) return;
      if (link.getAttribute('target') === '_blank' || link.hasAttribute('download')) return;
      if (link.closest('.luxe-lang-btn') || link.classList.contains('luxe-lang-btn')) return;

      // Pure in-page hash links (e.g. #funnel, #brief-funnel, #story)
      if (href.startsWith('#')) {
        if (href.length > 1 && scrollToHashTarget(href)) {
          e.preventDefault();
          if (window.history && window.history.replaceState) {
            window.history.replaceState(null, '', href);
          }
        }
        return;
      }

      var currentOrigin = window.location.origin;
      var url;
      try {
        url = new URL(href, window.location.href);
      } catch (err) {
        return;
      }

      if (url.origin !== currentOrigin) return;
      if (url.pathname.indexOf('/wp-admin') !== -1 || url.pathname.indexOf('/wp-login') !== -1) return;

      var normTargetPath  = url.pathname.replace(/\/+$/, '') || '/';
      var normCurrentPath = window.location.pathname.replace(/\/+$/, '') || '/';

      // Same-page navigation (with or without hash)
      if (normTargetPath === normCurrentPath) {
        if (url.hash && scrollToHashTarget(url.hash)) {
          e.preventDefault();
          if (window.history && window.history.replaceState) {
            window.history.replaceState(null, '', url.href);
          }
          return;
        }
        // If clicking the header consultation CTA while already on /contact/, scroll to #brief-funnel
        if (link.classList.contains('luxe-header-cta') && scrollToHashTarget('#brief-funnel')) {
          e.preventDefault();
          return;
        }
        if (url.href === window.location.href) return;
      }

      // Allow full page reload when switching between Arabic and English (mandatory for clean RTL/LTR layout)
      var isCurrentEn = (window.location.pathname.indexOf('/en/') === 0 || window.location.pathname === '/en');
      var isTargetEn  = (url.pathname.indexOf('/en/') === 0 || url.pathname === '/en');
      if (isCurrentEn !== isTargetEn) return;

      e.preventDefault();
      navigateTo(url.href);
    }

    document.addEventListener('click', interceptLinks);

    // Popstate (Browser Back/Forward)
    window.addEventListener('popstate', function () {
      navigateTo(window.location.href, true);
    });

    function navigateTo(url, isPopstate) {
      if (isTransitioning) return;
      isTransitioning = true;

      var parsedTarget;
      try {
        parsedTarget = new URL(url, window.location.origin);
      } catch (e) {
        parsedTarget = { pathname: '/', hash: '' };
      }

      // Close curtain menu if open
      var openMenu = document.getElementById('luxe-curtain-menu');
      if (openMenu && openMenu.classList.contains('is-open')) {
        openMenu.classList.remove('is-open');
        document.body.style.overflow = '';
      }

      // 1. Close transition curtain
      curtain.classList.add('is-transitioning');

      // 2. Destroy active modules and ScrollTriggers
      if (window.InteriorApp) {
        window.InteriorApp.destroyAll();
      }

      setTimeout(function () {
        fetch(url)
          .then(function (res) {
            if (!res.ok) throw new Error('Network response error');
            return res.text();
          })
          .then(function (html) {
            var parser = new DOMParser();
            var doc = parser.parseFromString(html, 'text/html');

            // Replace Document Title
            document.title = doc.title;

            // Replace Main Content Container
            var newMain = doc.querySelector('#primary') || doc.querySelector('main');
            var currentMain = document.querySelector('#primary') || document.querySelector('main');

            if (newMain && currentMain) {
              currentMain.innerHTML = newMain.innerHTML;
              currentMain.className = newMain.className;
            } else {
              window.location.href = url;
              return;
            }

            // Update History State
            if (!isPopstate) {
              window.history.pushState({}, '', url);
            }

            // Update Active Nav Link States
            var currentPath = parsedTarget.pathname;
            document.querySelectorAll('.luxe-nav-link, .luxe-curtain-nav__item').forEach(function (navItem) {
              var nHref = navItem.getAttribute('href');
              if (!nHref) return;
              try {
                var navPath = new URL(nHref, window.location.origin).pathname;
                if (navPath === currentPath) {
                  navItem.classList.add('is-active');
                } else {
                  navItem.classList.remove('is-active');
                }
              } catch (err) {}
            });

            // Scroll to Hash Target or Top
            if (parsedTarget.hash && scrollToHashTarget(parsedTarget.hash)) {
              // Scrolled to target hash
            } else if (window.InteriorApp && window.InteriorApp.lenis) {
              window.InteriorApp.lenis.scrollTo(0, { immediate: true });
            } else {
              window.scrollTo(0, 0);
            }

            // 3. Re-initialize all modules
            setTimeout(function () {
              if (window.InteriorApp) {
                window.InteriorApp.initAll();
              }

              // 4. Open curtain
              setTimeout(function () {
                curtain.classList.remove('is-transitioning');
                isTransitioning = false;
              }, 250);
            }, 100);
          })
          .catch(function (err) {
            console.warn('[InteriorApp] Page transition fallback to native load:', err);
            window.location.href = url;
          });
      }, 550);
    }
  }

  function destroyTransitions() {
    // Persistent across sessions
  }

  if (window.InteriorApp) {
    window.InteriorApp.register('transitions', initTransitions, destroyTransitions);
  }
})();

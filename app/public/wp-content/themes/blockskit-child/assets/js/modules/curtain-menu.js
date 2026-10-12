/**
 * INTERIOR Module: Full-screen Curtain Menu & Hover Image Preview
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var cleanupFns = [];

  function initCurtainMenu() {
    var menu = document.getElementById('luxe-curtain-menu');
    var triggers = document.querySelectorAll('.luxe-mobile-toggle, #luxe-menu-trigger');
    var closeBtn = document.querySelector('.luxe-curtain-menu__close');
    var navItems = document.querySelectorAll('.luxe-curtain-nav__item');
    var preview = document.getElementById('luxe-curtain-preview');
    var previewImg = preview ? preview.querySelector('img') : null;

    if (!menu) return;

    // Open/Close Handlers
    function openMenu() {
      menu.classList.add('is-active');
      document.body.style.overflow = 'hidden';
      if (window.InteriorApp && window.InteriorApp.lenis) {
        window.InteriorApp.lenis.stop();
      }
    }

    function closeMenu() {
      menu.classList.remove('is-active');
      document.body.style.overflow = '';
      if (preview) preview.classList.remove('is-visible');
      if (window.InteriorApp && window.InteriorApp.lenis) {
        window.InteriorApp.lenis.start();
      }
    }

    triggers.forEach(function (btn) {
      btn.addEventListener('click', openMenu);
      cleanupFns.push(function () { btn.removeEventListener('click', openMenu); });
    });

    if (closeBtn) {
      closeBtn.addEventListener('click', closeMenu);
      cleanupFns.push(function () { closeBtn.removeEventListener('click', closeMenu); });
    }

    // Escape Key Handler
    function handleKey(e) {
      if (e.key === 'Escape' && menu.classList.contains('is-active')) {
        closeMenu();
      }
    }
    window.addEventListener('keydown', handleKey);
    cleanupFns.push(function () { window.removeEventListener('keydown', handleKey); });

    // Hover Image Preview Follower
    if (preview && previewImg && window.matchMedia('(pointer: fine)').matches) {
      var currentX = 0, currentY = 0;
      var targetX = 0, targetY = 0;
      var animId = null;

      function renderPreview() {
        currentX += (targetX - currentX) * 0.12;
        currentY += (targetY - currentY) * 0.12;
        preview.style.left = currentX + 'px';
        preview.style.top = currentY + 'px';
        animId = requestAnimationFrame(renderPreview);
      }
      animId = requestAnimationFrame(renderPreview);

      navItems.forEach(function (item) {
        var imgSrc = item.getAttribute('data-preview');

        function onMouseEnter(e) {
          if (imgSrc) {
            previewImg.src = imgSrc;
            preview.classList.add('is-visible');
            targetX = e.clientX + 30;
            targetY = e.clientY - 160;
          }
        }

        function onMouseMove(e) {
          targetX = e.clientX + 30;
          targetY = e.clientY - 160;
        }

        function onMouseLeave() {
          preview.classList.remove('is-visible');
        }

        function onClick() {
          closeMenu();
        }

        item.addEventListener('mouseenter', onMouseEnter);
        item.addEventListener('mousemove', onMouseMove);
        item.addEventListener('mouseleave', onMouseLeave);
        item.addEventListener('click', onClick);

        cleanupFns.push(function () {
          item.removeEventListener('mouseenter', onMouseEnter);
          item.removeEventListener('mousemove', onMouseMove);
          item.removeEventListener('mouseleave', onMouseLeave);
          item.removeEventListener('click', onClick);
        });
      });

      cleanupFns.push(function () {
        if (animId) cancelAnimationFrame(animId);
      });
    }
  }

  function destroyCurtainMenu() {
    cleanupFns.forEach(function (fn) { fn(); });
    cleanupFns = [];
    document.body.style.overflow = '';
  }

  if (window.InteriorApp) {
    window.InteriorApp.register('curtainMenu', initCurtainMenu, destroyCurtainMenu);
  }
})();

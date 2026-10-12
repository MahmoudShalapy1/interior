/**
 * INTERIOR Module: Hero Blueprint Reveal Lens (Section 7.1 — Wow #1)
 * Interactive CAD Wireframe Reveal with Smooth Interpolation
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var cleanupFns = [];
  var animId = null;

  function initHeroLens() {
    var hero = document.getElementById('hero');
    if (!hero) return;

    var wireframe = hero.querySelector('.luxe-hero__wireframe');
    var lensRing = hero.querySelector('.luxe-hero__lens-ring');
    if (!wireframe || !lensRing) return;

    var rect = hero.getBoundingClientRect();
    var targetX = rect.width / 2;
    var targetY = rect.height / 2;
    var currentX = targetX;
    var currentY = targetY;
    var isHovering = false;
    var autoAngle = 0;

    function onMouseMove(e) {
      rect = hero.getBoundingClientRect();
      if (e.clientY >= rect.top && e.clientY <= rect.bottom) {
        isHovering = true;
        targetX = e.clientX - rect.left;
        targetY = e.clientY - rect.top;
      } else {
        isHovering = false;
      }
    }

    function onTouchMove(e) {
      if (e.touches.length) {
        rect = hero.getBoundingClientRect();
        isHovering = true;
        targetX = e.touches[0].clientX - rect.left;
        targetY = e.touches[0].clientY - rect.top;
      }
    }

    window.addEventListener('mousemove', onMouseMove, { passive: true });
    hero.addEventListener('touchmove', onTouchMove, { passive: true });

    cleanupFns.push(function () {
      window.removeEventListener('mousemove', onMouseMove);
      hero.removeEventListener('touchmove', onTouchMove);
    });

    // Render loop
    function updateLens() {
      rect = hero.getBoundingClientRect();

      // If user is not interacting, subtle hypnotic figure-eight drift
      if (!isHovering) {
        autoAngle += 0.012;
        targetX = (rect.width / 2) + Math.cos(autoAngle) * (rect.width * 0.18);
        targetY = (rect.height / 2) + Math.sin(autoAngle * 2) * (rect.height * 0.12);
      }

      currentX += (targetX - currentX) * 0.14;
      currentY += (targetY - currentY) * 0.14;

      // Update wireframe clip-path CSS variables
      wireframe.style.setProperty('--lens-x', currentX + 'px');
      wireframe.style.setProperty('--lens-y', currentY + 'px');

      // Update lens ring position
      lensRing.style.left = currentX + 'px';
      lensRing.style.top = currentY + 'px';

      animId = requestAnimationFrame(updateLens);
    }

    animId = requestAnimationFrame(updateLens);
    cleanupFns.push(function () {
      if (animId) cancelAnimationFrame(animId);
    });

    // Preloader Dismissal Listener
    var preloader = document.getElementById('luxe-preloader');
    var skipBtn = document.querySelector('.luxe-preloader__skip');

    function dismissPreloader() {
      if (preloader) {
        preloader.classList.add('is-loaded');
        sessionStorage.setItem('luxe_preloaded', 'true');
      }
    }

    if (preloader) {
      if (sessionStorage.getItem('luxe_preloaded') === 'true') {
        preloader.classList.add('is-loaded');
      } else {
        setTimeout(dismissPreloader, 2800);
        if (skipBtn) {
          skipBtn.addEventListener('click', dismissPreloader);
          cleanupFns.push(function () { skipBtn.removeEventListener('click', dismissPreloader); });
        }
      }
    }
  }

  function destroyHeroLens() {
    cleanupFns.forEach(function (fn) { fn(); });
    cleanupFns = [];
  }

  if (window.InteriorApp) {
    window.InteriorApp.register('heroLens', initHeroLens, destroyHeroLens);
  }
})();

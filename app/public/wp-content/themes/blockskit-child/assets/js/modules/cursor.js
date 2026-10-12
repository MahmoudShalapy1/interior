/**
 * INTERIOR Module: Custom Magnetic Cursor & Hero Architectural Measuring
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var animId = null;
  var listeners = [];

  function initCursor() {
    if (!window.matchMedia('(pointer: fine)').matches) return;

    var dot = document.getElementById('luxe-cursor-dot');
    var ring = document.getElementById('luxe-cursor-ring');

    if (!dot || !ring) return;

    var ringSpan = ring.querySelector('span');
    if (!ringSpan) {
      ringSpan = document.createElement('span');
      ring.appendChild(ringSpan);
    }

    // Clean up any lingering coords element
    var existingCoords = document.getElementById('luxe-cursor-coords');
    if (existingCoords) {
      existingCoords.remove();
    }

    var mouseX = window.innerWidth / 2;
    var mouseY = window.innerHeight / 2;
    var ringX = mouseX;
    var ringY = mouseY;

    function onMouseMove(e) {
      mouseX = e.clientX;
      mouseY = e.clientY;

      dot.style.transform = 'translate(' + mouseX + 'px, ' + mouseY + 'px)';
    }
    window.addEventListener('mousemove', onMouseMove, { passive: true });
    listeners.push(function () { window.removeEventListener('mousemove', onMouseMove); });

    function renderRing() {
      ringX += (mouseX - ringX) * 0.18;
      ringY += (mouseY - ringY) * 0.18;
      ring.style.transform = 'translate(' + ringX + 'px, ' + ringY + 'px)';
      animId = requestAnimationFrame(renderRing);
    }
    animId = requestAnimationFrame(renderRing);

    // Interactive Hover States
    function bindInteractions() {
      // 1. Buttons (Magnetic Attraction)
      var buttons = document.querySelectorAll('.luxe-btn, .luxe-control-pill, .luxe-mobile-toggle');
      buttons.forEach(function (btn) {
        function onBtnEnter() {
          document.body.classList.add('is-hovering');
        }
        function onBtnMove(e) {
          var bRect = btn.getBoundingClientRect();
          var relX = e.clientX - (bRect.left + bRect.width / 2);
          var relY = e.clientY - (bRect.top + bRect.height / 2);
          btn.style.transform = 'translate(' + (relX * 0.22) + 'px, ' + (relY * 0.22) + 'px)';
        }
        function onBtnLeave() {
          document.body.classList.remove('is-hovering');
          btn.style.transform = '';
        }
        btn.addEventListener('mouseenter', onBtnEnter);
        btn.addEventListener('mousemove', onBtnMove);
        btn.addEventListener('mouseleave', onBtnLeave);
        listeners.push(function () {
          btn.removeEventListener('mouseenter', onBtnEnter);
          btn.removeEventListener('mousemove', onBtnMove);
          btn.removeEventListener('mouseleave', onBtnLeave);
        });
      });

      // 2. Explore / Drag Areas (Project cards, gallery)
      var exploreCards = document.querySelectorAll('.luxe-card, .luxe-project-card, .luxe-frame, [data-cursor="explore"]');
      exploreCards.forEach(function (card) {
        function onCardEnter() {
          document.body.classList.add('is-cursor-explore');
          var isEn = document.documentElement.getAttribute('dir') === 'ltr' || (window.InteriorI18n && window.InteriorI18n.getCurrentLang() === 'en');
          ringSpan.textContent = isEn ? 'EXPLORE' : 'استكشف';
        }
        function onCardLeave() {
          document.body.classList.remove('is-cursor-explore');
          ringSpan.textContent = '';
        }
        card.addEventListener('mouseenter', onCardEnter);
        card.addEventListener('mouseleave', onCardLeave);
        listeners.push(function () {
          card.removeEventListener('mouseenter', onCardEnter);
          card.removeEventListener('mouseleave', onCardLeave);
        });
      });

      // 3. Links general hover
      var links = document.querySelectorAll('a:not(.luxe-btn), button:not(.luxe-btn)');
      links.forEach(function (link) {
        function onLinkEnter() { document.body.classList.add('is-hovering'); }
        function onLinkLeave() { document.body.classList.remove('is-hovering'); }
        link.addEventListener('mouseenter', onLinkEnter);
        link.addEventListener('mouseleave', onLinkLeave);
        listeners.push(function () {
          link.removeEventListener('mouseenter', onLinkEnter);
          link.removeEventListener('mouseleave', onLinkLeave);
        });
      });
    }

    bindInteractions();
  }

  function destroyCursor() {
    if (animId) cancelAnimationFrame(animId);
    listeners.forEach(function (fn) { fn(); });
    listeners = [];
    document.body.classList.remove('is-hovering', 'is-cursor-explore', 'is-cursor-video', 'is-in-hero');
  }

  if (window.InteriorApp) {
    window.InteriorApp.register('cursor', initCursor, destroyCursor);
  }
})();

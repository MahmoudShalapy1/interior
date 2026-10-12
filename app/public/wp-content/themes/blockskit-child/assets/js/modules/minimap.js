/**
 * INTERIOR Module: Floor-plan Minimap (خريطة الفيلا المصغّرة)
 * Architectural Villa SVG Navigation with Active Room Illumination
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var cleanupFns = [];
  var observer = null;

  function initMinimap() {
    var minimap = document.getElementById('luxe-minimap');
    if (!minimap) return;

    var rooms = minimap.querySelectorAll('.luxe-minimap__room');
    var tooltip = minimap.querySelector('.luxe-minimap__tooltip');

    if (!rooms.length) return;

    // Room Click Navigation
    rooms.forEach(function (room) {
      var targetId = room.getAttribute('data-target');
      var roomName = room.getAttribute('data-name') || '';

      function onClick(e) {
        e.preventDefault();
        if (targetId && window.InteriorApp) {
          window.InteriorApp.scrollTo(targetId, -40);
        }
      }

      function onEnter() {
        if (tooltip && roomName) {
          tooltip.textContent = roomName;
          tooltip.classList.add('is-visible');
        }
      }

      function onLeave() {
        if (tooltip) {
          tooltip.classList.remove('is-visible');
        }
      }

      room.addEventListener('click', onClick);
      room.addEventListener('mouseenter', onEnter);
      room.addEventListener('mouseleave', onLeave);

      cleanupFns.push(function () {
        room.removeEventListener('click', onClick);
        room.removeEventListener('mouseenter', onEnter);
        room.removeEventListener('mouseleave', onLeave);
      });
    });

    // Scroll Observer: Active Room Illumination
    if ('IntersectionObserver' in window) {
      observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            var id = '#' + entry.target.id;
            rooms.forEach(function (r) {
              if (r.getAttribute('data-target') === id) {
                r.classList.add('is-active');
              } else {
                r.classList.remove('is-active');
              }
            });
          }
        });
      }, {
        threshold: 0.25,
        rootMargin: '-20% 0px -40% 0px'
      });

      rooms.forEach(function (room) {
        var tid = room.getAttribute('data-target');
        if (tid) {
          var targetEl = document.querySelector(tid);
          if (targetEl) {
            observer.observe(targetEl);
          }
        }
      });
    }
  }

  function destroyMinimap() {
    cleanupFns.forEach(function (fn) { fn(); });
    cleanupFns = [];
    if (observer) {
      observer.disconnect();
      observer = null;
    }
  }

  if (window.InteriorApp) {
    window.InteriorApp.register('minimap', initMinimap, destroyMinimap);
  }
})();

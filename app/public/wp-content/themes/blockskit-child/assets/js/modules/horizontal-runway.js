/**
 * INTERIOR Module: Horizontal Curated Runway RTL (Section 7.6)
 * Smooth Inertial RTL Runway Navigation
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var cleanupFns = [];

  function initRunway() {
    var runway = document.getElementById('runway');
    if (!runway) return;

    var viewport = runway.querySelector('.luxe-runway-viewport');
    if (!viewport) return;

    var isDown = false;
    var startX = 0;
    var scrollLeft = 0;

    function onMouseDown(e) {
      isDown = true;
      viewport.classList.add('is-dragging');
      startX = e.pageX - viewport.offsetLeft;
      scrollLeft = viewport.scrollLeft;
    }

    function onMouseLeave() {
      isDown = false;
      viewport.classList.remove('is-dragging');
    }

    function onMouseUp() {
      isDown = false;
      viewport.classList.remove('is-dragging');
    }

    function onMouseMove(e) {
      if (!isDown) return;
      e.preventDefault();
      var x = e.pageX - viewport.offsetLeft;
      var walk = (x - startX) * 1.6; // Scroll speed multiplier
      viewport.scrollLeft = scrollLeft - walk;
    }

    // Wheel horizontal translation when hovering runway
    function onWheel(e) {
      if (Math.abs(e.deltaY) > Math.abs(e.deltaX) && Math.abs(e.deltaY) > 20) {
        var maxScroll = viewport.scrollWidth - viewport.clientWidth;
        var current = Math.abs(viewport.scrollLeft);

        // If not at the very ends, intercept and scroll runway horizontally
        if ((e.deltaY > 0 && current < maxScroll - 10) || (e.deltaY < 0 && current > 10)) {
          // Translate deltaY into horizontal scroll
          viewport.scrollLeft += (e.deltaY * 0.85);
        }
      }
    }

    viewport.addEventListener('mousedown', onMouseDown);
    viewport.addEventListener('mouseleave', onMouseLeave);
    viewport.addEventListener('mouseup', onMouseUp);
    viewport.addEventListener('mousemove', onMouseMove);
    viewport.addEventListener('wheel', onWheel, { passive: true });

    cleanupFns.push(function () {
      viewport.removeEventListener('mousedown', onMouseDown);
      viewport.removeEventListener('mouseleave', onMouseLeave);
      viewport.removeEventListener('mouseup', onMouseUp);
      viewport.removeEventListener('mousemove', onMouseMove);
      viewport.removeEventListener('wheel', onWheel);
    });
  }

  function destroyRunway() {
    cleanupFns.forEach(function (fn) { fn(); });
    cleanupFns = [];
  }

  if (window.InteriorApp) {
    window.InteriorApp.register('runway', initRunway, destroyRunway);
  }
})();

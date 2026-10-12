/**
 * INTERIOR Module: 3-Stage Before / After Comparison Slider (Section 7.8)
 * Concrete Site -> BIM Proposal -> Delivered Reality
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var cleanupFns = [];

  function initCompareSlider() {
    var compareSection = document.getElementById('compare');
    if (!compareSection) return;

    var viewport = compareSection.querySelector('#luxe-compare-viewport') || compareSection.querySelector('.luxe-compare-viewport');
    var layer1 = compareSection.querySelector('#luxe-layer-stage1') || compareSection.querySelector('.luxe-compare-layer--stage1');
    var layer2 = compareSection.querySelector('#luxe-layer-stage2') || compareSection.querySelector('.luxe-compare-layer--stage2');
    var layer3 = compareSection.querySelector('#luxe-layer-stage3') || compareSection.querySelector('.luxe-compare-layer--stage3');

    var handle1 = compareSection.querySelector('#luxe-compare-handle-1') || compareSection.querySelector('.luxe-compare-handle:first-of-type');
    var handle2 = compareSection.querySelector('#luxe-compare-handle-2') || compareSection.querySelector('.luxe-compare-handle:last-of-type');

    var pill1 = compareSection.querySelector('.luxe-compare-pill--stage1');
    var pill2 = compareSection.querySelector('.luxe-compare-pill--stage2');
    var pill3 = compareSection.querySelector('.luxe-compare-pill--stage3');

    if (!viewport || !layer1 || !layer2 || !layer3 || !handle1 || !handle2) return;

    // Current positions in percentages (from left: 0 to 100)
    var pos1 = 33.33; // Left handle
    var pos2 = 66.66; // Right handle
    var activeHandle = null;

    function isRtl() {
      return document.documentElement.getAttribute('dir') === 'rtl';
    }

    function applyPositions() {
      var p1 = Math.round(pos1 * 100) / 100;
      var p2 = Math.round(pos2 * 100) / 100;
      var rtl = isRtl();

      // Update handle positions
      handle1.style.left = p1 + '%';
      handle2.style.left = p2 + '%';

      handle1.setAttribute('aria-valuenow', Math.round(p1));
      handle2.setAttribute('aria-valuenow', Math.round(p2));

      if (rtl) {
        // Arabic RTL:
        // Left side (0% -> p1): Stage 3 (Delivered Reality)
        // Middle side (p1 -> p2): Stage 2 (BIM 3D Model)
        // Right side (p2 -> 100%): Stage 1 (Raw Concrete)
        layer3.style.clipPath = 'polygon(0% 0%, ' + p1 + '% 0%, ' + p1 + '% 100%, 0% 100%)';
        layer3.style.webkitClipPath = 'polygon(0% 0%, ' + p1 + '% 0%, ' + p1 + '% 100%, 0% 100%)';

        layer2.style.clipPath = 'polygon(' + p1 + '% 0%, ' + p2 + '% 0%, ' + p2 + '% 100%, ' + p1 + '% 100%)';
        layer2.style.webkitClipPath = 'polygon(' + p1 + '% 0%, ' + p2 + '% 0%, ' + p2 + '% 100%, ' + p1 + '% 100%)';

        layer1.style.clipPath = 'polygon(' + p2 + '% 0%, 100% 0%, 100% 100%, ' + p2 + '% 100%)';
        layer1.style.webkitClipPath = 'polygon(' + p2 + '% 0%, 100% 0%, 100% 100%, ' + p2 + '% 100%)';

        // Pills placement
        if (pill3) {
          pill3.style.left = '1.25rem';
          pill3.style.right = 'auto';
          pill3.style.opacity = p1 > 12 ? '1' : '0';
        }
        if (pill2) {
          pill2.style.left = ((p1 + p2) / 2) + '%';
          pill2.style.transform = 'translateX(-50%)';
          pill2.style.opacity = (p2 - p1) > 14 ? '1' : '0';
        }
        if (pill1) {
          pill1.style.right = '1.25rem';
          pill1.style.left = 'auto';
          pill1.style.opacity = (100 - p2) > 12 ? '1' : '0';
        }
      } else {
        // English LTR:
        // Left side (0% -> p1): Stage 1 (Raw Concrete)
        // Middle side (p1 -> p2): Stage 2 (BIM 3D Model)
        // Right side (p2 -> 100%): Stage 3 (Delivered Reality)
        layer1.style.clipPath = 'polygon(0% 0%, ' + p1 + '% 0%, ' + p1 + '% 100%, 0% 100%)';
        layer1.style.webkitClipPath = 'polygon(0% 0%, ' + p1 + '% 0%, ' + p1 + '% 100%, 0% 100%)';

        layer2.style.clipPath = 'polygon(' + p1 + '% 0%, ' + p2 + '% 0%, ' + p2 + '% 100%, ' + p1 + '% 100%)';
        layer2.style.webkitClipPath = 'polygon(' + p1 + '% 0%, ' + p2 + '% 0%, ' + p2 + '% 100%, ' + p1 + '% 100%)';

        layer3.style.clipPath = 'polygon(' + p2 + '% 0%, 100% 0%, 100% 100%, ' + p2 + '% 100%)';
        layer3.style.webkitClipPath = 'polygon(' + p2 + '% 0%, 100% 0%, 100% 100%, ' + p2 + '% 100%)';

        // Pills placement
        if (pill1) {
          pill1.style.left = '1.25rem';
          pill1.style.right = 'auto';
          pill1.style.opacity = p1 > 12 ? '1' : '0';
        }
        if (pill2) {
          pill2.style.left = ((p1 + p2) / 2) + '%';
          pill2.style.transform = 'translateX(-50%)';
          pill2.style.opacity = (p2 - p1) > 14 ? '1' : '0';
        }
        if (pill3) {
          pill3.style.right = '1.25rem';
          pill3.style.left = 'auto';
          pill3.style.opacity = (100 - p2) > 12 ? '1' : '0';
        }
      }
    }

    // Initial render
    applyPositions();

    // Pointer Drag Handlers
    function onPointerDown(handleIndex, e) {
      e.preventDefault();
      e.stopPropagation();
      activeHandle = handleIndex;
      var el = (handleIndex === 1) ? handle1 : handle2;
      el.classList.add('is-dragging');
      if (el.setPointerCapture) {
        try { el.setPointerCapture(e.pointerId); } catch (err) {}
      }
    }

    function onPointerMove(e) {
      if (!activeHandle) return;
      var rect = viewport.getBoundingClientRect();
      if (!rect.width) return;
      var pct = ((e.clientX - rect.left) / rect.width) * 100;

      if (activeHandle === 1) {
        // Dragging left handle: clamped between 5% and (pos2 - 7%)
        pos1 = Math.max(5, Math.min(pos2 - 7, pct));
      } else if (activeHandle === 2) {
        // Dragging right handle: clamped between (pos1 + 7%) and 95%
        pos2 = Math.max(pos1 + 7, Math.min(95, pct));
      }
      applyPositions();
    }

    function onPointerUp(e) {
      if (!activeHandle) return;
      var el = (activeHandle === 1) ? handle1 : handle2;
      el.classList.remove('is-dragging');
      if (el.releasePointerCapture) {
        try { el.releasePointerCapture(e.pointerId); } catch (err) {}
      }
      activeHandle = null;
    }

    function handle1Down(e) { onPointerDown(1, e); }
    function handle2Down(e) { onPointerDown(2, e); }

    handle1.addEventListener('pointerdown', handle1Down);
    handle2.addEventListener('pointerdown', handle2Down);
    window.addEventListener('pointermove', onPointerMove, { passive: true });
    window.addEventListener('pointerup', onPointerUp);
    window.addEventListener('pointercancel', onPointerUp);

    // Direct click on viewport track
    function onViewportClick(e) {
      if (e.target.closest('.luxe-compare-handle')) return;
      var rect = viewport.getBoundingClientRect();
      if (!rect.width) return;
      var pct = ((e.clientX - rect.left) / rect.width) * 100;
      var dist1 = Math.abs(pct - pos1);
      var dist2 = Math.abs(pct - pos2);

      if (dist1 < dist2) {
        pos1 = Math.max(5, Math.min(pos2 - 7, pct));
      } else {
        pos2 = Math.max(pos1 + 7, Math.min(95, pct));
      }
      applyPositions();
    }

    viewport.addEventListener('click', onViewportClick);

    // Keyboard accessibility
    function onKeyDown(e) {
      var isH1 = (document.activeElement === handle1);
      var isH2 = (document.activeElement === handle2);
      if (!isH1 && !isH2) return;

      var step = e.shiftKey ? 5 : 2;
      if (e.key === 'ArrowLeft') {
        e.preventDefault();
        if (isH1) pos1 = Math.max(5, Math.min(pos2 - 7, pos1 - step));
        if (isH2) pos2 = Math.max(pos1 + 7, Math.min(95, pos2 - step));
        applyPositions();
      } else if (e.key === 'ArrowRight') {
        e.preventDefault();
        if (isH1) pos1 = Math.max(5, Math.min(pos2 - 7, pos1 + step));
        if (isH2) pos2 = Math.max(pos1 + 7, Math.min(95, pos2 + step));
        applyPositions();
      }
    }

    window.addEventListener('keydown', onKeyDown);

    // Respond to language change event
    function onLangChanged() {
      applyPositions();
    }
    window.addEventListener('interior:langChanged', onLangChanged);

    cleanupFns.push(function () {
      handle1.removeEventListener('pointerdown', handle1Down);
      handle2.removeEventListener('pointerdown', handle2Down);
      window.removeEventListener('pointermove', onPointerMove);
      window.removeEventListener('pointerup', onPointerUp);
      window.removeEventListener('pointercancel', onPointerUp);
      viewport.removeEventListener('click', onViewportClick);
      window.removeEventListener('keydown', onKeyDown);
      window.removeEventListener('interior:langChanged', onLangChanged);
    });
  }

  function destroyCompareSlider() {
    cleanupFns.forEach(function (fn) { fn(); });
    cleanupFns = [];
  }

  if (window.InteriorApp) {
    window.InteriorApp.register('compareSlider', initCompareSlider, destroyCompareSlider);
  } else {
    document.addEventListener('DOMContentLoaded', initCompareSlider);
  }
})();

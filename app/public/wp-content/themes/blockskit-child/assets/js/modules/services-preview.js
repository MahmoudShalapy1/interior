/**
 * INTERIOR Services Floating Cursor Preview (Section 8.2)
 * Smoothly floats architectural photography preview following the cursor on services list.
 *
 * @package Blockskit_Child
 */

(function() {
  'use strict';

  function initServicesPreview() {
    var directory = document.querySelector('.luxe-services-directory');
    if (!directory) return;

    var preview = document.querySelector('.luxe-floating-preview');
    if (!preview) {
      preview = document.createElement('div');
      preview.className = 'luxe-floating-preview';
      preview.innerHTML = '<img src="" alt="Service Preview" />';
      document.body.appendChild(preview);
    }

    var previewImg = preview.querySelector('img');
    var rows = directory.querySelectorAll('.luxe-service-row');
    var targetX = 0, targetY = 0, currentX = 0, currentY = 0;
    var isMoving = false;

    function lerp(start, end, factor) {
      return start + (end - start) * factor;
    }

    function renderLoop() {
      if (isMoving) {
        currentX = lerp(currentX, targetX, 0.15);
        currentY = lerp(currentY, targetY, 0.15);
        preview.style.left = currentX + 'px';
        preview.style.top = currentY + 'px';
        requestAnimationFrame(renderLoop);
      }
    }

    rows.forEach(function(row) {
      var imgSrc = row.getAttribute('data-preview');

      row.addEventListener('mouseenter', function(e) {
        if (imgSrc && previewImg) {
          previewImg.src = imgSrc;
          preview.classList.add('is-active');
          targetX = e.clientX;
          targetY = e.clientY;
          currentX = targetX;
          currentY = targetY;
          preview.style.left = currentX + 'px';
          preview.style.top = currentY + 'px';
          isMoving = true;
          requestAnimationFrame(renderLoop);
        }
      });

      row.addEventListener('mousemove', function(e) {
        targetX = e.clientX;
        targetY = e.clientY;
      });

      row.addEventListener('mouseleave', function() {
        preview.classList.remove('is-active');
        isMoving = false;
      });
    });
  }

  // Register with InteriorApp framework
  if (window.InteriorApp) {
    window.InteriorApp.register('servicesPreview', {
      init: initServicesPreview,
      destroy: function() {
        var p = document.querySelector('.luxe-floating-preview');
        if (p) p.remove();
      }
    });
  } else {
    document.addEventListener('DOMContentLoaded', initServicesPreview);
  }
})();

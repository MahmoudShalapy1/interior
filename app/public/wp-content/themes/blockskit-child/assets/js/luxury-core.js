/**
 * Ultra-Luxury Architectural Interactive Engine
 * Architectural Digest & Studio Liaigre Standards
 */

document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  // 2. Ambient Torchlight Following Mouse
  window.addEventListener('mousemove', function (e) {
    document.documentElement.style.setProperty('--mouse-x', e.clientX + 'px');
    document.documentElement.style.setProperty('--mouse-y', e.clientY + 'px');
  }, { passive: true });

  // 4. Full-Width Before & After Comparison Slider
  const sliderWrap = document.querySelector('.luxe-slider-wrap');
  const afterContainer = document.querySelector('.luxe-slider-after-container');
  const handle = document.querySelector('.luxe-slider-handle');

  if (sliderWrap && afterContainer && handle) {
    let isDragging = false;

    const updateSlider = function (clientX) {
      const rect = sliderWrap.getBoundingClientRect();
      let offsetX = clientX - rect.left;
      if (offsetX < 0) offsetX = 0;
      if (offsetX > rect.width) offsetX = rect.width;
      const percentage = (offsetX / rect.width) * 100;
      afterContainer.style.width = percentage + '%';
      handle.style.left = percentage + '%';
    };

    handle.addEventListener('mousedown', function (e) {
      e.preventDefault();
      isDragging = true;
    });

    sliderWrap.addEventListener('mousedown', function (e) {
      isDragging = true;
      updateSlider(e.clientX);
    });

    window.addEventListener('mouseup', function () {
      isDragging = false;
    });

    window.addEventListener('mousemove', function (e) {
      if (!isDragging) return;
      updateSlider(e.clientX);
    });

    // Touch Support for Mobile / iPad
    handle.addEventListener('touchstart', function () {
      isDragging = true;
    }, { passive: true });

    sliderWrap.addEventListener('touchstart', function (e) {
      isDragging = true;
      if (e.touches.length) updateSlider(e.touches[0].clientX);
    }, { passive: true });

    window.addEventListener('touchend', function () {
      isDragging = false;
    });

    window.addEventListener('touchmove', function (e) {
      if (!isDragging || !e.touches.length) return;
      updateSlider(e.touches[0].clientX);
    }, { passive: true });
  }

  // 5. Masonry Portfolio Filter Tabs
  const filterBtns = document.querySelectorAll('.luxe-filter-btn');
  const masonryItems = document.querySelectorAll('.luxe-masonry-item');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', function () {
      filterBtns.forEach(b => {
        b.style.color = 'var(--luxe-text-muted)';
        b.classList.remove('active');
      });
      this.classList.add('active');
      this.style.color = 'var(--luxe-gold)';

      const filterVal = this.getAttribute('data-filter');
      masonryItems.forEach(item => {
        const itemCat = item.getAttribute('data-category');
        if (filterVal === 'all' || itemCat === filterVal) {
          item.style.display = 'block';
          setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'scale(1)';
          }, 10);
        } else {
          item.style.opacity = '0';
          item.style.transform = 'scale(0.97)';
          setTimeout(() => {
            item.style.display = 'none';
          }, 400);
        }
      });
    });
  });

  // 6. Palace Protocol Form Submission Handlers
  const protocolForm = document.getElementById('luxe-protocol-form');
  const protocolSuccess = document.getElementById('luxe-protocol-success');
  if (protocolForm && protocolSuccess) {
    protocolForm.addEventListener('submit', function (e) {
      e.preventDefault();
      protocolForm.style.display = 'none';
      protocolSuccess.style.display = 'block';
    });
  }

  const homeProtocolForm = document.getElementById('luxe-home-protocol-form');
  const homeProtocolSuccess = document.getElementById('luxe-home-protocol-success');
  if (homeProtocolForm && homeProtocolSuccess) {
    homeProtocolForm.addEventListener('submit', function (e) {
      e.preventDefault();
      homeProtocolForm.style.display = 'none';
      homeProtocolSuccess.style.display = 'block';
    });
  }
});

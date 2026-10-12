/**
 * INTERIOR Architectural Portfolio Filter & View Switcher (Section 8.3)
 * Handles interactive category filtering and Grid / Tabular List view toggling.
 *
 * @package Blockskit_Child
 */

(function() {
  'use strict';

  function initPortfolioFilter() {
    var controls = document.querySelector('.luxe-portfolio-controls');
    if (!controls) return;

    var filterBtns = controls.querySelectorAll('.luxe-portfolio-filter-btn');
    var cards = document.querySelectorAll('.luxe-portfolio-card');
    var listRows = document.querySelectorAll('.luxe-list-row');
    var viewBtns = controls.querySelectorAll('.luxe-view-btn');
    var gridView = document.querySelector('.luxe-portfolio-grid');
    var listView = document.querySelector('.luxe-portfolio-list');

    // 1. Filter Buttons Handler
    filterBtns.forEach(function(btn) {
      btn.addEventListener('click', function() {
        var filterVal = btn.getAttribute('data-filter') || 'all';

        // Update active class on filter buttons
        filterBtns.forEach(function(b) { b.classList.remove('is-active'); });
        btn.classList.add('is-active');

        // Filter Grid Cards
        cards.forEach(function(card) {
          var category = card.getAttribute('data-category') || '';
          if (filterVal === 'all' || category === filterVal) {
            card.style.display = '';
            card.style.opacity = '0';
            card.style.transform = 'translateY(15px)';
            setTimeout(function() {
              card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
              card.style.opacity = '1';
              card.style.transform = 'translateY(0)';
            }, 50);
          } else {
            card.style.display = 'none';
          }
        });

        // Filter List Rows
        listRows.forEach(function(row) {
          var category = row.getAttribute('data-category') || '';
          if (filterVal === 'all' || category === filterVal) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      });
    });

    // 2. View Mode Toggle (Grid vs List)
    viewBtns.forEach(function(vBtn) {
      vBtn.addEventListener('click', function() {
        var mode = vBtn.getAttribute('data-view');
        viewBtns.forEach(function(b) { b.classList.remove('is-active'); });
        vBtn.classList.add('is-active');

        if (mode === 'list') {
          if (gridView) gridView.style.display = 'none';
          if (listView) listView.classList.add('is-active');
        } else {
          if (gridView) gridView.style.display = 'grid';
          if (listView) listView.classList.remove('is-active');
        }
      });
    });
  }

  // Register with InteriorApp framework
  if (window.InteriorApp) {
    window.InteriorApp.register('portfolioFilter', {
      init: initPortfolioFilter,
      destroy: function() {}
    });
  } else {
    document.addEventListener('DOMContentLoaded', initPortfolioFilter);
  }
})();

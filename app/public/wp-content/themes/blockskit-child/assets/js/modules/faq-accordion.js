/**
 * INTERIOR Architectural FAQ Accordion Module (Section 8.2 & 8.5)
 * Handles smooth editorial accordion interaction for service & investment objections.
 *
 * @package Blockskit_Child
 */

(function() {
  'use strict';

  function initFaqAccordion() {
    var accordions = document.querySelectorAll('.luxe-faq-accordion');
    if (!accordions.length) return;

    accordions.forEach(function(accordion) {
      var items = accordion.querySelectorAll('.luxe-faq-item');

      items.forEach(function(item) {
        var header = item.querySelector('.luxe-faq-header');
        if (!header) return;

        header.addEventListener('click', function() {
          var isOpen = item.classList.contains('is-open');

          // Optional: close other items in the same accordion
          items.forEach(function(other) {
            if (other !== item) {
              other.classList.remove('is-open');
              var body = other.querySelector('.luxe-faq-body');
              if (body) body.style.maxHeight = null;
            }
          });

          if (isOpen) {
            item.classList.remove('is-open');
            var body = item.querySelector('.luxe-faq-body');
            if (body) body.style.maxHeight = null;
          } else {
            item.classList.add('is-open');
            var body = item.querySelector('.luxe-faq-body');
            if (body) {
              body.style.maxHeight = (body.scrollHeight + 32) + 'px';
            }
          }
        });
      });
    });
  }

  // Register with InteriorApp framework
  if (window.InteriorApp) {
    window.InteriorApp.register('faqAccordion', {
      init: initFaqAccordion,
      destroy: function() {}
    });
  } else {
    document.addEventListener('DOMContentLoaded', initFaqAccordion);
  }
})();

/**
 * INTERIOR Architectural FAQ & Article Interactions Module
 * Handles smooth editorial accordion interaction for service, investment,
 * and high-prestige single article pages (with reading progress & share link sync).
 *
 * @package Blockskit_Child
 */

(function() {
  'use strict';

  var readingScrollHandler = null;
  var isToggling = false;

  /**
   * Toggle an Article FAQ item (.article-faq)
   */
  function toggleArticleFaq(trigger) {
    if (!trigger || isToggling) return;
    isToggling = true;

    try {
      var item = trigger.closest('.accordion__item');
      if (!item) return;

      var container = trigger.closest('.article-faq__accordion') || trigger.closest('.article-faq');
      var panelId = trigger.getAttribute('aria-controls');
      var panel = panelId ? document.getElementById(panelId) : item.querySelector('.accordion__panel');

      // Check current open status
      var isCurrentlyOpen = (trigger.getAttribute('aria-expanded') === 'true') || item.classList.contains('is-open');

      if (isCurrentlyOpen) {
        // Close this item
        trigger.setAttribute('aria-expanded', 'false');
        item.classList.remove('is-open');
        if (panel) {
          panel.setAttribute('hidden', '');
          panel.style.display = 'none';
        }
      } else {
        // Close all other sibling items in this accordion
        if (container) {
          var allItems = container.querySelectorAll('.accordion__item');
          allItems.forEach(function(other) {
            if (other !== item) {
              other.classList.remove('is-open');
              var otherBtn = other.querySelector('.accordion__trigger');
              if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
              var otherPanelId = otherBtn ? otherBtn.getAttribute('aria-controls') : null;
              var otherPanel = otherPanelId ? document.getElementById(otherPanelId) : other.querySelector('.accordion__panel');
              if (otherPanel) {
                otherPanel.setAttribute('hidden', '');
                otherPanel.style.display = 'none';
              }
            }
          });
        }

        // Open this item
        trigger.setAttribute('aria-expanded', 'true');
        item.classList.add('is-open');
        if (panel) {
          panel.removeAttribute('hidden');
          panel.style.display = 'block';
        }
      }
    } finally {
      setTimeout(function() {
        isToggling = false;
      }, 100);
    }
  }

  /**
   * Toggle a Luxe FAQ item (.luxe-faq-accordion on approach & services)
   */
  function toggleLuxeFaq(item) {
    if (!item) return;
    var container = item.closest('.luxe-faq-accordion');
    var isOpen = item.classList.contains('is-open');

    if (!isOpen && container) {
      var siblings = container.querySelectorAll('.luxe-faq-item');
      siblings.forEach(function(other) {
        if (other !== item) {
          other.classList.remove('is-open');
          var body = other.querySelector('.luxe-faq-body');
          if (body) body.style.maxHeight = null;
        }
      });
    }

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
  }

  /**
   * Initialize Reading Progress Bar for article detail pages
   */
  function initReadingProgress() {
    var bar = document.getElementById('luxe-reading-progress');
    if (!bar) return;

    if (readingScrollHandler) {
      window.removeEventListener('scroll', readingScrollHandler);
    }

    readingScrollHandler = function() {
      var docHeight = document.documentElement.scrollHeight - window.innerHeight;
      if (docHeight > 0) {
        var pct = Math.min(100, Math.max(0, (window.scrollY / docHeight) * 100));
        bar.style.width = pct + '%';
      }
    };

    window.addEventListener('scroll', readingScrollHandler, { passive: true });
    readingScrollHandler();
  }

  /**
   * Copy Link Helper
   */
  function handleCopyLink(btn) {
    if (!btn) return;
    var url = btn.getAttribute('data-copy-link') || window.location.href;
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(url).then(function() {
        btn.classList.add('is-copied');
        setTimeout(function() {
          btn.classList.remove('is-copied');
        }, 2000);
      }).catch(function() {
        fallbackCopy(url, btn);
      });
    } else {
      fallbackCopy(url, btn);
    }
  }

  function fallbackCopy(text, btn) {
    try {
      var input = document.createElement('input');
      input.value = text;
      input.style.position = 'fixed';
      input.style.opacity = '0';
      document.body.appendChild(input);
      input.focus();
      input.select();
      document.execCommand('copy');
      document.body.removeChild(input);
      btn.classList.add('is-copied');
      setTimeout(function() { btn.classList.remove('is-copied'); }, 2000);
    } catch (e) {}
  }

  /**
   * Master Init
   */
  function initAllFaqAndArticles() {
    // 1. Ensure initial state of article FAQs matches DOM
    var articleAccordions = document.querySelectorAll('.article-faq__accordion');
    articleAccordions.forEach(function(acc) {
      var items = acc.querySelectorAll('.accordion__item');
      items.forEach(function(item) {
        var btn = item.querySelector('.accordion__trigger');
        var panelId = btn ? btn.getAttribute('aria-controls') : null;
        var panel = panelId ? document.getElementById(panelId) : item.querySelector('.accordion__panel');
        var isOpen = item.classList.contains('is-open');

        if (btn) btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        if (panel) {
          if (isOpen) {
            panel.removeAttribute('hidden');
            panel.style.display = 'block';
          } else {
            panel.setAttribute('hidden', '');
            panel.style.display = 'none';
          }
        }
      });
    });

    // 2. Reading progress bar
    initReadingProgress();
  }

  function destroyFaqAndArticles() {
    if (readingScrollHandler) {
      window.removeEventListener('scroll', readingScrollHandler);
      readingScrollHandler = null;
    }
  }

  /**
   * Global Delegated Event Listeners (Attached ONCE, Persistent & Immune to SPA Swaps)
   */
  if (!window.__interiorArticleFaqDelegated) {
    window.__interiorArticleFaqDelegated = true;

    document.addEventListener('click', function(e) {
      // A. Article FAQ Trigger Click
      var articleTrigger = e.target.closest('.article-faq .accordion__trigger');
      if (articleTrigger) {
        e.preventDefault();
        e.stopPropagation();
        toggleArticleFaq(articleTrigger);
        return;
      }

      // B. Luxe FAQ Header Click (Approach / Services)
      var luxeHeader = e.target.closest('.luxe-faq-header');
      if (luxeHeader) {
        var item = luxeHeader.closest('.luxe-faq-item');
        if (item) {
          e.preventDefault();
          toggleLuxeFaq(item);
          return;
        }
      }

      // C. Copy Link Button
      var copyBtn = e.target.closest('[data-copy-link]');
      if (copyBtn) {
        e.preventDefault();
        handleCopyLink(copyBtn);
        return;
      }
    }, true); // Use capture phase so nothing can intercept or prevent it

    // Keyboard accessibility (Enter / Space on accordion triggers)
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' || e.key === ' ') {
        var articleTrigger = e.target.closest('.article-faq .accordion__trigger');
        if (articleTrigger) {
          e.preventDefault();
          toggleArticleFaq(articleTrigger);
        }
      }
    });
  }

  // Expose to window for direct inspection if needed
  window.InteriorArticleFaq = {
    toggle: toggleArticleFaq,
    init: initAllFaqAndArticles
  };

  // Register with InteriorApp framework
  if (window.InteriorApp) {
    window.InteriorApp.register('faqAccordion', {
      init: initAllFaqAndArticles,
      destroy: destroyFaqAndArticles
    });
  } else {
    document.addEventListener('DOMContentLoaded', initAllFaqAndArticles);
  }
})();

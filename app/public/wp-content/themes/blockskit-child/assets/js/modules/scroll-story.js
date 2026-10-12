/**
 * INTERIOR Module: From Line to Living — 4-Stage Pinned Scroll (Section 7.3 — Wow #2)
 * Synchronized with GSAP ScrollTrigger, Lenis Smooth Scroll, and Compositor Sticky Positioning
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var cleanupFns = [];

  function initScrollStory() {
    var storySection = document.getElementById('story');
    if (!storySection) return;

    var stageImages = storySection.querySelectorAll('.luxe-story-stage-img');
    var contentItems = storySection.querySelectorAll('.luxe-story-content-item');
    var numberEl = storySection.querySelector('.luxe-story-number');
    var progressFill = storySection.querySelector('.luxe-story-progress-fill');
    var progressBar = storySection.querySelector('.luxe-story-progress-bar');
    var chamberEl = storySection.querySelector('[data-i18n="story_spec_chamber"]');

    if (!stageImages.length || !contentItems.length) return;

    if (progressFill) {
      progressFill.style.width = '25%';
    }

    var currentStage = 0;

    var chambersAr = [
      'الجناح 01 · الفكرة والاسكتش المعماري',
      'الجناح 02 · الهندسة والمخططات التنفيذية',
      'الجناح 03 · اختبار المواد والضوء الحقيقي',
      'الجناح 04 · الجناح الرئيسي المسكون'
    ];
    var chambersEn = [
      'Suite 01 · Concept & Architectural Sketch',
      'Suite 02 · Engineering & Executive Blueprints',
      'Suite 03 · Material & Lighting Simulation',
      'Suite 04 · Grand Master Suite Handover'
    ];

    function setStage(index) {
      if (index === currentStage) return;
      currentStage = index;

      // 1. Update active stage image
      stageImages.forEach(function (img, i) {
        if (i === index) {
          img.classList.add('is-active');
        } else {
          img.classList.remove('is-active');
        }
      });

      // 2. Update active content block
      contentItems.forEach(function (item, i) {
        if (i === index) {
          item.classList.add('is-active');
        } else {
          item.classList.remove('is-active');
        }
      });

      // 3. Update stage number
      var stageNums = ['01', '02', '03', '04'];
      if (numberEl && stageNums[index]) {
        numberEl.textContent = stageNums[index];
      }

      // 4. Update chamber meta badge
      var isAr = document.documentElement.getAttribute('lang') === 'ar';
      if (chamberEl) {
        chamberEl.textContent = isAr ? chambersAr[index] : chambersEn[index];
      }

      // 5. Update progress fill bar
      if (progressFill) {
        progressFill.style.width = ((index + 1) * 25) + '%';
      }
    }

    function updateProgress(progress) {
      progress = Math.max(0, Math.min(1, progress));

      var stageIndex = 0;
      if (progress < 0.25) {
        stageIndex = 0;
      } else if (progress < 0.50) {
        stageIndex = 1;
      } else if (progress < 0.75) {
        stageIndex = 2;
      } else {
        stageIndex = 3;
      }

      setStage(stageIndex);
    }

    // Scroll Progress Calculation (from viewport relative position)
    function onScroll() {
      var rect = storySection.getBoundingClientRect();
      var scrollableHeight = storySection.offsetHeight - window.innerHeight;

      if (scrollableHeight <= 0) return;

      var progress = (-rect.top) / scrollableHeight;
      updateProgress(progress);
    }

    // Method 1: GSAP ScrollTrigger Integration (First-Class Sync with Lenis RAF)
    var stInstance = null;
    if (typeof ScrollTrigger !== 'undefined') {
      try {
        stInstance = ScrollTrigger.create({
          trigger: storySection,
          start: 'top top',
          end: 'bottom bottom',
          onUpdate: function (self) {
            updateProgress(self.progress);
          }
        });

        cleanupFns.push(function () {
          if (stInstance) {
            stInstance.kill();
            stInstance = null;
          }
        });
      } catch (err) {
        console.warn('[InteriorApp] ScrollTrigger story init:', err);
      }
    }

    // Method 2: Lenis & Native Window Scroll Listener
    window.addEventListener('scroll', onScroll, { passive: true });
    cleanupFns.push(function () {
      window.removeEventListener('scroll', onScroll);
    });

    if (window.InteriorApp && window.InteriorApp.lenis) {
      window.InteriorApp.lenis.on('scroll', onScroll);
      cleanupFns.push(function () {
        if (window.InteriorApp && window.InteriorApp.lenis) {
          window.InteriorApp.lenis.off('scroll', onScroll);
        }
      });
    }

    // Interactive Click: clicking the progress bar smoothly navigates to that stage
    if (progressBar) {
      function onBarClick(e) {
        var rect = progressBar.getBoundingClientRect();
        var clickX = e.clientX - rect.left;
        var ratio = Math.max(0, Math.min(1, clickX / rect.width));
        var targetStage = Math.min(3, Math.floor(ratio * 4));
        var scrollableHeight = storySection.offsetHeight - window.innerHeight;
        var targetOffset = storySection.getBoundingClientRect().top + window.pageYOffset + (targetStage * (scrollableHeight / 3.2));
        if (window.InteriorApp && typeof window.InteriorApp.scrollTo === 'function') {
          window.InteriorApp.scrollTo(targetOffset);
        } else {
          window.scrollTo({ top: targetOffset, behavior: 'smooth' });
        }
      }
      progressBar.style.cursor = 'pointer';
      progressBar.addEventListener('click', onBarClick);
      cleanupFns.push(function () {
        progressBar.removeEventListener('click', onBarClick);
      });
    }

    // Language Change Sync
    function onLangChanged(e) {
      var isAr = e.detail ? e.detail.lang === 'ar' : document.documentElement.getAttribute('lang') === 'ar';
      var stageNums = ['01', '02', '03', '04'];
      if (numberEl && stageNums[currentStage]) {
        numberEl.textContent = stageNums[currentStage];
      }
      if (chamberEl) {
        chamberEl.textContent = isAr ? chambersAr[currentStage] : chambersEn[currentStage];
      }
    }
    window.addEventListener('interior:langChanged', onLangChanged);
    cleanupFns.push(function () {
      window.removeEventListener('interior:langChanged', onLangChanged);
    });

    // Initial check
    onScroll();
  }

  function destroyScrollStory() {
    cleanupFns.forEach(function (fn) {
      try { fn(); } catch (e) {}
    });
    cleanupFns = [];
  }

  function boot() {
    if (window.InteriorApp) {
      window.InteriorApp.register('scrollStory', initScrollStory, destroyScrollStory);
      // If InteriorApp is already active, initialize immediately
      if (window.InteriorApp.modules && window.InteriorApp.modules['scrollStory'] && !window.InteriorApp.modules['scrollStory'].active) {
        try {
          initScrollStory();
          window.InteriorApp.modules['scrollStory'].active = true;
        } catch (e) {}
      }
    } else {
      initScrollStory();
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();

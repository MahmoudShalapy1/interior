/**
 * INTERIOR Module: White-Label Demo Mode & Live Client Customizer (Section 14 & Phase 11)
 * Enables sales agents and studio directors to showcase real-time personalization
 * (Atmosphere, Border Radii, Motion Pacing, and Live Studio Rebranding) to prospective buyers.
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var cleanupFns = [];

  function initDemoMode() {
    // Only initialize once
    if (document.getElementById('luxe-demo-toolbar')) return;

    // Check if demo mode was explicitly requested via URL param ?demo=1
    var urlParams = new URLSearchParams(window.location.search);
    var isDemoActive = urlParams.get('demo') === '1';
    if (!isDemoActive) return;

    // Create the floating toolbar DOM
    var toolbar = document.createElement('aside');
    toolbar.id = 'luxe-demo-toolbar';
    toolbar.className = 'luxe-demo-toolbar is-visible';
    toolbar.setAttribute('aria-label', 'لوحة العرض والتخصيص المباشر');

    var isEn = document.documentElement.getAttribute('dir') === 'ltr' || (window.InteriorI18n && window.InteriorI18n.getCurrentLang() === 'en');

    toolbar.innerHTML = isEn ? [
      '<div class="luxe-demo-panel">',
      '  <div class="luxe-demo-header">',
      '    <div class="luxe-demo-title">',
      '      <span class="luxe-demo-dot"></span>',
      '      <span>DEMO LAB · Live Buyer Customizer</span>',
      '    </div>',
      '    <button type="button" class="luxe-demo-toggle-btn" id="luxe-demo-close" title="Minimize Panel">&times;</button>',
      '  </div>',
      '  <div class="luxe-demo-body">',
      '    <!-- 01. Atmosphere Palettes -->',
      '    <div class="luxe-demo-group">',
      '      <label class="luxe-demo-label">Atmosphere Palette (3 Presets)</label>',
      '      <div class="luxe-demo-btns">',
      '        <button type="button" class="luxe-demo-opt-btn" data-demo-theme="noir">Ink Noir</button>',
      '        <button type="button" class="luxe-demo-opt-btn" data-demo-theme="limestone">Limestone</button>',
      '        <button type="button" class="luxe-demo-opt-btn" data-demo-theme="bronze">Bronze Gulf</button>',
      '      </div>',
      '    </div>',
      '    <!-- 02. Border Radii Geometry -->',
      '    <div class="luxe-demo-group">',
      '      <label class="luxe-demo-label">Geometry Radius</label>',
      '      <div class="luxe-demo-btns">',
      '        <button type="button" class="luxe-demo-opt-btn is-active" data-demo-radius="sharp">Sharp 0px</button>',
      '        <button type="button" class="luxe-demo-opt-btn" data-demo-radius="soft">Soft 4px</button>',
      '      </div>',
      '    </div>',
      '    <!-- 03. Motion Pacing -->',
      '    <div class="luxe-demo-group">',
      '      <label class="luxe-demo-label">Motion Pacing</label>',
      '      <div class="luxe-demo-btns">',
      '        <button type="button" class="luxe-demo-opt-btn is-active" data-demo-motion="slow">Editorial (1.0x)</button>',
      '        <button type="button" class="luxe-demo-opt-btn" data-demo-motion="fast">Dynamic (0.6x)</button>',
      '      </div>',
      '    </div>',
      '    <!-- 04. Live Studio Brand Simulator -->',
      '    <div class="luxe-demo-group">',
      '      <label class="luxe-demo-label">Live Rebranding Simulator</label>',
      '      <div style="display: flex; gap: 0.5rem;">',
      '        <input type="text" id="luxe-demo-brand-input" class="luxe-demo-input" placeholder="Type buyer company brand name..." />',
      '        <button type="button" id="luxe-demo-brand-reset" class="luxe-demo-opt-btn" style="flex:0 0 auto;" title="Reset">&olarr;</button>',
      '      </div>',
      '    </div>',
      '  </div>',
      '  <div class="luxe-demo-footer">',
      '    <span>Keyboard Shortcut: [Ctrl + Shift + D]</span>',
      '  </div>',
      '</div>',
      '<!-- Minimized Floating Trigger Button -->',
      '<button type="button" class="luxe-demo-launcher" id="luxe-demo-launcher" aria-label="Open Demo Panel">',
      '  <span class="luxe-demo-launcher__icon">&#9672;</span>',
      '  <span class="luxe-demo-launcher__text">Live Demo Lab</span>',
      '</button>'
    ].join('\n') : [
      '<div class="luxe-demo-panel">',
      '  <div class="luxe-demo-header">',
      '    <div class="luxe-demo-title">',
      '      <span class="luxe-demo-dot"></span>',
      '      <span>مختبر العرض · وضع التخصيص للمشترين</span>',
      '    </div>',
      '    <button type="button" class="luxe-demo-toggle-btn" id="luxe-demo-close" title="تصغير اللوحة">&times;</button>',
      '  </div>',
      '  <div class="luxe-demo-body">',
      '    <!-- 01. Atmosphere Palettes -->',
      '    <div class="luxe-demo-group">',
      '      <label class="luxe-demo-label">لوحة الأجواء المعمارية (3 أنماط)</label>',
      '      <div class="luxe-demo-btns">',
      '        <button type="button" class="luxe-demo-opt-btn" data-demo-theme="noir">حبر داكن</button>',
      '        <button type="button" class="luxe-demo-opt-btn" data-demo-theme="limestone">حجر جيري</button>',
      '        <button type="button" class="luxe-demo-opt-btn" data-demo-theme="bronze">برونز خليجي</button>',
      '      </div>',
      '    </div>',
      '    <!-- 02. Border Radii Geometry -->',
      '    <div class="luxe-demo-group">',
      '      <label class="luxe-demo-label">هندسة الحواف والمعمار</label>',
      '      <div class="luxe-demo-btns">',
      '        <button type="button" class="luxe-demo-opt-btn is-active" data-demo-radius="sharp">حواف حادة 0 بكسل</button>',
      '        <button type="button" class="luxe-demo-opt-btn" data-demo-radius="soft">حواف ناعمة 4 بكسل</button>',
      '      </div>',
      '    </div>',
      '    <!-- 03. Motion Pacing -->',
      '    <div class="luxe-demo-group">',
      '      <label class="luxe-demo-label">إيقاع وسرعة الحركة</label>',
      '      <div class="luxe-demo-btns">',
      '        <button type="button" class="luxe-demo-opt-btn is-active" data-demo-motion="slow">تحريري واثق (1.0×)</button>',
      '        <button type="button" class="luxe-demo-opt-btn" data-demo-motion="fast">ديناميكي رشيق (0.6×)</button>',
      '      </div>',
      '    </div>',
      '    <!-- 04. Live Studio Brand Simulator -->',
      '    <div class="luxe-demo-group">',
      '      <label class="luxe-demo-label">محاكي هوية المشتري وإعادة التسمية</label>',
      '      <div style="display: flex; gap: 0.5rem;">',
      '        <input type="text" id="luxe-demo-brand-input" class="luxe-demo-input" placeholder="اكتب اسم شركة المشتري هنا..." />',
      '        <button type="button" id="luxe-demo-brand-reset" class="luxe-demo-opt-btn" style="flex:0 0 auto;" title="إعادة تعيين">&olarr;</button>',
      '      </div>',
      '    </div>',
      '  </div>',
      '  <div class="luxe-demo-footer">',
      '    <span>اختصار لوحة المفاتيح: [تحكم + عالي + ي]</span>',
      '  </div>',
      '</div>',
      '<!-- Minimized Floating Trigger Button -->',
      '<button type="button" class="luxe-demo-launcher" id="luxe-demo-launcher" aria-label="فتح لوحة العرض">',
      '  <span class="luxe-demo-launcher__icon">&#9672;</span>',
      '  <span class="luxe-demo-launcher__text">وضع العرض المباشر</span>',
      '</button>'
    ].join('\n');

    document.body.appendChild(toolbar);

    // Grab elements
    var launcher = toolbar.querySelector('#luxe-demo-launcher');
    var closeBtn = toolbar.querySelector('#luxe-demo-close');
    var themeBtns = toolbar.querySelectorAll('[data-demo-theme]');
    var radiusBtns = toolbar.querySelectorAll('[data-demo-radius]');
    var motionBtns = toolbar.querySelectorAll('[data-demo-motion]');
    var brandInput = toolbar.querySelector('#luxe-demo-brand-input');
    var brandReset = toolbar.querySelector('#luxe-demo-brand-reset');

    function toggleToolbar() {
      toolbar.classList.toggle('is-visible');
      localStorage.setItem('interior_demo_active', toolbar.classList.contains('is-visible'));
    }

    if (launcher) launcher.addEventListener('click', toggleToolbar);
    if (closeBtn) closeBtn.addEventListener('click', toggleToolbar);

    // Keyboard Shortcut (Ctrl + Shift + D)
    function onKeyDown(e) {
      if (e.ctrlKey && e.shiftKey && (e.key === 'D' || e.key === 'd')) {
        e.preventDefault();
        toggleToolbar();
      }
    }
    window.addEventListener('keydown', onKeyDown);
    cleanupFns.push(function () { window.removeEventListener('keydown', onKeyDown); });

    // 1. Theme Presets sync
    var currentTheme = localStorage.getItem('interior_theme') || 'noir';
    function updateThemeActive(target) {
      themeBtns.forEach(function (btn) {
        if (btn.getAttribute('data-demo-theme') === target) {
          btn.classList.add('is-active');
        } else {
          btn.classList.remove('is-active');
        }
      });
    }
    updateThemeActive(currentTheme);

    themeBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var t = btn.getAttribute('data-demo-theme');
        document.documentElement.setAttribute('data-theme', t);
        localStorage.setItem('interior_theme', t);
        updateThemeActive(t);
        // Also sync curtain menu theme buttons if present
        var curtainBtns = document.querySelectorAll('.luxe-theme-btn');
        curtainBtns.forEach(function (cb) {
          if (cb.getAttribute('data-theme-target') === t) {
            cb.classList.add('is-active');
          } else {
            cb.classList.remove('is-active');
          }
        });
      });
    });

    // 2. Geometry Radii sync
    radiusBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        radiusBtns.forEach(function (b) { b.classList.remove('is-active'); });
        btn.classList.add('is-active');
        var r = btn.getAttribute('data-demo-radius');
        document.documentElement.setAttribute('data-radius', r);
      });
    });

    // 3. Motion Pacing sync
    motionBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        motionBtns.forEach(function (b) { b.classList.remove('is-active'); });
        btn.classList.add('is-active');
        var m = btn.getAttribute('data-demo-motion');
        document.documentElement.setAttribute('data-motion', m);
      });
    });

    // 4. Brand Rebranding Simulator
    var originalBrandText = 'INTERIOR';
    var brandEls = document.querySelectorAll('.luxe-brand-logo');

    if (brandInput) {
      brandInput.addEventListener('input', function () {
        var customName = brandInput.value.trim();
        brandEls.forEach(function (el) {
          el.textContent = customName || originalBrandText;
        });
      });
    }

    if (brandReset) {
      brandReset.addEventListener('click', function () {
        if (brandInput) brandInput.value = '';
        brandEls.forEach(function (el) {
          el.textContent = originalBrandText;
        });
      });
    }

    cleanupFns.push(function () {
      if (toolbar.parentNode) toolbar.parentNode.removeChild(toolbar);
    });
  }

  function destroyDemoMode() {
    cleanupFns.forEach(function (fn) { fn(); });
    cleanupFns = [];
  }

  if (window.InteriorApp) {
    window.InteriorApp.register('demoMode', {
      init: initDemoMode,
      destroy: destroyDemoMode
    });
  } else {
    document.addEventListener('DOMContentLoaded', initDemoMode);
  }
})();

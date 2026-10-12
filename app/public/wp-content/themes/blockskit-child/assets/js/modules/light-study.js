/**
 * INTERIOR Module: Architectural Light Study (Section 7.7 — Wow #4)
 * 4-Phase Time-of-Day Daylight Ambient Controller
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var cleanupFns = [];

  function initLightStudy() {
    var lightSection = document.getElementById('light-study');
    if (!lightSection) return;

    var tabs = lightSection.querySelectorAll('.luxe-light-tab');
    var layers = lightSection.querySelectorAll('.luxe-light-layer');
    var quoteEl = lightSection.querySelector('.luxe-light-quote');
    var tintEl = lightSection.querySelector('.luxe-light-tint');

    if (!tabs.length || !layers.length) return;

    var atmospheres = {
      dawn: {
        tint: 'rgba(92, 118, 141, 0.18)',
        quoteAr: 'الفجر 06:00 · ضوء شاحب هادئ يوقظ الخطوط المعمارية بانكسار ناعم وبلا قسوة.',
        quoteEn: 'Dawn 06:00 · Soft morning dispersion awakening monumental volumes with quiet restraint.'
      },
      noon: {
        tint: 'rgba(255, 250, 240, 0.05)',
        quoteAr: 'الظهر 12:00 · تعامد شمسي مباشر يختبر صلابة الكتل الحجرية وأصالة الرخام.',
        quoteEn: 'Noon 12:00 · Direct high-noon solar clarity revealing the raw grain of hand-honed travertine.'
      },
      sunset: {
        tint: 'rgba(212, 143, 56, 0.22)',
        quoteAr: 'الغروب 18:00 · الساعة الذهبية؛ دفء متوهج يتغلغل في خشب الجوز والبرونز الخام.',
        quoteEn: 'Sunset 18:00 · Golden hour warmth radiating across fluted walnut joinery and patinated bronze.'
      },
      night: {
        tint: 'rgba(10, 16, 26, 0.35)',
        quoteAr: 'الليل 22:00 · سينوغرافيا إضاءة متكتمة ومدروسة؛ الظلال هنا جزء أصيل من التصميم.',
        quoteEn: 'Night 22:00 · Subdued architectural micro-optics; darkness and shadow as sovereign design elements.'
      }
    };

    tabs.forEach(function (tab) {
      function onClick() {
        var phase = tab.getAttribute('data-phase');
        if (!phase) return;

        // Update active tab
        tabs.forEach(function (t) { t.classList.remove('is-active'); });
        tab.classList.add('is-active');

        // Update active layer
        layers.forEach(function (layer) {
          if (layer.getAttribute('data-phase') === phase) {
            layer.classList.add('is-active');
          } else {
            layer.classList.remove('is-active');
          }
        });

        // Update quote & ambient tint
        var isEn = document.documentElement.getAttribute('dir') === 'ltr' || (window.InteriorI18n && window.InteriorI18n.getCurrentLang() === 'en');
        if (atmospheres[phase]) {
          if (quoteEl) quoteEl.textContent = isEn ? atmospheres[phase].quoteEn : atmospheres[phase].quoteAr;
          if (tintEl) tintEl.style.backgroundColor = atmospheres[phase].tint;
        }
      }

      tab.addEventListener('click', onClick);
      cleanupFns.push(function () { tab.removeEventListener('click', onClick); });
    });
  }

  function destroyLightStudy() {
    cleanupFns.forEach(function (fn) { fn(); });
    cleanupFns = [];
  }

  if (window.InteriorApp) {
    window.InteriorApp.register('lightStudy', initLightStudy, destroyLightStudy);
  } else {
    document.addEventListener('DOMContentLoaded', initLightStudy);
  }
})();

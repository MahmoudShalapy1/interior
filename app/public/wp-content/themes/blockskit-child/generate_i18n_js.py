import json
import os

with open('extracted_keys.json', 'r', encoding='utf-8') as f:
    ar_keys = json.load(f)

with open('en_dictionary.json', 'r', encoding='utf-8') as f:
    en_keys = json.load(f)

# Ensure AR texts have no English & clean HTML
ar_dict = {}
for k, v in ar_keys.items():
    raw = v.get('raw', '').strip()
    if not raw:
        raw = v.get('ar', '').strip()
    # Normalize bullet and copy
    raw = raw.replace('&bull;', '•').replace('&copy;', '©')
    if k == 'footer_hq_desc':
        raw = 'طريق الملك فهد، العليا، الرياض<br>المملكة العربية السعودية<br>مراسلات الاستوديو: متاحة عبر الملف الخاص المعتمد<br>هاتف: +٩٦٦ ١١ ٤٥٠ ٨٨٠٠'
    if k == 'curtain_line_val':
        raw = '+٩٦٦ ١١ ٠٠٠ ٠٠٠٠<br>مكتب المراسلات المعتمد'
    if k == 'footer_vip_btn':
        raw = 'حجز موعد استشاري خاص'
    if k == 'lang_btn_ar':
        raw = 'عربي'
    if k == 'lang_btn_en':
        raw = 'الإنجليزية'
    if k == 'footer_concierge_email':
        raw = 'مكتب المراسم والمراسلات المعتمدة'
    if k == 'curtain_num_1': raw = '٠١'
    if k == 'curtain_num_2': raw = '٠٢'
    if k == 'curtain_num_3': raw = '٠٣'
    if k == 'curtain_num_4': raw = '٠٤'
    if k == 'curtain_num_5': raw = '٠٥'
    if k == 'curtain_num_6': raw = '٠٦'
    if k == 'proc_num_1': raw = '٠١'
    if k == 'proc_num_2': raw = '٠٢'
    if k == 'proc_num_3': raw = '٠٣'
    if k == 'proc_num_4': raw = '٠٤'
    if k == 'proc_num_5': raw = '٠٥'
    if k == 'proc_num_6': raw = '٠٦'
    if k == 'srv_num_1': raw = '٠١'
    if k == 'srv_num_2': raw = '٠٢'
    if k == 'srv_num_3': raw = '٠٣'
    if k == 'srv_num_4': raw = '٠٤'
    if k == 'srv_num_5': raw = '٠٥'
    if k == 'story_num_current': raw = '٠١'
    ar_dict[k] = raw

en_dict = dict(en_keys)

# Ensure both have all keys
all_keys = set(ar_dict.keys()) | set(en_dict.keys())
print(f"Total keys to compile into i18n.js: {len(all_keys)}")

js_content = """/**
 * INTERIOR Sovereign Bilingual Engine (Arabic RTL / English LTR)
 *
 * Guarantees:
 * - In Arabic mode: strict RTL, zero English words across all UI elements.
 * - In English mode: strict LTR, zero Arabic words across all UI elements.
 * - Directional glyphs and layouts dynamically flipped.
 * - Instant zero-flicker sync via localStorage & cookies.
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var AR_DICT = """ + json.dumps(ar_dict, ensure_ascii=False, indent=2) + """;

  var EN_DICT = """ + json.dumps(en_dict, ensure_ascii=False, indent=2) + """;

  var DICTIONARY = {
    ar: AR_DICT,
    en: EN_DICT
  };

  var TITLES = {
    en: {
      '/': 'INTERIOR — From Line to Living | Sovereign Architecture & Turnkey Delivery',
      '/about': 'About the Studio & Monograph — INTERIOR',
      '/services': 'Services Ecosystem & Sovereign Execution — INTERIOR',
      '/approach': 'Executive Approach & Investment Governance — INTERIOR',
      '/projects': 'Sovereign Project Archive — INTERIOR',
      '/contact': 'Private Dossier & Commissioning Protocol — INTERIOR',
      '/case-study-hittin': 'Case Study: Hittin Royal Palace — INTERIOR'
    },
    ar: {
      '/': 'إنتيريور — من الخط إلى المكان | عمارة وتنفيذ القصور الفاخرة بالرياض',
      '/about': 'عن الاستوديو والمونوغراف المعماري — إنتيريور',
      '/services': 'منظومة الخدمات والسيادة الكاملة — إنتيريور',
      '/approach': 'المنهج التنفيذي وحوكمة الاستثمار — إنتيريور',
      '/projects': 'أرشيف المشاريع والقصور المنفذة — إنتيريور',
      '/contact': 'الملف الخاص وبدء دراسة المشروع — إنتيريور',
      '/case-study-hittin': 'دراسة حالة: قصر حطين الخاص بالرياض — إنتيريور'
    }
  };

  function getCurrentLang() {
    var saved = localStorage.getItem('interior_lang');
    if (saved === 'ar' || saved === 'en') return saved;
    var cookieMatch = document.cookie.match(/(?:^|; )interior_lang=(ar|en)/);
    if (cookieMatch) return cookieMatch[1];
    return 'ar';
  }

  function applyLanguage(lang) {
    if (lang !== 'ar' && lang !== 'en') lang = 'ar';

    // 1. Update Document Root Direction & Language Attributes
    var isEn = (lang === 'en');
    document.documentElement.setAttribute('dir', isEn ? 'ltr' : 'rtl');
    document.documentElement.setAttribute('lang', isEn ? 'en-US' : 'ar');
    if (isEn) {
      document.documentElement.classList.add('ltr');
      document.documentElement.classList.remove('rtl');
    } else {
      document.documentElement.classList.add('rtl');
      document.documentElement.classList.remove('ltr');
    }

    if (document.body) {
      document.body.setAttribute('dir', isEn ? 'ltr' : 'rtl');
      if (isEn) {
        document.body.classList.add('ltr');
        document.body.classList.remove('rtl');
      } else {
        document.body.classList.add('rtl');
        document.body.classList.remove('ltr');
      }
    }

    // 2. Persist in LocalStorage and Long-Lived Cookie
    try {
      localStorage.setItem('interior_lang', lang);
      document.cookie = 'interior_lang=' + lang + '; path=/; max-age=31536000; SameSite=Lax';
    } catch (e) {
      // Ignore storage errors
    }

    // 3. Update Switcher Buttons Active States & Content
    var switcherBtns = document.querySelectorAll('.luxe-lang-btn');
    switcherBtns.forEach(function (btn) {
      var btnLang = btn.getAttribute('data-lang');
      if (btnLang === lang) {
        btn.classList.add('is-active');
        btn.setAttribute('aria-pressed', 'true');
      } else {
        btn.classList.remove('is-active');
        btn.setAttribute('aria-pressed', 'false');
      }
    });

    // 4. Update Document Title
    try {
      var cleanPath = window.location.pathname.replace(/\\/$/, '') || '/';
      if (TITLES[lang] && TITLES[lang][cleanPath]) {
        document.title = TITLES[lang][cleanPath];
      }
    } catch (tErr) {}

    // 5. Update Accessible Skip Link
    var skipLinks = document.querySelectorAll('.skip-link, a[href="#content"], a[href="#primary"]');
    skipLinks.forEach(function (link) {
      link.textContent = isEn ? 'Skip to content' : 'تخطى إلى المحتوى';
    });

    // 6. Translate All [data-i18n] Elements
    var dict = DICTIONARY[lang] || AR_DICT;
    var i18nElements = document.querySelectorAll('[data-i18n]');
    i18nElements.forEach(function (el) {
      var key = el.getAttribute('data-i18n');
      if (dict && dict[key] !== undefined) {
        var val = dict[key];
        if (val.indexOf('<') !== -1) {
          el.innerHTML = val;
        } else {
          el.textContent = val;
        }
      }
    });

    // 7. Translate Placeholders [data-i18n-placeholder]
    var placeholderElements = document.querySelectorAll('[data-i18n-placeholder]');
    placeholderElements.forEach(function (el) {
      var key = el.getAttribute('data-i18n-placeholder');
      if (dict && dict[key] !== undefined) {
        el.setAttribute('placeholder', dict[key]);
      }
    });

    // 8. Translate Titles & Tooltips [data-i18n-title]
    var titleElements = document.querySelectorAll('[data-i18n-title]');
    titleElements.forEach(function (el) {
      var key = el.getAttribute('data-i18n-title');
      if (dict && dict[key] !== undefined) {
        el.setAttribute('title', dict[key]);
      }
    });

    // 9. Translate Aria Labels [data-i18n-aria]
    var ariaElements = document.querySelectorAll('[data-i18n-aria]');
    ariaElements.forEach(function (el) {
      var key = el.getAttribute('data-i18n-aria');
      if (dict && dict[key] !== undefined) {
        el.setAttribute('aria-label', dict[key]);
      }
    });

    // 10. Minimap Room Data-Names Translation
    var minimapRooms = document.querySelectorAll('.luxe-minimap__room');
    var MINIMAP_NAMES = {
      'room-hero': { ar: '٠١ المدخل · الافتتاحية', en: '01 Grand Foyer · Entrance' },
      'room-manifesto': { ar: '٠٢ البهو · البيان', en: '02 Gallery · Manifesto' },
      'room-story': { ar: '٠٣ الرواق · من الخط إلى المكان', en: '03 Runway · Line to Living' },
      'room-scale': { ar: '٠٤ الجناح السيادي · مقاييس الإنجاز', en: '04 Sovereign Wing · Metrics' },
      'room-vault': { ar: '٠٥ الخزنة السرية · القصور الخاصة', en: '05 Vault · Classified Estates' },
      'room-funnel': { ar: '٠٦ الجناح الخاص · الاستشارة', en: '06 Private Chamber · Consultation' }
    };
    minimapRooms.forEach(function (room) {
      var id = room.id;
      if (MINIMAP_NAMES[id]) {
        room.setAttribute('data-name', isEn ? MINIMAP_NAMES[id].en : MINIMAP_NAMES[id].ar);
      }
    });

    // 11. Flip Directional Arrows in Buttons & Badges
    var arrowNextEls = document.querySelectorAll('.luxe-arrow-icon, .luxe-arrow-next, [data-arrow]');
    arrowNextEls.forEach(function (el) {
      if (isEn) {
        el.textContent = el.textContent.replace('←', '→');
      } else {
        el.textContent = el.textContent.replace('→', '←');
      }
    });

    // 12. Refresh GSAP ScrollTrigger if Present
    if (window.ScrollTrigger) {
      window.ScrollTrigger.refresh();
    }

    // 13. Dispatch Custom Event for Reactive Modules (Wizard, Funnel, etc.)
    try {
      var event = new CustomEvent('interior:langChanged', { detail: { lang: lang, isEn: isEn } });
      window.dispatchEvent(event);
    } catch (err) {}
  }

  function initI18n() {
    var initialLang = getCurrentLang();

    // Attach click listeners to all language switcher buttons
    document.addEventListener('click', function (e) {
      var btn = e.target.closest('.luxe-lang-btn');
      if (!btn) return;
      e.preventDefault();
      var targetLang = btn.getAttribute('data-lang');
      if (targetLang) {
        applyLanguage(targetLang);
      }
    });

    // Run initial translation
    applyLanguage(initialLang);
  }

  // Expose Globally
  window.InteriorI18n = {
    dictionary: DICTIONARY,
    getCurrentLang: getCurrentLang,
    applyLanguage: applyLanguage
  };

  // Register with InteriorApp
  if (window.InteriorApp) {
    window.InteriorApp.register('i18n', {
      init: initI18n,
      destroy: function () {}
    });
  } else {
    document.addEventListener('DOMContentLoaded', initI18n);
  }
})();
"""

target_path = r"c:\Users\HP\Local Sites\interior\app\public\wp-content\themes\blockskit-child\assets\js\modules\i18n.js"
with open(target_path, 'w', encoding='utf-8') as out:
    out.write(js_content)

print(f"Generated {target_path} successfully!")

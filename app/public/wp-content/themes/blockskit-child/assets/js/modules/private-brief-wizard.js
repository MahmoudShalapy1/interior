/**
 * INTERIOR Private Brief Multi-Step Interactive Funnel (Section 8.6 — Wow #4)
 * Handles 6-step architectural qualification questionnaire with smooth step progression,
 * range slider live updates, and direct encrypted WhatsApp brief transmission.
 *
 * @package Blockskit_Child
 */

(function() {
  'use strict';

  function initPrivateBriefWizard() {
    var container = document.querySelector('.luxe-wizard-container');
    if (!container) return;

    var currentStep = 1;
    var totalSteps = 6;

    // Elements
    var progressFill = container.querySelector('.luxe-wizard-progress-fill');
    var stepIndicator = container.querySelector('.luxe-wizard-step-indicator');
    var steps = container.querySelectorAll('.luxe-wizard-step');
    var btnPrev = container.querySelector('.luxe-wizard-btn-prev');
    var btnNext = container.querySelector('.luxe-wizard-btn-next');
    var navBar = container.querySelector('.luxe-wizard-nav');
    var successScreen = container.querySelector('.luxe-wizard-success');

    // Data Store
    var briefData = {
      typology: '',
      location: '',
      area: 3500,
      scopes: [],
      investment: '',
      name: '',
      phone: '',
      email: '',
      channel: 'واتساب مشفر'
    };

    // Step 1: Typology Cards
    var typologyCards = container.querySelectorAll('.luxe-wizard-card[data-typology]');
    typologyCards.forEach(function(card) {
      card.addEventListener('click', function() {
        typologyCards.forEach(function(c) { c.classList.remove('is-selected'); });
        card.classList.add('is-selected');
        briefData.typology = card.getAttribute('data-typology');
      });
    });

    // URL Query Parameter Pre-selection (e.g. from Projects Archive or Single Project)
    if (window.location.search) {
      try {
        var urlParams = new URLSearchParams(window.location.search);
        var paramTypo = urlParams.get('typology') || urlParams.get('type');
        if (paramTypo) {
          typologyCards.forEach(function(card) {
            var typoAttr = (card.getAttribute('data-typology') || '').toLowerCase();
            var target = paramTypo.toLowerCase();
            if (typoAttr.includes(target) ||
                (target === 'palace' && typoAttr.includes('قصر')) ||
                (target === 'villa' && typoAttr.includes('فيلا')) ||
                (target === 'penthouse' && typoAttr.includes('بنتهاوس')) ||
                (target === 'commercial' && typoAttr.includes('بافيليون'))) {
              card.click();
            }
          });
        }
      } catch (err) {
        // Fallback gracefully
      }
    }

    // Step 2: City Pills
    var locationInput = container.querySelector('#luxe-wizard-location');
    var cityPills = container.querySelectorAll('.luxe-city-pill');
    cityPills.forEach(function(pill) {
      pill.addEventListener('click', function() {
        cityPills.forEach(function(p) { p.classList.remove('is-active'); });
        pill.classList.add('is-active');
        if (locationInput) {
          locationInput.value = pill.innerText.trim();
          briefData.location = locationInput.value;
        }
      });
    });
    if (locationInput) {
      locationInput.addEventListener('input', function() {
        briefData.location = locationInput.value;
      });
    }

    // Step 3: Area Slider
    var rangeSlider = container.querySelector('#luxe-wizard-area-range');
    var rangeDisplay = container.querySelector('#luxe-wizard-area-val');
    function updateAreaDisplay() {
      if (!rangeSlider || !rangeDisplay) return;
      var isEn = isEnMode();
      var val = parseInt(rangeSlider.value, 10);
      briefData.area = val;
      rangeDisplay.textContent = isEn
        ? Number(val).toLocaleString('en-US') + ' sq.m'
        : Number(val).toLocaleString('en-US') + ' م²';
    }

    if (rangeSlider && rangeDisplay) {
      rangeSlider.addEventListener('input', updateAreaDisplay);
    }

    // Step 4: Scope Checkboxes
    var scopeItems = container.querySelectorAll('.luxe-scope-item');
    scopeItems.forEach(function(item) {
      item.addEventListener('click', function() {
        item.classList.toggle('is-selected');
        var val = item.getAttribute('data-scope');
        if (item.classList.contains('is-selected')) {
          if (briefData.scopes.indexOf(val) === -1) {
            briefData.scopes.push(val);
          }
        } else {
          var idx = briefData.scopes.indexOf(val);
          if (idx > -1) {
            briefData.scopes.splice(idx, 1);
          }
        }
      });
    });

    // Step 5: Investment Cards
    var investmentCards = container.querySelectorAll('.luxe-investment-card');
    investmentCards.forEach(function(card) {
      card.addEventListener('click', function() {
        investmentCards.forEach(function(c) { c.classList.remove('is-selected'); });
        card.classList.add('is-selected');
        briefData.investment = card.getAttribute('data-investment');
      });
    });

    // Step 6: Preferred Channel Radio
    var channelPills = container.querySelectorAll('.luxe-channel-pill');
    channelPills.forEach(function(pill) {
      pill.addEventListener('click', function() {
        channelPills.forEach(function(p) { p.classList.remove('is-active'); });
        pill.classList.add('is-active');
        briefData.channel = pill.getAttribute('data-channel') || 'واتساب مشفر';
      });
    });

    function isEnMode() {
      return document.documentElement.getAttribute('dir') === 'ltr' || (window.InteriorI18n && window.InteriorI18n.getCurrentLang() === 'en');
    }

    function updateStepUI() {
      var isEn = isEnMode();
      // Update progress bar
      var pct = (currentStep / totalSteps) * 100;
      if (progressFill) progressFill.style.width = pct + '%';
      if (stepIndicator) {
        stepIndicator.textContent = isEn
          ? ('Step ' + currentStep + ' of ' + totalSteps)
          : ('الخطوة ' + currentStep + ' من ' + totalSteps);
      }

      // Show current step, hide others
      steps.forEach(function(step) {
        var sNum = parseInt(step.getAttribute('data-step'), 10);
        if (sNum === currentStep) {
          step.classList.add('is-active');
        } else {
          step.classList.remove('is-active');
        }
      });

      // Update button text & prev visibility
      if (btnPrev) {
        btnPrev.style.visibility = (currentStep === 1) ? 'hidden' : 'visible';
        btnPrev.textContent = isEn ? 'Previous' : 'السابق';
      }

      if (btnNext) {
        if (currentStep === totalSteps) {
          btnNext.innerHTML = isEn
            ? '<span>Approve & Submit Private Dossier</span> <span style="font-family: var(--font-mono); font-size: 11px;">→</span>'
            : '<span>اعتماد وإرسال الملف الخاص</span> <span style="font-family: var(--font-mono); font-size: 11px;">←</span>';
        } else {
          btnNext.innerHTML = isEn
            ? '<span>Continue to Next Step</span> <span style="font-family: var(--font-mono); font-size: 11px;">→</span>'
            : '<span>متابعة الخطوة التالية</span> <span style="font-family: var(--font-mono); font-size: 11px;">←</span>';
        }
      }
    }

    // Validation per step
    function validateCurrentStep() {
      var isEn = isEnMode();
      if (currentStep === 1) {
        if (!briefData.typology) {
          alert(isEn ? 'Please select project typology to begin.' : 'يرجى تحديد نوع المشروع للبدء.');
          return false;
        }
      } else if (currentStep === 2) {
        if (locationInput && !locationInput.value.trim()) {
          alert(isEn ? 'Please specify geographic location.' : 'يرجى تحديد الموقع الجغرافي للمشروع.');
          return false;
        }
        briefData.location = locationInput.value.trim();
      } else if (currentStep === 4) {
        if (briefData.scopes.length === 0) {
          alert(isEn ? 'Please select at least one scope of work.' : 'يرجى اختيار نطاق خدمة واحد على الأقل.');
          return false;
        }
      } else if (currentStep === 5) {
        if (!briefData.investment) {
          alert(isEn ? 'Please select estimated investment bracket.' : 'يرجى اختيار الشريحة الاستثمارية التقديرية.');
          return false;
        }
      } else if (currentStep === 6) {
        var nameField = container.querySelector('#luxe-wizard-name');
        var phoneField = container.querySelector('#luxe-wizard-phone');
        if (!nameField || !nameField.value.trim()) {
          alert(isEn ? 'Please enter your full name.' : 'يرجى إدخال الاسم الكريم.');
          return false;
        }
        if (!phoneField || !phoneField.value.trim()) {
          alert(isEn ? 'Please enter your direct contact number.' : 'يرجى إدخال رقم الهاتف المباشر.');
          return false;
        }
        briefData.name = nameField.value.trim();
        briefData.phone = phoneField.value.trim();
        var emailField = container.querySelector('#luxe-wizard-email');
        if (emailField) briefData.email = emailField.value.trim();
      }
      return true;
    }

    // Next Button Click
    if (btnNext) {
      btnNext.addEventListener('click', function(e) {
        e.preventDefault();
        if (!validateCurrentStep()) return;

        if (currentStep < totalSteps) {
          currentStep++;
          updateStepUI();
        } else {
          // Final Submit
          submitPrivateBrief();
        }
      });
    }

    // Prev Button Click
    if (btnPrev) {
      btnPrev.addEventListener('click', function(e) {
        e.preventDefault();
        if (currentStep > 1) {
          currentStep--;
          updateStepUI();
        }
      });
    }

    // Submit Handler
    function submitPrivateBrief() {
      var isEn = isEnMode();
      // Hide steps and nav
      steps.forEach(function(s) { s.classList.remove('is-active'); });
      if (navBar) navBar.style.display = 'none';
      if (stepIndicator) stepIndicator.textContent = isEn ? 'Dossier Approved' : 'تم اعتماد الملف';
      if (progressFill) progressFill.style.width = '100%';

      // Asynchronously persist to WordPress CPT Brief
      try {
        fetch('/wp-json/interior/v1/submit-brief', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            client_name: briefData.name,
            client_phone: briefData.phone,
            property_type: briefData.typology,
            property_scale: briefData.area + (isEn ? ' sq.m' : ' م²'),
            property_scope: briefData.scopes.join(' + '),
            client_location: briefData.location,
            client_timeline: briefData.investment
          })
        }).catch(function(err) {
          console.warn('Brief wizard API sync:', err);
        });
      } catch (e) {
        // Continue smoothly
      }

      // Show success screen
      if (successScreen) {
        successScreen.classList.add('is-active');

        var summaryEl = successScreen.querySelector('#luxe-wizard-summary-text');
        if (summaryEl) {
          summaryEl.innerHTML = isEn
            ? '<strong>Typology:</strong> ' + (briefData.typology || 'Unspecified') + '<br>' +
              '<strong>Location:</strong> ' + (briefData.location || 'Riyadh') + ' &bull; ' +
              '<strong>Area:</strong> ' + (briefData.area) + ' sq.m<br>' +
              '<strong>Investment Bracket:</strong> ' + (briefData.investment || 'Unspecified') + '<br>' +
              '<strong>Preferred Channel:</strong> ' + (briefData.channel || 'Encrypted WhatsApp')
            : '<strong>نوع المنشأة:</strong> ' + (briefData.typology || 'غير محدد') + '<br>' +
              '<strong>الموقع:</strong> ' + (briefData.location || 'الرياض') + ' &bull; ' +
              '<strong>المساحة:</strong> ' + (briefData.area) + ' م²<br>' +
              '<strong>الشريحة الاستثمارية:</strong> ' + (briefData.investment || 'غير محدد') + '<br>' +
              '<strong>وسيلة التواصل المفضلة:</strong> ' + (briefData.channel || 'واتساب مشفر');
        }

        // WhatsApp direct link button
        var waBtn = successScreen.querySelector('#luxe-wizard-whatsapp-btn');
        if (waBtn) {
          var waMsg = isEn
            ? encodeURIComponent(
                "Hello, I would like to submit a private architectural dossier to INTERIOR Studio:\n" +
                "- Name: " + briefData.name + "\n" +
                "- Project Typology: " + briefData.typology + "\n" +
                "- Location: " + briefData.location + "\n" +
                "- Area: " + briefData.area + " sq.m\n" +
                "- Scope: " + briefData.scopes.join(" + ") + "\n" +
                "- Investment Bracket: " + briefData.investment + "\n" +
                "- Preferred Channel: " + briefData.channel
              )
            : encodeURIComponent(
                "السلام عليكم، أود تقديم ملف معماري خاص لاستوديو INTERIOR:\n" +
                "- الاسم: " + briefData.name + "\n" +
                "- نوع المشروع: " + briefData.typology + "\n" +
                "- الموقع: " + briefData.location + "\n" +
                "- المساحة: " + briefData.area + " م²\n" +
                "- النطاق: " + briefData.scopes.join(" + ") + "\n" +
                "- الشريحة الاستثمارية: " + briefData.investment + "\n" +
                "- التواصل المفضل: " + briefData.channel
              );
          waBtn.href = "https://wa.me/966501234567?text=" + waMsg;
        }
      }
    }

    // Listen to global language change event
    window.addEventListener('interior:langChanged', function() {
      updateStepUI();
      updateAreaDisplay();
    });

    // Initialize UI
    updateStepUI();
  }

  // Register with InteriorApp framework
  if (window.InteriorApp) {
    window.InteriorApp.register('privateBriefWizard', {
      init: initPrivateBriefWizard,
      destroy: function() {}
    });
  } else {
    document.addEventListener('DOMContentLoaded', initPrivateBriefWizard);
  }
})();

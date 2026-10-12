/**
 * INTERIOR Module: VIP Architectural Qualification Funnel (Section 7.14)
 * Handles interactive pill toggles, dynamic validation, and VIP submission
 *
 * @package Blockskit_Child
 */

(function () {
  'use strict';

  var cleanupFns = [];

  function initQualificationFunnel() {
    var funnelSection = document.getElementById('funnel');
    if (!funnelSection) return;

    // Interactive Pill Toggles
    var pillGroups = funnelSection.querySelectorAll('.luxe-funnel-pills');
    pillGroups.forEach(function (group) {
      var targetInputId = group.getAttribute('data-target-input');
      var hiddenInput = targetInputId ? document.getElementById(targetInputId) : null;
      var pills = group.querySelectorAll('.luxe-funnel-pill');

      pills.forEach(function (pill) {
        function onPillClick(e) {
          e.preventDefault();
          pills.forEach(function (p) { p.classList.remove('is-active'); });
          pill.classList.add('is-active');

          var value = pill.getAttribute('data-value') || pill.textContent.trim();
          if (hiddenInput) {
            hiddenInput.value = value;
          }
        }

        pill.addEventListener('click', onPillClick);
        cleanupFns.push(function () { pill.removeEventListener('click', onPillClick); });
      });
    });

    // Form Handling
    var form = funnelSection.querySelector('#luxe-qualification-form');
    var successCard = funnelSection.querySelector('#luxe-qualification-success');

    if (form && successCard) {
      function onSubmit(e) {
        e.preventDefault();

        var submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
          submitBtn.disabled = true;
          var isEn = document.documentElement.getAttribute('dir') === 'ltr' || (window.InteriorI18n && window.InteriorI18n.getCurrentLang() === 'en');
          submitBtn.textContent = isEn ? 'Recording dossier & verifying encryption...' : 'جاري تسجيل الملف وتأكيد التشفير...';
        }

        var pType = (form.querySelector('#funnel-property-type') || {}).value || 'قصر سيادي مستقل';
        var pScale = (form.querySelector('#funnel-property-scale') || {}).value || '1,500 م² - 3,000 م²';
        var pScope = (form.querySelector('#funnel-property-scope') || {}).value || 'تسليم مفتاح شامل (تصميم + تشطيب + تأثيث)';
        var cName = (form.querySelector('#client-name') || {}).value || '';
        var cPhone = (form.querySelector('#client-phone') || {}).value || '';
        var cLoc = (form.querySelector('#client-location') || {}).value || 'الرياض';
        var cTime = (form.querySelector('#client-timeline') || {}).value || 'فوري';

        fetch('/wp-json/interior/v1/submit-brief', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            client_name: cName,
            client_phone: cPhone,
            property_type: pType,
            property_scale: pScale,
            property_scope: pScope,
            client_location: cLoc,
            client_timeline: cTime
          })
        }).then(function(res) {
          return res.json();
        }).then(function(data) {
          if (data && data.brief_id) {
            var refEl = successCard.querySelector('#luxe-qualification-ref-code');
            if (refEl) {
              refEl.textContent = '#DOSSIER-' + data.brief_id + '-CONFIDENTIAL';
            }
          }
        }).catch(function(err) {
          console.warn('REST brief sync error:', err);
        }).finally(function() {
          form.style.display = 'none';
          successCard.style.display = 'block';

          if (window.InteriorApp && window.InteriorApp.lenis) {
            window.InteriorApp.lenis.scrollTo(funnelSection, { offset: -80 });
          }
        });
      }

      form.addEventListener('submit', onSubmit);
      cleanupFns.push(function () { form.removeEventListener('submit', onSubmit); });
    }
  }

  function destroyQualificationFunnel() {
    cleanupFns.forEach(function (fn) { fn(); });
    cleanupFns = [];
  }

  if (window.InteriorApp) {
    window.InteriorApp.register('qualificationFunnel', initQualificationFunnel, destroyQualificationFunnel);
  }
})();

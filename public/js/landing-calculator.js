/**
 * Multi-step cost calculator modal for landing pages.
 * Submits leads via window.AK_LANDING.submitUrl (Campaign Leads API proxy).
 * Image uploads are UI-only (API does not accept files).
 */
(function (window, document, $) {
  'use strict';

  if (!$ || !window.AK_LANDING) return;

  var FIELD_ERROR = 'ak-field-error';
  var STEP_IDS = ['step1', 'step2', 'step3', 'step4'];

  function ensureErrorStyles() {
    if (document.getElementById('ak-form-error-styles')) {
      var existing = window.AK_FORM_ERRORS;
      if (existing && existing.fieldErrorClass) FIELD_ERROR = existing.fieldErrorClass;
      return;
    }
    if (window.AK_FORM_ERRORS && window.AK_FORM_ERRORS.ensureErrorStyles) {
      window.AK_FORM_ERRORS.ensureErrorStyles();
      FIELD_ERROR = window.AK_FORM_ERRORS.fieldErrorClass || FIELD_ERROR;
      return;
    }
    var style = document.createElement('style');
    style.id = 'ak-form-error-styles';
    style.textContent = [
      '.' + FIELD_ERROR + '{border-color:#e53935!important;background:#fff5f5!important;box-shadow:0 0 0 2px rgba(229,57,53,.18)!important}',
      'select.' + FIELD_ERROR + '{color:#b71c1c}',
      '.consent-label.' + FIELD_ERROR + ',.consent-label.is-invalid{outline:2px solid #e53935;outline-offset:3px;border-radius:8px;background:rgba(229,57,53,.06)!important;padding:6px;margin:-6px;box-shadow:none!important;border:none!important}',
      '#scaleGrid.' + FIELD_ERROR + '{outline:2px solid #e53935;outline-offset:4px;border-radius:12px}',
      'form label.error,.contact-consent-error{color:#e53935;font-size:12px;display:block;margin-top:4px;font-weight:500}'
    ].join('');
    document.head.appendChild(style);
  }

  function goToStep(index) {
    STEP_IDS.forEach(function (id, idx) {
      var el = document.getElementById(id);
      if (!el) return;
      el.classList.toggle('active', idx === index);
      // Clear any prior jQuery hide/show inline styles
      el.style.display = '';
    });
  }

  function setFieldError($el, on) {
    if (!$el || !$el.length) return;

    if ($el.is('[name="contact_consent"]')) {
      $el.closest('.consent-label').toggleClass(FIELD_ERROR + ' is-invalid', !!on);
      return;
    }

    $el.toggleClass(FIELD_ERROR, !!on);
  }

  function clearCalcErrors() {
    $('#calcForm').find('.' + FIELD_ERROR).removeClass(FIELD_ERROR);
    $('#calcForm .consent-label').removeClass('is-invalid ' + FIELD_ERROR);
    $('#calcForm .contact-consent-error').text('').hide();
    $('#scaleGrid').removeClass(FIELD_ERROR);
  }

  function setConsentMessage($consent, msg) {
    var $slot = $consent.closest('.consent-label').next('.contact-consent-error');
    if ($slot.length) {
      if (msg) $slot.text(msg).show();
      else $slot.text('').hide();
    }
  }

  function attributionPayload() {
    if (typeof window.getLeadAttributionForApi === 'function') {
      return window.getLeadAttributionForApi() || {};
    }
    if (typeof window.getLeadAttributionCookie === 'function') {
      return window.getLeadAttributionCookie() || {};
    }
    return {};
  }

  function buildPayload(formId) {
    var cfg = window.AK_LANDING || {};
    var $form = $('#calcForm');
    var data = {
      name: ($('#ccName').val() || $form.find('[name="name"]').val() || '').trim(),
      mobile: ($('#ccPhone').val() || $form.find('[name="mobile_no"]').val() || '').trim(),
      email: ($('#ccEmail').val() || $form.find('[name="email"]').val() || '').trim(),
      city: ($('#ccCity').val() || $form.find('[name="cliniccity"]').val() || cfg.city || '').trim(),
      form_id: formId,
      page_type: cfg.pageType,
      location_slug: cfg.locationSlug,
      norwood_stage: $('#norwoodStage').val() || '',
      contact_consent: $form.find('[name="contact_consent"]').is(':checked')
    };

    var attr = attributionPayload();
    Object.keys(attr).forEach(function (key) {
      if (attr[key] !== null && attr[key] !== undefined && attr[key] !== '') {
        data[key] = attr[key];
      }
    });

    return data;
  }

  function showMessage(msg, isError) {
    if (window.Swal) {
      Swal.fire({
        icon: isError ? 'error' : 'success',
        title: isError ? 'Oops' : 'Thank you',
        text: msg,
        confirmButtonColor: '#fd7e14'
      });
      return;
    }
    window.alert(msg);
  }

  function thanksRedirectUrl() {
    var cfg = window.AK_LANDING || {};
    var base = cfg.thanksUrl;
    if (!base) return '';
    var sep = base.indexOf('?') >= 0 ? '&' : '?';
    return base + sep + 'back=' + encodeURIComponent(window.location.pathname || '');
  }

  function redirectToThankYou() {
    var url = thanksRedirectUrl();
    if (!url) return false;

    if (typeof gtag_report_conversion === 'function') {
      try { gtag_report_conversion(url); } catch (e) { /* ignore */ }
    }
    if (typeof gtag === 'function') {
      try { gtag('event', 'lead_submission'); } catch (e) { /* ignore */ }
    }

    window.location.href = url;
    return true;
  }

  function treatmentMessage(stage) {
    var map = {
      1: 'Treatment Required: Medical management (PRP, growth factors, medications like Minoxidil & Finasteride) is the best option in your case.',
      2: 'Expected Grafts: 1000–1500 grafts | Expected Cost: ₹40,000 – ₹1,00,000',
      3: 'Expected Grafts: 1800–2200 grafts | Expected Cost: ₹70,000 – ₹2,00,000',
      4: 'Expected Grafts: 2200–2800 grafts | Expected Cost: ₹85,000 – ₹2,50,000',
      5: 'Expected Grafts: 3500–4000 grafts | Expected Cost: ₹1,50,000 – ₹3,60,000',
      6: 'Expected Grafts: 4500–5500 grafts | Expected Cost: ₹1,80,000 – ₹4,90,000',
      7: 'Expected Grafts: 5500–7000 grafts | Expected Cost: ₹2,20,000 – ₹6,00,000'
    };
    return map[stage] || 'Expected grafts and cost will be advised after consultation with the doctor.';
  }

  function postLead(formId, onSuccess, onError) {
    var cfg = window.AK_LANDING || {};
    $.ajax({
      url: cfg.submitUrl,
      type: 'POST',
      contentType: 'application/json',
      dataType: 'json',
      data: JSON.stringify(buildPayload(formId)),
      success: function (res) {
        if (res && res.ok) {
          if (typeof gtag_report_conversion === 'function') {
            try { gtag_report_conversion(); } catch (e) { /* ignore */ }
          }
          if (typeof gtag === 'function') {
            try { gtag('event', 'lead_submission'); } catch (e) { /* ignore */ }
          }
          onSuccess(res);
        } else {
          onError((res && res.message) || 'Please check your details and try again.');
        }
      },
      error: function (xhr) {
        var res = {};
        try { res = JSON.parse(xhr.responseText || '{}'); } catch (e) { /* ignore */ }
        var msg = res.message || 'Unable to submit your request right now. Please try again later.';
        if (xhr.status === 429) {
          msg = res.message || 'Too many requests. Please wait a moment and try again.';
        }
        onError(msg);
      }
    });
  }

  /**
   * Validate calculator step-1 fields and highlight EVERY invalid field.
   * @returns {{ok:boolean, message:string}}
   */
  function validateCalcStep1() {
    ensureErrorStyles();

    var $name = $('#ccName');
    var $phone = $('#ccPhone');
    var $city = $('#ccCity');
    var $email = $('#ccEmail');
    var $consent = $('#calcForm').find('[name="contact_consent"]');

    var name = ($name.val() || '').trim();
    var phone = ($phone.val() || '').trim();
    var city = ($city.val() || '').trim();
    var email = ($email.val() || '').trim();
    var phoneDigits = phone.replace(/\D/g, '');

    clearCalcErrors();

    var firstInvalid = null;
    var messages = [];

    if (!$name.length || !name) {
      setFieldError($name, true);
      messages.push('Please enter your name');
      firstInvalid = firstInvalid || $name;
    }
    if (!$phone.length || phoneDigits.length < 10 || phoneDigits.length > 14) {
      setFieldError($phone, true);
      messages.push('Please enter a valid phone number (10-14 digits)');
      firstInvalid = firstInvalid || $phone;
    }
    if ($city.length && !city) {
      setFieldError($city, true);
      messages.push('Please enter your city');
      firstInvalid = firstInvalid || $city;
    }
    if (email && !/^[\w.+-]+@([\w-]+\.)+[\w-]{2,}$/.test(email)) {
      setFieldError($email, true);
      messages.push('Please enter a valid email');
      firstInvalid = firstInvalid || $email;
    }
    if ($consent.length && !$consent.is(':checked')) {
      setFieldError($consent, true);
      setConsentMessage($consent, 'Contact consent is required.');
      messages.push('Contact consent is required.');
      firstInvalid = firstInvalid || $consent;
    }

    if (firstInvalid && firstInvalid.length) {
      try {
        firstInvalid[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
      } catch (e) { /* ignore */ }
      firstInvalid.trigger('focus');
    }

    return {
      ok: messages.length === 0,
      message: messages[0] || ''
    };
  }

  function bindContinue() {
    var btn = document.getElementById('toStep2');
    if (!btn) return;

    // Drop any native listeners from legacy assets/script.js
    var fresh = btn.cloneNode(true);
    fresh.disabled = false;
    fresh.classList.remove('disabled');
    fresh.removeAttribute('disabled');
    btn.parentNode.replaceChild(fresh, btn);

    $(fresh).on('click', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();

      var check = validateCalcStep1();
      if (!check.ok) {
        // Field highlights only — no SweetAlert on Continue
        return;
      }

      var $btn = $(this);
      $btn.prop('disabled', true);

      postLead('calcForm', function () {
        window.__AK_CALC_LEAD_SUBMITTED__ = true;
        goToStep(1);
        $btn.prop('disabled', false);
      }, function (msg) {
        showMessage(msg, true);
        $btn.prop('disabled', false);
      });
    });
  }

  $(function () {
    ensureErrorStyles();
    bindContinue();

    $('#calcForm').on('input change', '.input, select, [name="contact_consent"]', function () {
      setFieldError($(this), false);
      if ($(this).is('[name="contact_consent"]')) {
        setConsentMessage($(this), '');
      }
    });

    $('#backTo1').off('click').on('click', function () {
      goToStep(0);
    });

    $('.scale-card').off('click').on('click', function () {
      $('.scale-card').removeClass('active');
      $(this).addClass('active');
      $('#norwoodStage').val($(this).data('stage'));
      $('#toStep3').prop('disabled', false);
      $('#scaleGrid').removeClass(FIELD_ERROR);
    });

    $('#toStep3').off('click').on('click', function () {
      if (!$('#norwoodStage').val()) {
        $('#scaleGrid').addClass(FIELD_ERROR);
        showMessage('Please select a hair loss stage', true);
        return;
      }
      $('#scaleGrid').removeClass(FIELD_ERROR);
      goToStep(2);
    });

    $('#backTo2').off('click').on('click', function () {
      goToStep(1);
    });

    // Final submit: if lead already sent at step1, just show results; else submit now
    $('#calcForm').off('submit').on('submit', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();

      var userName = ($('#ccName').val() || '').trim();
      var norwoodStage = parseInt($('#norwoodStage').val(), 10) || 0;
      var leadSubmitted = !!window.__AK_CALC_LEAD_SUBMITTED__;

      function showThanks() {
        // Final step → thank-you page
        if (redirectToThankYou()) {
          return;
        }

        $('#thanksName').text(userName);
        $('#nwStage').text(norwoodStage || '-');
        if ($('#treatmentMessage').length) {
          $('#treatmentMessage').html(treatmentMessage(norwoodStage));
        }
        goToStep(3);
      }

      if (leadSubmitted) {
        showThanks();
        return;
      }

      var check = validateCalcStep1();
      if (!check.ok) {
        goToStep(0);
        return;
      }

      postLead('calcForm', function () {
        window.__AK_CALC_LEAD_SUBMITTED__ = true;
        showThanks();
      }, function (msg) {
        showMessage(msg, true);
      });
    });

    $('#closeDone').off('click').on('click', function () {
      $('#calcModal').removeClass('open show').attr('aria-hidden', 'true');
      $('body').removeClass('modal-open');
      document.body.style.overflow = '';
    });
  });
})(window, document, window.jQuery);

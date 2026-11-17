/**
 * Landing lead forms → CodeIgniter submit-lead (Campaign Leads API).
 * Expects window.AK_LANDING = { submitUrl, pageType, locationSlug, city }
 */
(function (window, document, $) {
  'use strict';

  if (!$) return;

  var SUCCESS_MSG = 'Thank you! Your request has been submitted. Our team will contact you shortly.';
  var FIELD_ERROR = 'ak-field-error';

  function ensureErrorStyles() {
    if (document.getElementById('ak-form-error-styles')) return;
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

  function fieldTarget($el) {
    if ($el.is('[name="contact_consent"]')) {
      return $el.closest('.consent-label');
    }
    return $el;
  }

  function markInvalid(element) {
    var $el = $(element);
    fieldTarget($el).addClass(FIELD_ERROR);
    if ($el.is('[name="contact_consent"]')) {
      $el.closest('.consent-label').addClass('is-invalid');
    }
  }

  function markValid(element) {
    var $el = $(element);
    fieldTarget($el).removeClass(FIELD_ERROR);
    if ($el.is('[name="contact_consent"]')) {
      $el.closest('.consent-label').removeClass('is-invalid');
      $el.closest('label').next('.contact-consent-error').text('').hide();
    }
  }

  function clearFormHighlights($form) {
    $form.find('.' + FIELD_ERROR).removeClass(FIELD_ERROR);
    $form.find('.consent-label').removeClass('is-invalid');
    $form.find('.contact-consent-error').text('').hide();
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

  function buildPayload($form, formId) {
    var cfg = window.AK_LANDING || {};
    var data = {
      name: $form.find('[name="name"]').val() || '',
      mobile: $form.find('[name="mobile_no"], [name="mobile"]').val() || '',
      email: $form.find('[name="email"]').val() || '',
      city: $form.find('[name="cliniccity"], [name="city"]').val() || cfg.city || '',
      form_id: formId,
      page_type: cfg.pageType,
      location_slug: cfg.locationSlug,
      norwood_stage: $form.find('[name="norwood_stage"]').val() || '',
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

  function handleSuccess(res, $form) {
    var msg = SUCCESS_MSG;
    $form.find('button[type="submit"]').prop('disabled', true);

    if (typeof gtag_report_conversion === 'function') {
      try { gtag_report_conversion(); } catch (e) { /* ignore */ }
    }
    if (typeof gtag === 'function') {
      try { gtag('event', 'lead_submission'); } catch (e) { /* ignore */ }
    }

    var $note = $form.siblings('#sendlead-show').first();
    if (!$note.length) {
      $note = $form.parent().find('#sendlead-show').first();
    }
    if ($note.length) {
      $note.text(msg).show();
      $form.hide();
    }

    showMessage(msg, false);
    $form[0].reset();
    clearFormHighlights($form);
  }

  function handleError(xhr) {
    var res = {};
    try { res = JSON.parse(xhr.responseText || '{}'); } catch (e) { /* ignore */ }

    var msg = res.message || 'Unable to submit your request right now. Please try again later.';
    if (xhr.status === 429) {
      msg = res.message || 'Too many requests. Please wait a moment and try again.';
    }
    showMessage(msg, true);
  }

  function submitLead($form, formId) {
    var cfg = window.AK_LANDING || {};
    var url = cfg.submitUrl;
    if (!url) {
      showMessage('Form is not configured correctly.', true);
      return;
    }

    var $btn = $form.find('button[type="submit"]');
    var original = $btn.text();
    $btn.prop('disabled', true).text('Submitting...');

    $.ajax({
      url: url,
      type: 'POST',
      contentType: 'application/json',
      dataType: 'json',
      data: JSON.stringify(buildPayload($form, formId)),
      success: function (res) {
        if (res && res.ok) {
          handleSuccess(res, $form);
        } else {
          showMessage((res && res.message) || 'Please check your details and try again.', true);
          $btn.prop('disabled', false).text(original);
        }
      },
      error: function (xhr) {
        handleError(xhr);
        $btn.prop('disabled', false).text(original);
      }
    });
  }

  /** Manual validation used when jquery.validate is missing, or as a full-form highlighter. */
  function validateLeadForm($form) {
    clearFormHighlights($form);

    var $name = $form.find('[name="name"]');
    var $mobile = $form.find('[name="mobile_no"], [name="mobile"]').first();
    var $email = $form.find('[name="email"]');
    var $city = $form.find('[name="cliniccity"], [name="city"]').first();
    var $consent = $form.find('[name="contact_consent"]');

    var name = ($name.val() || '').trim();
    var mobile = String($mobile.val() || '').replace(/\D/g, '');
    var email = ($email.val() || '').trim();
    var city = ($city.val() || '').trim();
    var firstInvalid = null;
    var messages = [];

    if (!name) {
      markInvalid($name[0]);
      messages.push('Please enter your name');
      firstInvalid = firstInvalid || $name;
    }
    if (!mobile || mobile.length !== 10) {
      markInvalid($mobile[0]);
      messages.push('Please enter a valid 10-digit mobile number');
      firstInvalid = firstInvalid || $mobile;
    }
    if (email && !/^[\w.+-]+@([\w-]+\.)+[\w-]{2,}$/.test(email)) {
      markInvalid($email[0]);
      messages.push('Please enter a valid email');
      firstInvalid = firstInvalid || $email;
    }
    if ($city.length && !city) {
      markInvalid($city[0]);
      messages.push('Please select a clinic location');
      firstInvalid = firstInvalid || $city;
    }
    if ($consent.length && !$consent.is(':checked')) {
      markInvalid($consent[0]);
      setConsentMessage($consent, 'Contact consent is required.');
      messages.push('Contact consent is required.');
      firstInvalid = firstInvalid || $consent;
    }

    if (firstInvalid && firstInvalid.length) {
      firstInvalid.trigger('focus');
    }

    return {
      ok: messages.length === 0,
      message: messages[0] || ''
    };
  }

  $(function () {
    ensureErrorStyles();

    // Clear highlight as the user fixes a field
    $(document).on('input change', '#lead_otp .input, #lead_otp select, #lead_otp [name="contact_consent"], #calcForm .input, #calcForm select, #calcForm [name="contact_consent"]', function () {
      markValid(this);
    });

    if ($('#lead_otp').length && $.fn.validate) {
      $('#lead_otp').validate({
        focusInvalid: true,
        ignore: '',
        errorClass: 'error',
        validClass: 'valid',
        rules: {
          name: { required: true },
          mobile_no: { required: true, minlength: 10, maxlength: 10 },
          email: { required: false, email: true },
          cliniccity: { required: true },
          contact_consent: { required: true }
        },
        messages: {
          name: 'Please enter your name',
          mobile_no: 'Please enter a valid 10-digit mobile number',
          email: 'Please enter a valid email',
          cliniccity: 'Please select a clinic location',
          contact_consent: 'Contact consent is required.'
        },
        highlight: function (element) {
          markInvalid(element);
        },
        unhighlight: function (element) {
          markValid(element);
        },
        invalidHandler: function (event, validator) {
          // Ensure every invalid field is highlighted (not only the first)
          clearFormHighlights($('#lead_otp'));
          $.each(validator.errorList, function (_, item) {
            markInvalid(item.element);
            if (item.element && item.element.name === 'contact_consent') {
              setConsentMessage($(item.element), item.message);
            }
          });
          if (validator.errorList.length) {
            $(validator.errorList[0].element).trigger('focus');
          }
        },
        errorPlacement: function (error, element) {
          if (element.attr('name') === 'contact_consent') {
            setConsentMessage(element, error.text());
            return;
          }
          var existing = element.next('label.error');
          if (existing.length) {
            existing.text(error.text()).show();
            return;
          }
          error.insertAfter(element);
        },
        success: function (label, element) {
          if (element) markValid(element);
          if (label && label.length && !label.hasClass('contact-consent-error') && !label.attr('id')) {
            label.remove();
          } else if (label && label.length) {
            label.text('').hide();
          }
        },
        submitHandler: function (form, event) {
          if (event) event.preventDefault();
          var $form = $(form);
          var check = validateLeadForm($form);
          if (!check.ok) {
            showMessage(check.message, true);
            return false;
          }
          submitLead($form, 'lead_otp');
          return false;
        }
      });
    } else if ($('#lead_otp').length) {
      $('#lead_otp').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);
        var check = validateLeadForm($form);
        if (!check.ok) {
          showMessage(check.message, true);
          return;
        }
        submitLead($form, 'lead_otp');
      });
    }

    // calcForm is handled by landing-calculator.js (multi-step modal)
    if ($('#calcForm').length && !document.querySelector('script[src*="landing-calculator"]')) {
      $('#calcForm').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);
        var check = validateLeadForm($form);
        if (!check.ok) {
          showMessage(check.message, true);
          return;
        }
        submitLead($form, 'calcForm');
      });
    }

    // Expose helpers for landing-calculator.js
    window.AK_FORM_ERRORS = {
      fieldErrorClass: FIELD_ERROR,
      ensureErrorStyles: ensureErrorStyles,
      markInvalid: markInvalid,
      markValid: markValid,
      clearFormHighlights: clearFormHighlights,
      setConsentMessage: setConsentMessage
    };
  });
})(window, document, window.jQuery);

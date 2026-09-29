/**
 * Landing lead forms → CodeIgniter submit-lead (Campaign Leads API).
 * Expects window.AK_LANDING = { submitUrl, pageType, locationSlug, city }
 */
(function (window, document, $) {
  'use strict';

  if (!$) return;

  var SUCCESS_MSG = 'Thank you! Your request has been submitted. Our team will contact you shortly.';

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
      norwood_stage: $form.find('[name="norwood_stage"]').val() || ''
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
    // Fallback only if SweetAlert failed to load
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

  $(function () {
    if ($('#lead_otp').length && $.fn.validate) {
      $('#lead_otp').validate({
        focusInvalid: false,
        ignore: '',
        rules: {
          name: { required: true },
          mobile_no: { required: true, minlength: 10, maxlength: 10 },
          email: { required: false, email: true },
          cliniccity: { required: true }
        },
        messages: {
          name: 'Please enter your name',
          mobile_no: 'Please enter a valid 10-digit mobile number',
          email: 'Please enter a valid email',
          cliniccity: 'Please select a clinic location'
        },
        submitHandler: function (form, event) {
          if (event) event.preventDefault();
          submitLead($(form), 'lead_otp');
          return false;
        }
      });
    } else if ($('#lead_otp').length) {
      $('#lead_otp').on('submit', function (e) {
        e.preventDefault();
        submitLead($(this), 'lead_otp');
      });
    }

    // calcForm is handled by landing-calculator.js (multi-step modal)
    if ($('#calcForm').length && !document.querySelector('script[src*="landing-calculator"]')) {
      $('#calcForm').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);
        var name = $form.find('[name="name"]').val();
        var mobile = $form.find('[name="mobile_no"], [name="mobile"]').val();
        if (!name || !mobile) {
          showMessage('Please enter your name and phone number.', true);
          return;
        }
        submitLead($form, 'calcForm');
      });
    }
  });
})(window, document, window.jQuery);

/**
 * Multi-step cost calculator modal for landing pages.
 * Submits leads via window.AK_LANDING.submitUrl (Campaign Leads API proxy).
 * Image uploads are UI-only (API does not accept files).
 */
(function (window, document, $) {
  'use strict';

  if (!$ || !window.AK_LANDING) return;

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
      norwood_stage: $('#norwoodStage').val() || ''
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

  $(function () {
    var leadSubmitted = false;

    // Step 1 → 2: validate + submit lead early (matches prior UX)
    $('#toStep2').off('click').on('click', function () {
      var name = ($('#ccName').val() || '').trim();
      var phone = ($('#ccPhone').val() || '').trim();
      var city = ($('#ccCity').val() || '').trim();
      var email = ($('#ccEmail').val() || '').trim();
      var phoneDigits = phone.replace(/\D/g, '');

      if (!name) { showMessage('Please enter your name', true); return; }
      if (phoneDigits.length < 10 || phoneDigits.length > 14) {
        showMessage('Please enter a valid phone number (10-14 digits)', true);
        return;
      }
      if (!city) { showMessage('Please enter your city', true); return; }
      if (email && !/^[\w.+-]+@([\w-]+\.)+[\w-]{2,}$/.test(email)) {
        showMessage('Please enter a valid email', true);
        return;
      }

      var $btn = $(this);
      $btn.prop('disabled', true);

      postLead('calcForm', function () {
        leadSubmitted = true;
        $('#step1').hide();
        $('#step2').show();
        $btn.prop('disabled', false);
      }, function (msg) {
        showMessage(msg, true);
        $btn.prop('disabled', false);
      });
    });

    $('#backTo1').off('click').on('click', function () {
      $('#step2').hide();
      $('#step1').show();
    });

    $('.scale-card').off('click').on('click', function () {
      $('.scale-card').removeClass('active');
      $(this).addClass('active');
      $('#norwoodStage').val($(this).data('stage'));
      $('#toStep3').prop('disabled', false);
    });

    $('#toStep3').off('click').on('click', function () {
      if (!$('#norwoodStage').val()) {
        showMessage('Please select a hair loss stage', true);
        return;
      }
      $('#step2').hide();
      $('#step3').show();
    });

    $('#backTo2').off('click').on('click', function () {
      $('#step3').hide();
      $('#step2').show();
    });

    // Final submit: if lead already sent at step1, just show results; else submit now
    $('#calcForm').off('submit').on('submit', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();

      var userName = ($('#ccName').val() || '').trim();
      var norwoodStage = parseInt($('#norwoodStage').val(), 10) || 0;

      function showThanks() {
        $('#thanksName').text(userName);
        $('#nwStage').text(norwoodStage || '-');
        if ($('#treatmentMessage').length) {
          $('#treatmentMessage').html(treatmentMessage(norwoodStage));
        }
        $('#step3').hide();
        $('#step4').show();
      }

      if (leadSubmitted) {
        showThanks();
        return;
      }

      postLead('calcForm', function () {
        leadSubmitted = true;
        showThanks();
      }, function (msg) {
        showMessage(msg, true);
      });
    });

    $('#closeDone').off('click').on('click', function () {
      $('#calcModal').removeClass('open').attr('aria-hidden', 'true');
      $('body').removeClass('modal-open');
    });
  });
})(window, document, window.jQuery);

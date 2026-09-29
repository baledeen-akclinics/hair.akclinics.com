/**
 * Landing page tracking: capture UTMs / click IDs, persist first-touch,
 * refresh last-touch. No API secrets here.
 */
(function (window, document) {
  'use strict';

  var STORAGE_KEY = 'ak_landing_attribution';
  var COOKIE_DAYS = 90;

  function nowIso() {
    return new Date().toISOString();
  }

  function getParam(name) {
    try {
      return new URLSearchParams(window.location.search).get(name) || '';
    } catch (e) {
      return '';
    }
  }

  function readStore() {
    try {
      var raw = localStorage.getItem(STORAGE_KEY);
      return raw ? JSON.parse(raw) : null;
    } catch (e) {
      return null;
    }
  }

  function writeStore(data) {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
    } catch (e) { /* ignore */ }

    try {
      var expires = new Date();
      expires.setDate(expires.getDate() + COOKIE_DAYS);
      document.cookie = STORAGE_KEY + '=' + encodeURIComponent(JSON.stringify(data))
        + ';expires=' + expires.toUTCString()
        + ';path=/;SameSite=Lax';
    } catch (e) { /* ignore */ }
  }

  function inferChannel(source, medium) {
    source = (source || '').toLowerCase();
    medium = (medium || '').toLowerCase();
    if (medium === 'cpc' || medium === 'ppc' || medium === 'paid') {
      if (source.indexOf('facebook') >= 0 || source.indexOf('fb') >= 0 || source.indexOf('ig') >= 0) {
        return 'paid_social';
      }
      return 'paid_search';
    }
    if (medium === 'organic' || source === 'google' && !medium) return 'organic_search';
    if (medium === 'referral') return 'referral';
    if (medium === 'email') return 'email';
    if (!source && !medium) return 'direct';
    return medium || 'other';
  }

  function currentTouch() {
    var utmSource = getParam('utm_source');
    var utmMedium = getParam('utm_medium');
    var utmCampaign = getParam('utm_campaign');
    var utmContent = getParam('utm_content');
    var utmTerm = getParam('utm_term');
    var gclid = getParam('gclid');
    var fbclid = getParam('fbclid');

    if (gclid && !utmSource) {
      utmSource = 'google';
      utmMedium = utmMedium || 'cpc';
    }
    if (fbclid && !utmSource) {
      utmSource = 'facebook';
      utmMedium = utmMedium || 'cpc';
    }

    var hasMarketing = !!(utmSource || utmMedium || utmCampaign || gclid || fbclid);

    return {
      hasMarketing: hasMarketing,
      source: utmSource || (hasMarketing ? '' : 'direct'),
      medium: utmMedium || (hasMarketing ? '' : 'none'),
      channel: inferChannel(utmSource, utmMedium),
      campaign: utmCampaign,
      referrer: document.referrer || '',
      landing_page: window.location.href.split('#')[0],
      at: nowIso(),
      utm_source: utmSource,
      utm_medium: utmMedium,
      utm_campaign: utmCampaign,
      utm_content: utmContent,
      utm_term: utmTerm,
      gclid: gclid,
      fbclid: fbclid
    };
  }

  function ensureAttribution() {
    var touch = currentTouch();
    var stored = readStore() || {};
    var updated = false;

    if (!stored.first_touch_at) {
      stored.first_touch_source = touch.source || null;
      stored.first_touch_medium = touch.medium || null;
      stored.first_touch_channel = touch.channel || null;
      stored.first_touch_campaign = touch.campaign || null;
      stored.first_touch_referrer = touch.referrer || null;
      stored.first_touch_landing_page = touch.landing_page || null;
      stored.first_touch_at = touch.at;
      updated = true;
    }

    if (touch.hasMarketing || !stored.last_touch_at) {
      stored.last_touch_source = touch.source || stored.last_touch_source || null;
      stored.last_touch_medium = touch.medium || stored.last_touch_medium || null;
      stored.last_touch_channel = touch.channel || stored.last_touch_channel || null;
      stored.last_touch_campaign = touch.campaign || stored.last_touch_campaign || null;
      stored.last_touch_referrer = touch.referrer || stored.last_touch_referrer || null;
      stored.last_touch_landing_page = touch.landing_page || stored.last_touch_landing_page || null;
      stored.last_touch_at = touch.at;
      updated = true;
    }

    if (touch.utm_source) { stored.utm_source = touch.utm_source; updated = true; }
    if (touch.utm_medium) { stored.utm_medium = touch.utm_medium; updated = true; }
    if (touch.utm_campaign) { stored.utm_campaign = touch.utm_campaign; updated = true; }
    if (touch.utm_content) { stored.utm_content = touch.utm_content; updated = true; }
    if (touch.utm_term) { stored.utm_term = touch.utm_term; updated = true; }
    if (touch.gclid) { stored.gclid = touch.gclid; updated = true; }
    if (touch.fbclid) { stored.fbclid = touch.fbclid; updated = true; }

    if (updated) writeStore(stored);
    return stored;
  }

  function getAttribution() {
    return ensureAttribution();
  }

  window.AKLandingTracking = {
    getAttribution: getAttribution,
    ensure: ensureAttribution
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', ensureAttribution);
  } else {
    ensureAttribution();
  }
})(window, document);

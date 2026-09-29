<?php
/**
 * Shared hero lead form (#lead_otp).
 *
 * @var string|null $campaign_id
 * @var string $source_id
 * @var string $page_type
 * @var string $location_slug
 * @var string $service
 * @var string $landing_page
 * @var array $clinic_options
 */
?>
                <form id="lead_otp" style="display:grid;gap:12px">
                    <input type="hidden" name="lp_url" value="<?= esc(base_url()) ?>" />
<input type="hidden" name="lead_source" value="<?= esc($campaign_id ?? $source_id, 'attr') ?>">
                    <input type="hidden" name="page_type" value="<?= esc($page_type, 'attr') ?>">
                    <input type="hidden" name="location_slug" value="<?= esc($location_slug, 'attr') ?>">
                    <input type="hidden" name="service" value="<?= esc($service, 'attr') ?>">
                    <input type="hidden" name="paid_lead" value="yes">
                    <input type="hidden" name="utm_source" value="">
                    <input type="hidden" name="utm_medium" value="">
                    <input type="hidden" name="utm_campaign" value="">
                    <input type="hidden" name="utm_content" value="">
                    <input type="hidden" name="utm_term" value="">
                    <input type="hidden" name="gclid" value="">
                    <input type="hidden" name="fbclid" value="">
                    <input type="hidden" name="first_touch_source" value="">
                    <input type="hidden" name="first_touch_medium" value="">
                    <input type="hidden" name="first_touch_channel" value="">
                    <input type="hidden" name="first_touch_campaign" value="">
                    <input type="hidden" name="first_touch_referrer" value="">
                    <input type="hidden" name="first_touch_landing_page" value="">
                    <input type="hidden" name="first_touch_at" value="">
                    <input type="hidden" name="last_touch_source" value="">
                    <input type="hidden" name="last_touch_medium" value="">
                    <input type="hidden" name="last_touch_channel" value="">
                    <input type="hidden" name="last_touch_campaign" value="">
                    <input type="hidden" name="last_touch_referrer" value="">
                    <input type="hidden" name="last_touch_landing_page" value="">
                    <input type="hidden" name="last_touch_at" value="">

                    <input type="hidden" name="page_url" value="<?= esc($landing_page) ?>">

                    <input class="input" placeholder="Enter Name" name="name">
                    <label id="name-error" class="error" for="name"></label>

                    <input class="input" type="tel" placeholder="Enter Phone Number" name="mobile_no" minlength="10"
                        maxlength="10" oninput='this.value=this.value.replace(/[^0-9]/g,"")'>
                    <label id="mobile_no-error" class="error" for="mobile_no"></label>

                    <input class="input" placeholder="Enter Email" name="email">

                    <select id="city" name="cliniccity" class="input">
                        <option value="">Clinic Location</option>
                        <?php foreach ($clinic_options as $slug => $opt): ?>
                        <option value="<?= esc($opt['city_api'], 'attr') ?>" <?= $location_slug === $slug ? 'selected' : '' ?>><?= esc($opt['label']) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit" class="btn-primary">Submit Now</button>
                </form>
                <div id="sendlead-show" style="display:none;">Thank you! Your lead is submitted.</div>
                <div class="form-note">Get a free hair assessment reports. T&C apply.</div>

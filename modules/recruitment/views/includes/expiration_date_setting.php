<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="form-group">
    <div class="col-md-4">
        <label style="font-size: 18px;" for="recruitment_tab_expiration_date_setting">Set an expiration warning alert</label>
    </div>
    <div class="col-md-2">
        <input type="number" class="form-control" onchange="tab_expiration_date_setting(); return false" id="recruitment_tab_expiration_date_setting" name="purchase_setting[recruitment_tab_expiration_date_setting]" value="<?php echo get_tab_option('recruitment_tab_expiration_date_setting'); ?>">
    </div>
    <div class="col-md-4">
        <label style="font-size: 18px;" for="recruitment_tab_expiration_date_setting">days before the expiration date</label>
    </div>
</div>
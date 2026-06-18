<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="form-group">
    <div class="checkbox checkbox-primary">
        <input onchange="tab_display_setting_hris(this); return false" type="checkbox" id="hris_setting_option" name="purchase_setting[hris_setting_option]"
            <?php if (get_tab_option('hris_setting_option') == 1) {
                echo 'checked';
            } ?> value="hris_setting_option">
        <label for="hris_setting_option"><?php echo _l('hris_setting_option_label'); ?>
        </label>
    </div>
</div>
<div class="clearfix"></div>
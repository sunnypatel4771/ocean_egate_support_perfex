<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="form-group">
    <div class="checkbox checkbox-primary">
        <input onchange="tab_display_setting_reward(this); return false" type="checkbox" id="recruitment_create_campaign_tab_reward" name="purchase_setting[recruitment_create_campaign_tab_reward]" <?php
                                                                                                                                                                                                        if (get_tab_option('recruitment_create_campaign_tab_reward') == 1) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> value="recruitment_create_campaign_tab_reward">
        <label for="recruitment_create_campaign_tab_reward"><?php echo _l('create_recruitment_campaign_not_tab_reward'); ?>
        </label>
    </div>
</div>

<div class="form-group">
    <div class="checkbox checkbox-primary">
        <input onchange="tab_display_setting_medical(this); return false" type="checkbox" id="recruitment_create_campaign_tab_medical" name="purchase_setting[recruitment_create_campaign_tab_medical]" <?php
                                                                                                                                                                                                        if (get_tab_option('recruitment_create_campaign_tab_medical') == 1) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> value="recruitment_create_campaign_tab_medical">
        <label for="recruitment_create_campaign_tab_medical"><?php echo _l('create_recruitment_campaign_not_tab_medical'); ?>
        </label>
    </div>
</div>

<div class="form-group">
    <div class="checkbox checkbox-primary">
        <input onchange="tab_display_setting_psc(this); return false" type="checkbox" id="recruitment_create_campaign_tab_psc" name="purchase_setting[recruitment_create_campaign_tab_psc]" <?php
                                                                                                                                      if (get_tab_option('recruitment_create_campaign_tab_psc') == 1) {
                                                                                                                                          echo 'checked';
                                                                                                                                      } ?> value="recruitment_create_campaign_tab_psc">
        <label for="recruitment_create_campaign_tab_psc"><?php echo _l('create_recruitment_campaign_not_tab_psc'); ?>
        </label>
    </div>
</div>

<div class="form-group">
    <div class="checkbox checkbox-primary">
        <input onchange="tab_display_setting_recruitment_history(this); return false" type="checkbox" id="recruitment_create_campaign_tab_recruitment_history" name="purchase_setting[recruitment_create_campaign_tab_recruitment_history]" <?php
           if (get_tab_option('recruitment_create_campaign_tab_recruitment_history') == 1) {
                    echo 'checked';
        } ?> value="recruitment_create_campaign_tab_recruitment_history">
        <label for="recruitment_create_campaign_tab_recruitment_history"><?php echo _l('create_recruitment_campaign_not_recruitment_history'); ?>
        </label>
    </div>
</div>


<div class="form-group">
    <div class="checkbox checkbox-primary">
        <input onchange="tab_display_setting_capacity_profile(this); return false" type="checkbox" id="recruitment_create_campaign_tab_capacity_profile" name="purchase_setting[recruitment_create_campaign_tab_capacity_profile]" <?php
           if (get_tab_option('recruitment_create_campaign_tab_capacity_profile') == 1) {
                    echo 'checked';
            } ?> value="recruitment_create_campaign_tab_capacity_profile">
        <label for="recruitment_create_campaign_tab_capacity_profile"><?php echo _l('create_recruitment_campaign_not_capacity_profile'); ?>
        </label>
    </div>
</div>


<div class="form-group">
    <div class="checkbox checkbox-primary">
        <input onchange="tab_display_setting_promotion(this); return false" type="checkbox" id="recruitment_create_campaign_tab_promotion" name="purchase_setting[recruitment_create_campaign_tab_promotion]" <?php
           if (get_tab_option('recruitment_create_campaign_tab_promotion') == 1) {
                    echo 'checked';
            } ?> value="recruitment_create_campaign_tab_promotion">
        <label for="recruitment_create_campaign_tab_promotion"><?php echo _l('create_recruitment_campaign_not_promotion'); ?>
        </label>
    </div>
</div>

<div class="form-group">
    <div class="checkbox checkbox-primary">
        <input onchange="tab_display_setting_contract(this); return false" type="checkbox" id="contract" name="purchase_setting[contract]" <?php
           if (get_tab_option('contract') == 1) {
                    echo 'checked';
            } ?> value="contract">
        <label for="contract"><?php echo _l('contract'); ?>
        </label>
    </div>
</div>

<div class="clearfix"></div>
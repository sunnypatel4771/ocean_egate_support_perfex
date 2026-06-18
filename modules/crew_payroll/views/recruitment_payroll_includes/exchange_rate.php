<div class="row">
    <?php
    echo form_open(admin_url('crew_payroll/save_recruitment_payroll'))
    ?>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-3" style="font-size: 17px;">1 USD = </div>
            <div class="col-sm-9" style="font-size: 17px;">
                <?php
                $saved_1_usd_to_php = get_option('1_usd_to_php');
                ?>
                <input type="number" id="1_usd_to_php" name="1_usd_to_php" value="<?php echo $saved_1_usd_to_php; ?>"> PHP
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <button id="sm_btn_conpany" type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
    </div>
    <?php
    echo form_close();
    ?>
</div>
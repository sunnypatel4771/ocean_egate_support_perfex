
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-sm-12" style="width: 100%;">
        <table class="table table-bordered">
            <thead>
                <tr class="row" style="margin: auto;margin-bottom: 10px;">
                    <th>
                        <div class="col-sm-1 text-center"></div>
                    </th>
                    <th>
                        <div class="col-sm-3 text-center">From</div>
                    </th>
                    <th>
                        <div class="col-sm-3 text-center">To</div>
                    </th>
                    <th>
                        <div class="col-sm-2 text-center">Amount</div>
                    </th>
                    <th>
                        <div class="col-sm-2 text-center">Remarks</div>
                    </th>
                    <th>
                        <div class="col-sm-1 text-center">Action</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < 30; $i++) {
                    $no = $i;
                ?>
                    <tr class="row" style="margin: auto;">
                        <td>
                            <div class="text-center" data-id="<?php echo ++$no; ?>">
                                <?php echo $no; ?>
                            </div>
                        </td>
                        <td>
                            <div class="text-center from_data_<?php echo $no; ?>">
                                <?php
                                $from = get_sss_setting($no, 'from');
                                ?>
                                <p class="info_from from_data_info_<?php echo $no; ?>"><?php echo $from; ?></p>
                                <input type="text" class="form-control input_from_data_<?php echo $no; ?>" name="input_from_data_<?php echo $no; ?>" id="input_from_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none;">
                            </div>
                        </td>
                        <td>
                            <div class="text-center to_data_<?php echo $no; ?>">
                                <p class="info_to to_data_info_<?php echo $no; ?>"><?php echo get_sss_setting($no, 'to'); ?></p>
                                <input type="text" class="form-control input_to_data_<?php echo $no; ?>" name="input_to_data_<?php echo $no; ?>" id="input_to_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none;">
                            </div>
                        </td>
                        <td>
                            <div class="text-center amount_data_<?php echo $no; ?>">
                                <p class="amount_data_info_<?php echo $no; ?>"><?php echo get_sss_setting($no, 'amount'); ?></p>
                                <input type="text" class="form-control input_amount_data_<?php echo $no; ?>" name="input_amount_data_<?php echo $no; ?>" id="input_amount_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none;">
                            </div>
                        </td>
                        <td>
                            <div class="text-center remarks_data_<?php echo $no; ?>">
                                <p class="remarks_data_info_<?php echo $no; ?>"><?php echo get_sss_setting($no, 'remarks'); ?></p>
                                <input type="text" class="form-control input_remarks_data_<?php echo $no; ?>" name="input_remarks_data_<?php echo $no; ?>" id="input_remarks_data_<?php echo $no; ?>" style="margin-bottom: 5px; display: none;">
                            </div>
                        </td>
                        <td>
                            <div class="text-center">
                                <i class="fa fa-edit edit_tab edit_tab_<?php echo $no; ?>" data-id="<?php echo $no; ?>"></i>
                                <button class="btn btn-info save save_<?php echo $no; ?>" style="display: none;" data-id="<?php echo $no; ?>">Save</button>
                            </div>
                        </td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>
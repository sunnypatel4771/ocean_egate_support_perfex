<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-sm-12">
        <button class="btn btn-info" id="add_new_payroll_period_btn">Add New</button>
    </div>

    <div class="col-sm-12" style="margin-top: 10px;">
        <table class="table table-bordered dt-table dt-inline dataTable no-footer">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Days</th>
                    <th>Exchange Rate</th>
                    <th>Payroll Reference</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($payroll_period_data) && !empty($payroll_period_data)) {
                    foreach ($payroll_period_data as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['from']; ?></td>
                            <td><?php echo $value['to']; ?></td>
                            <td><?php echo $value['days']; ?></td>
                            <td><?php echo $value['exchange_rate']; ?></td>
                            <td><?php echo $value['payroll_reference']; ?></td>
                            <td><?php echo $value['remarks']; ?></td>
                            <td>
                                <button class="edit_payroll_period" data-id="<?php echo $value['id']; ?>" style="border: none; background: none;">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <a href="<?php echo admin_url('crew_payroll/delete_payroll_period/' . $value['id']); ?>" class="_delete" style="border: none; background: none;">
                                    <i class="fa-regular fa-trash-can fa-lg" style="color: red;"></i>
                                </a>
                            </td>
                        </tr>
                <?php }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="payroll_period_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <?php echo form_open(admin_url('crew_payroll/save_payroll_period'), ['id' => 'payroll_period_form']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <span class="add-title">Add Payroll</span>
                    <span class="edit-title">Edit Payroll</span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="id" id="id">

                    <div class="col-sm-12">
                        <?php echo render_date_input('from', _l('from')); ?>
                    </div>

                    <div class="col-sm-12">
                        <?php echo render_date_input('to', _l('to')); ?>
                    </div>

                    <div class="col-sm-12">
                        <?php echo render_input('days', _l('days'), '', 'text', ['readonly' => 'readonly']); ?>
                    </div>

                    <div class="col-sm-12">
                        <?php echo render_input('exchange_rate', _l('exchange_rate'), '', 'number'); ?>
                    </div>

                    <div class="col-sm-12">
                        <?php echo render_input('remarks', _l('remarks')); ?>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
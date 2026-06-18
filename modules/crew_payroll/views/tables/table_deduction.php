<?php
$table = db_prefix() . 'rec_deduction';
defined('BASEPATH') or exit('No direct script access allowed');
$aColumns = [
    'id',
    'status',
    'candidate_id',
    'name',
    'bank_acc',
    'amount',
    'deduction_memo',
    'file',
    'remark',
];
$sIndexColumn = 'id';
$sTable       = $table;
$result = data_tables_init($aColumns, $sIndexColumn, $sTable, [], [], []);
$output  = $result['output'];
$rResult = $result['rResult'];
$ded_no = 0;
foreach ($rResult as $aRow) {
    $new_aColumns = [];
    for ($i = 0; $i < count($aColumns); $i++) {
        $C = $aColumns[$i];
        $name = explode(" ", $C);
        $last_word = end($name);
        $new_aColumns[] = $last_word;
    }
    $row = [];
    for ($i = 0; $i < count($new_aColumns); $i++) {
        if ($new_aColumns[$i] == 'id') {
            $row[][] = ++$ded_no;
        }
        if ($new_aColumns[$i] == 'status') {
            if ($aRow[$new_aColumns[$i]] == 1) {
                $status = '<input type="checkbox" checked disabled>';
            } else {
                $status = '<input type="checkbox" disabled>';
            }
            $row[][] = $status;
        }
        if ($new_aColumns[$i] == 'name') {
            $row[][] = $aRow['name'];
        }
        if ($new_aColumns[$i] == 'bank_acc') {
            $row[][] = $aRow['bank_acc'];
        }
        if ($new_aColumns[$i] == 'amount') {
            $row[][] = $aRow['amount'];
        }
        if ($new_aColumns[$i] == 'deduction_memo') {
            $row[][] = $aRow['deduction_memo'];
        }
        if ($new_aColumns[$i] == 'file') {
            $file = $aRow['file'];
            if ($file != '') {
                $ded_file_path = site_url("modules/" . CREW_PAYROLL_MODULE_NAME . '/uploads/deduction/' . $aRow['candidate_id'] . '/' . $aRow['file']);
            }
            if ($ded_file_path != '') {
                $file_html = '<img src="' . $ded_file_path . '" height="80px" width="auto">';
            } else {
                $file_html = '';
            }
            $row[][] = $file_html;
        }
        if ($new_aColumns[$i] == 'remark') {
            $row[][] = $aRow['remark'];
        }
    }
    $row[][] = '<div class="tw-flex tw-items-center tw-space-x-3">
                                   <button style="border: none; background: none;" id="edit_deduction" data-id="' . $aRow['id'] . '"><i class="fa-regular fa-pen-to-square fa-lg"></i></button>

                                <a href="' . admin_url('crew_payroll/delete_deduction/' . $aRow['id'] . '/' . $aRow['candidate_id']) . '" class="_delete" style="border: none; background: none;" data-id="' . $aRow['id'] . '"><i class="fa-regular fa-trash-can fa-lg" style="color: red;"></i></a>
                            </div>';
    $output['aaData'][] = $row;
}
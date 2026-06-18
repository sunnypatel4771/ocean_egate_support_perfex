<?php 
defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'order_no',
    'status',
    'color',
    '1',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'job_followup';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, [], [], ['id']);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $row[] = $aRow['order_no'];
    $row[] = $aRow['status'];
    $row[] = '<span style="color: '.$aRow['color'].'">'.$aRow['color'].'</span>';

    $buttons = '<a style="cursor:pointer;" id="edit_followup" data-id="' . $aRow['id'] . '" data-status="' . htmlspecialchars($aRow['status']) .'" data-color="' . $aRow['color'] . '" data-order_no="' . $aRow['order_no'] . '" class="fa-regular fa-pen-to-square fa-lg" onclick="edit_followup(this, ' . $aRow['id'] . '); return false;"></a> ';
    
    // Create delete button
    $buttons .= '<a style="cursor:pointer;color:red;" href="' . admin_url('recruitment/delete_followup/' . $aRow['id']) . '" class="fa-regular fa-trash-can fa-lg _delete"></a>';
    
    $row[] = $buttons;

    $output['aaData'][] = $row;
}

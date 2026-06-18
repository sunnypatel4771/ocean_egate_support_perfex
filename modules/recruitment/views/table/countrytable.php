<?php 
defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'name',
    '1',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'countries_new';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, [], [], ['id']);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $row[] = $aRow['name'];

    $buttons = '<a style="cursor:pointer;" id="edit_country" data-id="' . $aRow['id'] . '" data-name="' . htmlspecialchars($aRow['name']) .'" class="fa-regular fa-pen-to-square fa-lg" onclick="edit_country(this, ' . $aRow['id'] . '); return false;"></a>';
    
    // Create delete button
    $buttons .= '<a style="cursor:pointer;color:red;" href="' . admin_url('recruitment/delete_country/' . $aRow['id']) . '" class="fa-regular fa-trash-can fa-lg _delete"></a>';
    
    $row[] = $buttons;

    $output['aaData'][] = $row;
}

<?php 
defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'country_id',
    'name',
    '1',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'states_new';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, [], [], ['id']);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $row[] = get_country_name_by_id($aRow['country_id']);
    
    // Assign the city name
    $row[] = $aRow['name'];

    // Create edit button
    $buttons = '<a style="cursor:pointer;" id="edit_state" data-id="' . $aRow['id'] . '" data-name="' . htmlspecialchars($aRow['name']) . '" data-country="' . $aRow['country_id'] . '" class="fa-regular fa-pen-to-square fa-lg" onclick="edit_state(this, ' . $aRow['id'] . '); return false;"></a> ';
    
    // Create delete button
    $buttons .= '<a style="cursor:pointer;color:red;" href="' . admin_url('recruitment/delete_state/' . $aRow['id']) . '" class="fa-regular fa-trash-can fa-lg _delete"></a>';
    
    $row[] = $buttons;

    $output['aaData'][] = $row;
}

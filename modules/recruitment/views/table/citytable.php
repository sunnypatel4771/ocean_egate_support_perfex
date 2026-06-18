<?php 
defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'state_id',
    'name',
    '1',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'cities_new';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, [], [], ['id']);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $state_info = get_state_name_by_id($aRow['state_id']);

    $row[] = $state_info->name;
    // Assign the city name
    $row[] = $aRow['name'];

    // Create edit button
    $buttons = '<a style="cursor:pointer;" id="edit_city" data-id="' . $aRow['id'] . '" data-name="' . htmlspecialchars($aRow['name'], ENT_QUOTES, 'UTF-8') . '" data-state="' . $aRow['state_id'] . '" data-country="' . $state_info->country_id . '" class="fa-regular fa-pen-to-square fa-lg" onclick="edit_city(this, ' . $aRow['id'] . '); return false;"></a> ';
    
    // Create delete button
    $buttons .= '<a style="cursor:pointer;color:red;" href="' . admin_url('recruitment/delete_city/' . $aRow['id']) . '" class="fa-regular fa-trash-can fa-lg _delete"></a>';
    
    $row[] = $buttons;

    $output['aaData'][] = $row;
}

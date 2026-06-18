<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Checkwriter
Description: Checkwriter
Version: 1.1.0
Perfex Version: 3.1.6
Requires at least: 2.3.*
Author: Egate
*/

define('CHECKWRITER_MODULE', 'checkwriter');

register_language_files(CHECKWRITER_MODULE, [CHECKWRITER_MODULE]);

register_activation_hook(CHECKWRITER_MODULE, 'checkwriter_activation_hook');

hooks()->add_action('admin_init', 'checkwriter_init_menu_items');

$CI = &get_instance();
$CI->load->helper(CHECKWRITER_MODULE . '/checkwriter');


function checkwriter_activation_hook()
{
  $CI = &get_instance();
  require_once(__DIR__ . '/install.php');
}

hooks()->add_action('after_expense_updated', 'checkwriter_expense_conversion', 10, 1);

hooks()->add_action('after_expense_added', 'checkwriter_expense_conversion', 10, 1);

hooks()->add_action('expenses_table_row_data', 'checkwriter_expenses_table_row_data', 10, 2);
hooks()->add_action('expenses_table_sql_columns', 'checkwriter_expenses_table_columns', 10, 1);


// Register deactivation module hook
register_deactivation_hook(CHECKWRITER_MODULE, 'checkwriter_deactivation_hook');

// Register uninstall module hook
register_uninstall_hook(CHECKWRITER_MODULE, 'checkwriter_uninstall_hook');


function checkwriter_deactivation_hook()
{
  require_once(__DIR__ . '/uninstall.php');
}

function checkwriter_uninstall_hook()
{
  require_once(__DIR__ . '/uninstall.php');
}

function checkwriter_expense_conversion($id)
{
  $CI = &get_instance();
  $CI->load->model('Expenses_model');
  $CI->load->model('checkwriter/checkwriter_modal');
  $data = $CI->expenses_model->get($id);

  $get_data = [];
  $get_data['expensive_id'] = $data->id;
  $get_data['amount'] = $data->amount;
  $get_data['date'] = $data->date;

  $is_activated = is_activated_module('accounting');

  if ($data->vendor_payee != '' && $data->check_payee == 1) {
    $get_data['vendor_payee'] = $data->vendor_payee;
  } else {
    if ($is_activated == '' && $is_activated == 0) {
      $get_data['vendor_payee'] = $data->name;
    } else {
      $get_data['vendor_payee'] = acc_get_vendor_name($data->vendor);
    }
  }
  $get_data['note'] = $data->note;


  if ($data->issue_payment_check == 1) {
    $CI->checkwriter_modal->add_expensive_history($get_data);
  }

  return $id;
}

function checkwriter_init_menu_items()
{
  $CI = &get_instance();

  if (has_permission('checkwriter_module', '', 'view')) {
    $CI->app_menu->add_setup_children_item('finance', [
      'slug' => 'child_checkwriter_module',
      'name' => _l('checkwriter_bank'),
      'href' => admin_url('checkwriter/banklist'),
      'position' => 1,
    ]);
  }

  if (has_permission('checkwriter_module', '', 'view')) {
    $CI->app_menu->add_sidebar_menu_item('checkwriter_module', [
      'slug'     => 'check_issuance',
      'name'     => _l('check_issuance'),
      'icon'     => 'fa-solid fa-money-check',
      'position' => 30,
      'badge'    => [],
    ]);
  }

  if (has_permission('checkwriter_module', '', 'view')) {
    $CI->app_menu->add_sidebar_children_item('checkwriter_module', [
      'slug'     => 'check_issuance',
      'name'     => _l('check_issuance'),
      'href'     => admin_url('checkwriter/checkIssuance'),
      'icon'     => 'fa-solid fa-money-check',
      'position' => 30,
      'badge'    => [],
    ]);
  }

  if (has_permission('checkwriter_module', '', 'view')) {
    $CI->app_menu->add_sidebar_children_item('checkwriter_module', [
      'slug'     => 'marginset',
      'name'     => _l('marginset'),
      'href'     => admin_url('checkwriter/managesetting'),
      'icon'     => 'fas fa-cogs menu-icon',
      'position' => 30,
      'badge'    => [],
    ]);
  }
}

function checkwriter_expenses_table_row_data($row, $aRow)
{
  $ci = get_instance();
  $paymentModeOutput = '';
  $issue_payment_check = isset($aRow['issue_payment_check']) ? $aRow['issue_payment_check'] : 0;
  unset($aRow['issue_payment_check']);
  if ($aRow['paymentmode'] != '0' && !empty($aRow['paymentmode'])) {
    if ($issue_payment_check == 1) {
      $paymentModeOutput = 'Check Payment';
    } else {
      $payment_mode = $ci->payment_modes_model->get($aRow['paymentmode'], [], false, true);
      if ($payment_mode) {
        $paymentModeOutput = e($payment_mode->name);
      }
    }
  }

  $row[11] = $paymentModeOutput;
  return $row;
}

function checkwriter_expenses_table_columns($aColumns)
{
  $aColumns[13] = db_prefix() . 'expenses.issue_payment_check as issue_payment_check';
  return $aColumns;
}

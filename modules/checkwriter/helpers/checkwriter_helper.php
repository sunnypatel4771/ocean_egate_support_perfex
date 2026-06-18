<?php
defined('BASEPATH') or exit('No direct script access allowed');

function get_bank_details($id = '')
{
    $CI = &get_instance();
    $CI->db->select('id,bank_name');
    if ($id) {
        $CI->db->where('id', $id);
        return $CI->db->get(db_prefix() . 'bank_details')->row();
    } else {
        return $CI->db->get(db_prefix() . 'bank_details')->result_array();
    }
}

function expense_note_pdf($expense)
{
    return app_pdf('expense_note_custom', module_libs_path(CHECKWRITER_MODULE) . 'pdf/expensive_report', $expense);
}


function acc_get_vendor_name_checkwriter($vendor_id, $prevent_empty_company = false)
{

    $CI = &get_instance();

    $select = 'company';

    $vendor = $CI->db->select($select)
        ->where('userid', $vendor_id)
        ->from(db_prefix() . 'pur_vendor')
        ->get()
        ->row();
    if ($vendor) {
        return $vendor->company;
    }

    return '';
}

function is_activated_module($name)
{
    $CI = &get_instance();
    $CI->db->select('active');
    $CI->db->where('module_name', $name);
    return $CI->db->get(db_prefix() . 'modules')->row();
}

function count_check_history($id)
{
    $CI = &get_instance();
    $CI->db->select('COUNT(id) as count, id');
    $CI->db->where('expensive_id', $id);
    return $CI->db->get(db_prefix() . 'expensive_history')->row();
}

function get_check_history_data_by_expensive($id)
{
    $CI = &get_instance();
    $CI->db->where('expensive_id', $id);
    return  $CI->db->get(db_prefix() . 'expensive_history')->row();
}

function voucher_pdf($voucher, $tag = '')
{
    return app_pdf('voucher', module_dir_path(CHECKWRITER_MODULE) . '/libraries/pdf/Voucher_pdf', $voucher, $tag);
}

function number_to_words($number)
{
    $words = array(
        0 => '',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'forty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety'
    );

    $levels = array(
        1000000000 => 'billion',
        1000000 => 'million',
        1000 => 'thousand',
        100 => 'hundred'
    );

    if ($number == 0) {
        return 'zero';
    }

    if ($number < 0) {
        return 'minus ' . number_to_words(abs($number));
    }

    $result = '';

    foreach ($levels as $value => $label) {
        if ($number >= $value) {
            $count = (int)($number / $value);
            $result .= number_to_words($count) . ' ' . $label . ' ';
            $number %= $value;
        }
    }

    if ($number > 0) {
        if ($number < 20) {
            $result .= $words[$number];
        } else {
            $result .= $words[(int)($number / 10) * 10];
            if ($number % 10 > 0) {
                $result .= '-' . $words[$number % 10];
            }
        }
    }

    return trim($result);
}

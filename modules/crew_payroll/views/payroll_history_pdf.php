<?php
defined('BASEPATH') or exit('No direct script access allowed');
$payroll_history = $payroll_history;
// Earnings
$earnings = [
    [get_option('basic_wages_onb'), $payroll_history['basic_wages_onb']],
    [get_option('basic_wages_trv'), $payroll_history['basic_wages_trv']],
    [get_option('leave'), $payroll_history['leave']],
    [get_option('education_allowance'), $payroll_history['education_allowance']],
    [get_option('guranteed_overtime'), $payroll_history['guranteed_overtime']],
    [get_option('operational_allowance'), $payroll_history['operational_allowance']],
    [get_option('supplementary_allowance'), $payroll_history['supplementary_allowance']],
    [get_option('owners_bonus'), $payroll_history['owners_bonus']],
    [get_option('other_earnings_1'), $payroll_history['other_earnings_1']],
    [get_option('other_earnings_2'), $payroll_history['other_earnings_2']],
];

// foreach ($earnings as $key => $value) {
//     echo $value[0];
//     echo "<br>";
//     echo $value[1];
//     echo "<br>";
// }

// Deductions
$deduction_official = [
    [get_option('philhelth_empee'), $payroll_history['philhelth_empee']],
    [get_option('social_security_system_empee'), $payroll_history['social_security_system_empee']],
    [get_option('slopchest'), $payroll_history['slopchest']],
    [get_option('pag_lbig_housing_program_empee'), $payroll_history['pag_lbig_housing_program_empee']],
    [get_option('sss_mandatory_provident_fund_empee'), $payroll_history['sss_mandatory_provident_fund_empee']],
    [get_option('provident_fund_kaupthing_empee'), $payroll_history['provident_fund_kaupthing_empee']],
    [get_option('cash_advance_paid_onboard'), $payroll_history['cash_advance_paid_onboard']],
];

$deduction_private = [
    [get_option('other_deduction_1'), $payroll_history['other_deduction_1']],
    [get_option('other_deduction_2'), $payroll_history['other_deduction_2']],
    [get_option('other_deduction_3'), $payroll_history['other_deduction_3']],
    [get_option('other_deduction_4'), $payroll_history['other_deduction_4']],
    [get_option('other_deduction_5'), $payroll_history['other_deduction_5']],
    [get_option('other_deduction_6'), $payroll_history['other_deduction_6']],
    [get_option('other_deduction_7'), $payroll_history['other_deduction_7']],
];

// Max row count
$max_rows = max(count($earnings), count($deduction_official), count($deduction_private));

// HTML table
$html = '
<style>
    .table {
        border-collapse: collapse;
        width: 100%;
        font-size: 9pt;
        margin: 0 auto;
    }
    th, td {
        border: 1px solid #000;
        padding: 4px 6px;
        vertical-align: middle;
        height: 40px;
    }
    .header {
        background-color: #f2f2f2;
        font-weight: bold;
        text-align: center;
        vertical-align: middle;
    }
    .total {
        font-weight: bold;
        background-color: #f9f9f9;
        text-align: right;
    }
</style>

<table class="table">
    <tr>
        <th class="header">Earnings</th>
        <th class="header">Deduction - Official</th>
        <th class="header">Deduction - Private</th>
    </tr>
';

// Data rows
for ($i = 0; $i < $max_rows; $i++) {
    $html .= '<tr>';

    // Earnings
    if (isset($earnings[$i])) {
        $html .= '<td>
            <table style="width:100%;"><tr>
                <td style="text-align:left; vertical-align:middle; font-weight:normal; border: none; width: 70%;">' . $earnings[$i][0] . '</td>
                <td style="text-align:right; vertical-align:middle; font-weight:bold; border: none; width: 30%;">' . number_format($earnings[$i][1]) . '</td>
            </tr></table>
        </td>';
    } else {
        $html .= '<td></td>';
    }

    // Deduction - Official
    if (isset($deduction_official[$i])) {
        $html .= '<td>
            <table style="width:100%;"><tr>
                <td style="text-align:left; vertical-align:middle; font-weight:normal; border: none; width: 70%;">' . $deduction_official[$i][0] . '</td>
                <td style="text-align:right; vertical-align:middle; font-weight:bold; border: none; width: 30%;">' . number_format($deduction_official[$i][1]) . '</td>
            </tr></table>
        </td>';
    } else {
        $html .= '<td></td>';
    }

    // Deduction - Private
    if (isset($deduction_private[$i])) {
        $html .= '<td>
            <table style="width:100%;"><tr>
                <td style="text-align:left; vertical-align:middle; font-weight:normal; border: none; width: 70%;">' . $deduction_private[$i][0] . '</td>
                <td style="text-align:right; vertical-align:middle; font-weight:bold; border: none; width: 30%;">' . number_format($deduction_private[$i][1]) . '</td>
            </tr></table>
        </td>';
    } else {
        $html .= '<td></td>';
    }

    $html .= '</tr>';
}


// Totals
$earnings_total = array_sum(array_column($earnings, 1));
$deduction_official_total = array_sum(array_column($deduction_official, 1));
$deduction_private_total = array_sum(array_column($deduction_private, 1));

$html .= '
<tr>
    <td class="total">Earnings Total: ' . number_format($earnings_total) . '</td>
    <td class="total">Deduction Official Total: ' . number_format($deduction_official_total) . '</td>
    <td class="total">Deduction Private Total: ' . number_format($deduction_private_total) . '</td>
</tr>
</table>';

// Render to TCPDF
$pdf->writeHTML($html, true, false, true, false, '');

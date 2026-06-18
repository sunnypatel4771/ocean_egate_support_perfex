<?php
defined('BASEPATH') or exit('No direct script access allowed');

$dimensions = $pdf->getPageDimensions();
$voucher = $voucher[0];

// Write top left logo and right column info/text
pdf_multi_row($info_left_column, $info_right_column, $pdf, ($dimensions['wk'] / 2) - $dimensions['lm']);
$space = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

// HTML content without <hr>
// HTML content without <hr>
$date = isset($voucher['check_date']) &&  $voucher['check_date'] != '' ? date('m-d-y', strtotime($voucher['check_date'])) : '';
$payee_to = isset($voucher['vendor_payee']) && $voucher['vendor_payee'] != '' ? $voucher['vendor_payee'] : '';
$html = '
    <table style="width: 100%; border: 1px solid white; border-collapse: collapse;">
        <tr>
            <td style="width: 25%; padding: 10px; ">
                ' . pdf_logo_url() . '
            </td>
            
            <td style="width: 45%; padding: 10px; text-align: center; font-size: 30px;font-weight: bolder;">
                Check Voucher
            </td>

            <td style="width: 25%; padding: 10px;">
                <span style="font-weight: bold;"> No:  </span>'.$voucher['id'].' <br>
                <span style="font-weight: bold;"> Date: </span>' . $date . '
            </td>
        </tr>
    </table>

<br><br><br>
<table style="width: 100%; border: 1px solid white; border-collapse: collapse;">
    <tr>
        <td style="width: 100%;  line-height: 1.3;">
            <span style="font-weight: bold;">Payee to : </span>' . $payee_to . '
        </td>
    </tr>
</table>
<br>
';

$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'round', 'join' => 'round'));
$pdf->Line(10, $pdf->GetY() + 37.5, 200, $pdf->GetY() + 37.5);

$payee_to = isset($voucher['vendor_payee']) && $voucher['vendor_payee'] != '' ? $voucher['vendor_payee'] : '';
$html .= '<table style="width: 100%; border: 1px solid white; border-collapse: collapse;">
    <tr>
        <td style="width: 80%;  line-height: 1.3;">
            <span style="font-weight: bold;">Particulars : </span>
        </td>
        <td style="width: 20%; padding: 10px; text-align: right; font-weight: bold;">
            Amount
        </td>
    </tr>

    <tr>
        <td style="width: 80%;">
            ' . $voucher['check_note'] . '
        </td>
        <td style="width: 20%;text-align: right;">
            ' .  number_format($voucher['amount'], 2) . '
        </td>
    </tr>
</table>

<br><br>
<p>&nbsp;&nbsp;&nbsp;<b>Note:</b>  ' . $voucher['note'] . '</p>
<br><br><br>


';

// Ensure that you have space for the next dotted line
$pdf->Ln(5); // Move the cursor 5mm down (or any other amount as required)

// Add dotted line after the table
// $pdf->SetLineStyle(array('width' => 0.2, 'cap' => 'round', 'join' => 'round', 'dash' => '1,1')); // 1mm dash, 1mm gap
// $pdf->Line(10, $pdf->GetY() + 40, 200, $pdf->GetY() + 40); // Draw a dotted line at the current Y position
$bank_name = isset($voucher['bank_name']) && $voucher['bank_name'] != '' ? $voucher['bank_name'] : '';
$html .= '

<table style="width: 100%; border: 1px solid white; border-collapse: collapse;">
<tr>
        <td style="width: 50%; line-height: 1.3;font-weight: bold">
            Reference No :
        </td>
        <td style="width: 50%; line-height: 1.3;">
            ' . $voucher['reference_no'] . '
        </td>
    </tr>
    <tr>
        <td style="width: 50%; line-height: 1.3;font-weight: bold">
            Amount in Words :
        </td>
        <td style="width: 50%; line-height: 1.3;">
            ' . number_to_words($voucher['amount']) . '
        </td>
    </tr>

    <tr>
        <td style="width: 50%; line-height: 1.3;font-weight: bold">
        Bank Name : </td>
        <td style="width: 50%; line-height: 1.3;">
        ' . $voucher['bank_name'] . '</td>
    </tr>

    <tr>
        <td style="width: 50%; line-height: 1.3;font-weight: bold">
        Check Number : </td>
        <td style="width: 50%; line-height: 1.3;">
        ' . $voucher['check_no'] . '</td>
    </tr>

    <tr style="width: 100%;float: right;">
    <td style="width: 85.8%; line-height: 1.3;font-weight: bold">
    </td>
        <td style="width: 14.2%; line-height: 1.3;font-weight: bold;">
        <span><hr style="width: 105%;"></span><br><br>
        <span style="text-align: center;">Received By</span>
         </td>
    </tr>
</table>

    <br><br><br>

  <table style="width: 100%; border: 1px solid white; border-collapse: collapse;">
       <tr>
            <td style="width: 40%; font-weight: bold">
            <span><hr style="width: 35%;"></span><br><br>
            <span>Prepared By</span>
            </td>
            <td style="width: 46%; font-weight: bold">
            <span><hr style="width: 46%;"></span><br><br>
            <span>Certified Correct By</span>
            </td>
            <td style="width: 33%; font-weight: bold;">
            <span><hr style="width: 41%;"></span><br><br>
            <span>Approved By</span>
            </td>
         </tr>
     </table>
<br><br><br>

';










// Add dotted line after the table
$pdf->SetLineStyle(array('width' => 0.2, 'cap' => 'round', 'join' => 'round', 'dash' => '3,2')); // 1mm dash, 1mm gap
$pdf->Line(10, $pdf->GetY() + 120, 200, $pdf->GetY() + 120); // Draw a dotted line at the current Y position











$date = isset($voucher['check_date']) &&  $voucher['check_date'] != '' ? date('m-d-y', strtotime($voucher['check_date'])) : '';
$html .= '
<br><br><br>
    <table style="width: 100%; border: 1px solid white; border-collapse: collapse;">
        <tr>
            <td style="width: 25%; padding: 10px;">
                ' . pdf_logo_url() . '
            </td>
            
            <td style="width: 45%; padding: 10px; text-align: center; font-size: 30px;font-weight: bolder;">
                Check Voucher
            </td>

            <td style="width: 25%; padding: 10px;">
                <span style="font-weight: bold;"> No:  </span>'.$voucher['id'].' <br>
                <span style="font-weight: bold;"> Date: </span>' . $date . '
            </td>
        </tr>
    </table>
<br><br>
<table style="width: 100%; border: 1px solid white; border-collapse: collapse;">
    <tr>
        <td style="width: 100%;  line-height: 1.3;">
            <span style="font-weight: bold;">Payee to : </span>' . $payee_to . '
        </td>
    </tr>
</table>
<br>

';

// $pdf->SetLineStyle(array('width' => 0.2, 'cap' => 'round', 'join' => 'round', 'dash' => '1,1')); // 1mm dash, 1mm gap
// $pdf->Line(10, $pdf->GetY() + 150, 200, $pdf->GetY() + 150); // Draw a dotted line at the current Y position

$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'round', 'join' => 'round')); // Set a thicker line without dashes
$pdf->Line(10, $pdf->GetY() + 149.3, 200, $pdf->GetY() + 149.3); // Draw a straight, dark line

$payee_to = isset($voucher['vendor_payee']) && $voucher['vendor_payee'] != '' ? $voucher['vendor_payee'] : '';
$html .= '<table style="width: 100%; border: 1px solid white; border-collapse: collapse;">
    <tr>
        <td style="width: 80%;  line-height: 1.3;">
            <span style="font-weight: bold;">Particulars : </span>
        </td>
        <td style="width: 20%; padding: 10px; text-align: right; font-weight: bold;">
            Amount
        </td>
    </tr>

    <tr>
        <td style="width: 80%;">
            ' . $voucher['check_note'] . '
        </td>
        <td style="width: 20%;text-align: right;">
            ' .  number_format($voucher['amount'], 2) . '
        </td>
    </tr>
</table>
<br><br>
<p>&nbsp;&nbsp;&nbsp;<b>Note:</b>  ' . $voucher['note'] . '</p>
<br><br><br>
';

// Ensure that you have space for the next dotted line
$pdf->Ln(5); // Move the cursor 5mm down (or any other amount as required)

// Add dotted line after the table
// $pdf->SetLineStyle(array('width' => 0.2, 'cap' => 'round', 'join' => 'round', 'dash' => '1,1')); // 1mm dash, 1mm gap
// $pdf->Line(10, $pdf->GetY() + 170, 200, $pdf->GetY() + 170); // Draw a dotted line at the current Y position

$html .= '

<table style="width: 100%; border: 1px solid white; border-collapse: collapse;">
<tr>
        <td style="width: 50%; line-height: 1.3;font-weight: bold">
            Reference No :
        </td>
        <td style="width: 50%; line-height: 1.3;">
            ' . $voucher['reference_no'] . '
        </td>
    </tr>
    <tr>
        <td style="width: 50%; line-height: 1.3;font-weight: bold">
            Amount in Words :
        </td>
        <td style="width: 50%; line-height: 1.3;">
            ' . number_to_words($voucher['amount']) . '
        </td>
    </tr>

    <tr>
        <td style="width: 50%; line-height: 1.3;font-weight: bold">
        Bank Name : </td>
        <td style="width: 50%; line-height: 1.3;">
        ' . $voucher['bank_name'] . '</td>
    </tr>

    <tr>
        <td style="width: 50%; line-height: 1.3;font-weight: bold">
        Check Number : </td>
        <td style="width: 50%; line-height: 1.3;">
        ' . $voucher['check_no'] . '</td>
    </tr>

    <tr style="width: 100%;float: right;">
    <td style="width: 85.8%; line-height: 1.3;font-weight: bold">
    </td>
        <td style="width: 14.2%; line-height: 1.3;font-weight: bold;">
        <span><hr style="width: 105%;"></span><br><br>
        <span style="text-align: center;">Received By</span>
         </td>
    </tr>
</table>

    <br><br><br>

   <table style="width: 100%; border: 1px solid white; border-collapse: collapse;">
       <tr>
            <td style="width: 37%; font-weight: bold">
            <span><hr style="width: 38%;"></span><br><br>
            <span>Prepared By</span>
            </td>
            <td style="width: 49%; font-weight: bold">
            <span><hr style="width: 46%;"></span><br><br>
            <span>Certified Correct By</span>
            </td>
            <td style="width: 33.33%; font-weight: bold;">
            <span><hr style="width: 41%;"></span><br><br>
            <span>Approved By</span>
            </td>
         </tr>
     </table>
<br><br><br>

';


// Write the HTML content
$pdf->ln(1);
$pdf->writeHTML($html, true, false, true, false, '');

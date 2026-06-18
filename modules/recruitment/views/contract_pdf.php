<?php

defined('BASEPATH') or exit('No direct script access allowed');

// $dimensions = $pdf->getPageDimensions();
// $contract = $contract;
// $pdf->writeHTML($contract, true, false, true, false, '');

$pdf->SetAutoPageBreak(false, 0);
$contract = trim($contract);
$contract = str_replace('‑', '-', $contract);
$pdf->writeHTML($contract, true, false, true, false, '');
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);


// set document information
// $pdf->SetCreator(PDF_CREATOR);
// $pdf->SetAuthor('Active Interactive');
// $pdf->SetTitle('Invoice');
// $pdf->SetSubject('Invoice');

// // set default header data
// $pdf->SetPrintHeader(false);
// $pdf->SetPrintFooter(false);

// // set margins
// $pdf->SetMargins(10, 10, 10);

// // set auto page breaks
// $pdf->SetAutoPageBreak(TRUE, 10);

// // add a page
// $pdf->AddPage();

// // set font
// $pdf->SetFont('helvetica', '', 10);

// // Add Logo
// $pdf->Image('logo.png', 10, 10, 40);

// // Header Company Info
// $html = '
// <table cellspacing="0" cellpadding="4">
//     <tr>
//         <td width="60%">
//             <strong>ACTIVE INTERACTIVE</strong><br/>
//             Global Media Solutions<br/>
//             12 Highland Garden,<br/>
//             London SW1234A, United Kingdom
//         </td>
//         <td width="40%" align="right">
//             info@companyexample.com<br/>
//             sales@companyexample.com<br/>
//             jobs@companyexample.com<br/>
//             +44 137 1234 1234<br/>
//             www.companywebsite.com
//         </td>
//     </tr>
// </table><br><br>
// <h1 align="center">INVOICE</h1>
// ';
// $pdf->writeHTML($html, true, false, true, false, '');

// // Invoice Info
// $html = '
// <table cellpadding="6" cellspacing="0" border="0">
//     <tr style="background-color:#e6f4f9;">
//         <td width="33%"><strong>Total Due:</strong><br/><span style="font-size:14px; color:#009fc5;">$2624.28</span></td>
//         <td width="33%"><strong>Invoice Date:</strong><br/>22 March 2012</td>
//         <td width="33%"><strong>Invoice #:</strong><br/>2144877</td>
//     </tr>
// </table><br><br>
// ';
// $pdf->writeHTML($html, true, false, true, false, '');

// // Client Info
// $html = '
// <table cellpadding="4" cellspacing="0">
//     <tr>
//         <td><strong>INVOICE TO:</strong><br/>
//             STEVEN COLE<br/>
//             256 Highland garden, London<br/>
//             SW1234A, United Kingdom<br/>
//             steven.cole@mywebsite.com<br/>
//             01744 5448454
//         </td>
//     </tr>
// </table><br>
// ';
// $pdf->writeHTML($html, true, false, true, false, '');

// // Items Table Header
// $html = '
// <table border="1" cellpadding="6" cellspacing="0" style="border-collapse:collapse;">
// <tr style="background-color:#cbe5f2;">
//     <th width="40%">Item Description</th>
//     <th width="15%">Unit Price</th>
//     <th width="15%">Quantity</th>
//     <th width="30%">Total</th>
// </tr>
// <tr>
//     <td><strong>Web Design</strong><br/>An affordable website solution that provides everything a company needs for a professional online presence.</td>
//     <td>$599.00</td>
//     <td>2</td>
//     <td>$1198.00</td>
// </tr>
// <tr>
//     <td><strong>E-Book Design</strong><br/>E-book design which includes interface designing, character design, deployment and upload on the server.</td>
//     <td>$390.00</td>
//     <td>1</td>
//     <td>$390.00</td>
// </tr>
// <tr>
//     <td><strong>Hosting Plan</strong><br/>One years hosting plan which includes 2 free email addresses. Free live support.</td>
//     <td>$114.00</td>
//     <td>1</td>
//     <td>$114.00</td>
// </tr>
// <tr>
//     <td><strong>Brochure Design</strong><br/>Brochure design in theme and red color for International Film festival Newyork November 2012.</td>
//     <td>$200.00</td>
//     <td>3</td>
//     <td>$600.00</td>
// </tr>
// </table><br>
// ';
// $pdf->writeHTML($html, true, false, true, false, '');

// // Payment Method
// $html = '
// <p><strong>Payment Method:</strong> Cheque, Paypal, BACS, Western Union.<br/>
// payment@websitename.com</p>
// ';
// $pdf->writeHTML($html, true, false, true, false, '');

// // Total Summary
// $html = '
// <table cellpadding="6" cellspacing="0" border="0">
// <tr>
//     <td width="70%"></td>
//     <td width="30%">
//         <table border="0" cellpadding="4" cellspacing="0">
//             <tr><td>SUB TOTAL:</td><td>$2302.00</td></tr>
//             <tr><td>Tax: VAT 20%:</td><td>$460.40</td></tr>
//             <tr><td>DISCOUNT 5%:</td><td style="color:red;">-$138.12</td></tr>
//         </table>
//         <br>
//         <table style="background-color:#cbe5f2;" cellpadding="6">
//             <tr><td><strong>Total Due: $4278.00</strong></td></tr>
//         </table>
//     </td>
// </tr>
// </table>
// ';
// $pdf->writeHTML($html, true, false, true, false, '');

// // Signature
// $html = '
// <br><br><br>
// <p>__________________________<br>
// Terry Brown<br>
// Accounts Manager</p>
// ';
// $pdf->writeHTML($html, true, false, true, false, '');
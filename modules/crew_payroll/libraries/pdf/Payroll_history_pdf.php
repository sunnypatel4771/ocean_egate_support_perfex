<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once APPPATH . 'libraries/pdf/App_pdf.php';

class Payroll_history_pdf extends App_pdf
{
    protected $payroll_history;

    public function __construct($payroll_history, $tag = '')
    {
        $this->load_language($payroll_history);
        // $payroll                = hooks()->apply_filters('payroll_html_pdf_data', $payroll);
        $GLOBALS['payroll_history_pdf'] = $payroll_history;

        parent::__construct();

        // if (!class_exists('Invoices_model', false)) {
        //     $this->ci->load->model('invoices_model');
        // }

        $this->tag            = $tag;
        $this->payroll_history        = $payroll_history;
        // $this->invoice_number = format_invoice_number($this->payroll->id);

        $this->SetTitle('Payroll History');
        // Set the PDF password if provided

        // if ($password) {
        //     $this->SetProtection(array('print', 'copy'), $password);
        //     // $this->set_pdf_password($password);
        // }
    }

    public function prepare()
    {
        $this->set_view_vars('payroll_history', $this->payroll_history);

        return $this->build();
    }

    protected function type()
    {
        return 'payroll_history';
    }

    protected function file_path()
    {
        $actualPath = APP_MODULES_PATH . 'crew_payroll/views/payroll_history_pdf.php';
        return $actualPath;
    }
}

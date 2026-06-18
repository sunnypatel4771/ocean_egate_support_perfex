<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once APPPATH . 'libraries/pdf/App_pdf.php';

class Contract_pdf extends App_pdf
{
    protected $contract;

    public function __construct($contract, $tag = '')
    {
        $this->load_language($contract);
        // $payroll                = hooks()->apply_filters('payroll_html_pdf_data', $payroll);
        $GLOBALS['contract_pdf'] = $contract;

        parent::__construct();

        // if (!class_exists('Invoices_model', false)) {
        //     $this->ci->load->model('invoices_model');
        // }

        $this->tag            = $tag;
        $this->contract        = $contract;
        // $this->invoice_number = format_invoice_number($this->payroll->id);

        $this->SetTitle('Contract');
        // Set the PDF password if provided

        // if ($password) {
        //     $this->SetProtection(array('print', 'copy'), $password);
        //     // $this->set_pdf_password($password);
        // }
    }

    public function prepare()
    {
        $this->set_view_vars('contract', $this->contract);

        return $this->build();
    }

    protected function type()
    {
        return 'contract';
    }

    protected function file_path()
    {
        $actualPath = APP_MODULES_PATH . 'recruitment/views/contract_pdf.php';
        return $actualPath;
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once APPPATH . 'libraries/pdf/App_pdf.php';

class Voucher_pdf extends App_pdf
{
    protected $voucher;

    public function __construct($voucher, $tag = '', $password = null)
    {
        $this->load_language($voucher[0]['id']);
        $GLOBALS['voucher_pdf'] = $voucher;

        parent::__construct();

        $this->tag            = $tag;
        $this->voucher        = $voucher;

        $this->SetTitle('Check Voucher');
    }

    public function prepare()
    {
        $this->set_view_vars('voucher', $this->voucher);

        return $this->build();
    }

    protected function type()
    {
        return 'voucher';
    }

    protected function file_path()
    {
        $actualPath = APP_MODULES_PATH . '/checkwriter/views/voucher_pdf.php';
        return $actualPath;
    }
}

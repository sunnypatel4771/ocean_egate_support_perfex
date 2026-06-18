<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contract_template extends App_mail_template
{
    protected $for = 'contract';

    protected $data;

    public $slug = 'contract';

    public function __construct($data)
    {
        parent::__construct();

        $this->data = $data;

        $this->set_merge_fields('contract_template_merge_fields', $this->data);
    }

    public function build()
    {
        $this->to($this->data->mail_to);
    }
}

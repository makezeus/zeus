<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  protected function load_view($page, $data = array())
  {
    $this->load->view('app', $data);
    $this->load->view($page, $data);
  }
}
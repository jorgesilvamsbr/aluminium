<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->helper('url');
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/index');
        $this->load->view('admin/footer');
    }
 }

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Auth_Controller {

	/**
	 * construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
	}

	/**
	 * Dashboard
	 * @return Layout
	 */
	public function home_page(){
		$this->load->view('template/header');
		$this->load->view('home/home_page');
		$this->load->view('template/footer');
	}
}
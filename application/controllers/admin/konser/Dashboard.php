<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct() {
        parent::__construct();
        $this->load->helper('url');
		cek_login();
		cek_user();	
		$this->load->library('encryption');
		$this->encryption->initialize(
			array(
				'cipher' => 'aes-256',
                'mode' => 'ctr',
                'key' => 'UJANGsalahudin@gantengbanget1234'
			)
		);
		$this->load->model("ModelKonser");
    }
	public function index()
	{
		redirect('admin/dashboard');
	}
	function delete($konserId) {
        $key = "UJANGSALAHUDIN";
        $dect = $this->encryption->decrypt($konserId);
        $this->ModelKonser->delete($konserId);
        redirect($_SERVER['HTTP_REFERER']);
	}
	function edit($konserId) {
		$detail = $this->ModelKonser->detail($konserId);
		$data = array(
			'onEdit' => TRUE,
			'detail' => $detail
		);
		$this->load->view('admin/tambahkonser', $data);
	}
	
}

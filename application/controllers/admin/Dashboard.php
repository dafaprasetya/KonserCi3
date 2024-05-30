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
		$this->load->model('ModelKonser');
		$this->load->model('ModelBooked');
		$this->load->model('ModelTiket');
		$this->load->library('encryption');
		$this->encryption->initialize(array('driver' => 'openssl'));
		
    }
	public function index()
	{
		$listKonser = $this->ModelKonser->listKonser();
		$key = 'UJANGSALAHUDIN';
		$data = array(
			'title' => 'My Title',
			'konser' => $listKonser,
			'key'=>$key,
		);
		
		$this->load->view('admin/dashboard', $data);
	}
	public function booked() {
		$booked = $this->ModelBooked->booked();
		$data = array(
			'booked' => $booked,
		);
		$this->load->view('admin/booked', $data);
	}
	public function bookedTerbayar() {
		$booked = $this->ModelBooked->getTerbayar();
		$data = array(
			'booked' => $booked,
		);
		$this->load->view('admin/booked', $data);
	}
	public function bookedBelumTerbayar() {
		$booked = $this->ModelBooked->getBelumTerbayar();
		$data = array(
			'booked' => $booked,
		);
		$this->load->view('admin/booked', $data);
	}
	public function tiket() {
		$tiket = $this->ModelTiket->getTiket();
		// $booked = $this->ModelBooked->bayar();
		$data = array(
			'tiket' => $tiket,
			// 'booked' => $booked,
		);
		$this->load->view('admin/tiket', $data);
	}
}

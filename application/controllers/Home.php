<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(-1); // highest error reporting level
ini_set("display_errors", true); // print errors directly as output
/* all the rest here */

class Home extends CI_Controller {

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
		$this->load->model("ModelKonser");
		$this->load->model("ModelKeranjang");
		$this->load->model("ModelBooked");
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$params = array('server_key' => 'SB-Mid-server-SJhSs_QXNTapFPBywEbDkVfl', 'production' => false);
		$this->load->library('Veritrans');
		$this->load->library('Midtrans');
		$this->veritrans->config($params);
		$this->midtrans->config($params);
		
    }
	public function index()
	{
		$konser = $this->ModelKonser->listKonser();
		$hits = $this->ModelKonser->hits();
		$data = array(
			'konser' => $konser,
			'hits'=> $hits,
		);
		$this->load->view('home', $data);
	}
	public function addcart($konserId) {
		cek_login();
		$userId = $this->session->userdata('userId');
		$jumlah = $this->input->post('jumlah');
		if ($jumlah > 0) {
			$this->ModelKeranjang->addcart($userId, $konserId, $jumlah);
			redirect($_SERVER['HTTP_REFERER']);
		}	
	}
	public function konser($konserId) {
		$detail = $this->ModelKonser->detail($konserId);
		$data = array(
			'konser' => $detail,
		);
		$this->load->view('detail', $data);
	}
	public function addBooked($konserId) {
		cek_login();
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('namaPemesan', 'namaPemesan', 'required');
		$this->form_validation->set_rules('nomorTelp', 'nomorTelp', 'required');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required');
		if ($this->form_validation->run()) {
			$namaKonser = $this->input->post("namaKonser");
			$email = $this->input->post("email");
			$nomorTelp = $this->input->post("nomorTelp");
			$namaPemesan = $this->input->post("namaPemesan");
			$jumlah = $this->input->post("jumlah");
			$userBooked = $this->session->userdata("nama");
			$userId = $this->session->userdata("userId");
			$bookedId = "BO".strtoupper(str_replace('0','',date('Ymds')).$konserId.str_replace(array(" ",'a','i','u','e','o','/','\\','='), "", $namaKonser).str_replace(array(" ",'a','i','u','e','o','/','\\','='), "", $userBooked).substr(str_replace(array('@','.'," ",'a','i','u','e','o','/','\\','='), '', $email),0,5).substr(str_replace(array('@'," ",'a','i','u','e','o','/','\\','='), '', $namaPemesan),0,4).$jumlah);
			$getHarga = $this->ModelKonser->detail($konserId);
			foreach ($getHarga->result() as $harga) {
				$namaKonser = $harga->namaKonser;
				$totalHarga = intval($harga->harga) * intval($jumlah); 
			}
			$data = array(
				'bookedId'=>$bookedId,
				'namaKonser'=>$namaKonser,
				'konserId'=>$konserId,
				'userBooked'=>$userBooked,
				'userId'=>$userId,
				'email'=>$email,
				'namaPemesan'=>$namaPemesan,
				'jumlah'=>$jumlah,
				'totalHarga'=>$totalHarga,
				'nomorTelp'=>$nomorTelp,
			);
			$this->ModelBooked->addBooked($data);
			redirect('home/konser/'.$konserId);
		}else {
			
			redirect('home');
		}
	}
	public function bill($userId) {
		if ($this->session->userdata('userId') != $userId) {
			redirect('home');
		}
		$booked = $this->ModelBooked->getBill($userId);
		

		foreach ($booked->result() as $bookeds) {
			$konsers = $this->ModelKonser->detail($bookeds->konserId);
		}
		foreach ($konsers->result() as $konser) {
			$konser = $konser->bannerKonser;
		}
		$data = array(
			'booked' => $booked,
			'konser' => $konser,
		);
		
		$this->load->view('booked', $data);
	}
	public function paymentSuccess($bookedId) {
		$data = array(
			'status' => "PAID",
			'transaction_id' => $this->input->post('transaction_id'),
			'transaction_time' => $this->input->post('transaction_time'),
			'payment_type' => $this->input->post('payment_type'),
		);
		$this->ModelBooked->success($bookedId, $data);
		$this->load->model("ModelTiket");
		return $this->output->set_content_type('application/json')->set_output(json_encode([
			'status' => 'success',
			// 'hai' => $this->ModelTiket->getBookedSuccess($this->input->post('transaction_id')),
			]));

	}
	public function tiketCreate($transaction_id) {
		$this->load->model("ModelTiket");
		$booked = $this->ModelTiket->getBookedSuccess($transaction_id);
		//GET BOOKED DETAIL
		foreach ($booked->result() as $bookeds) {
			$idbooked = $bookeds->bookedId;
		}
		$tiketId = strtoupper("TIKETU".substr($idbooked,2));
		$data = array(
			'tiketId'=>$tiketId,
			'bookedId'=>$idbooked,
			'transaction_id'=>$this->input->post('transaction_id'),
		);
		$this->ModelTiket->createTiket($transaction_id, $data);
		$this->ModelBooked->success($idbooked, array('tiketId'=>$tiketId));
	}
	public function token($bookedId){

		$booked = $this->ModelBooked->bayar($bookedId);
		

		foreach ($booked->result() as $bookeds) {
			$konsers = $this->ModelKonser->detail($bookeds->konserId);
			$jumlah = $bookeds->jumlah;
			$namaPemesan = $bookeds->namaPemesan;
			$nomorTelp = $bookeds->nomorTelp;
			$email = $bookeds->email;
		}
		foreach ($konsers->result() as $konser) {
			$namaKonser = $konser->namaKonser;
			$idKonser = $konser->konserId;
			$hargaKonser = $konser->harga;
			
		}
		// Required
		$transaction_details = array(
		  'order_id' => $bookedId,
		  'gross_amount' => $hargaKonser * $jumlah, // no decimal allowed for creditcard
		);

		// Optional
		$item_details = array(
		  'id' => $idKonser,
		  'price' => $hargaKonser,
		  'quantity' => $jumlah,
		  'name' => $namaKonser,
		);
		// Optional
		$customer_details = array(
		  'first_name'    => $namaPemesan,
		  'email'         => $email,
		  'phone'         => $nomorTelp,
		);

		// Fill transaction details
		$transaction = array(
		  'transaction_details' => $transaction_details,
		  'customer_details' => $customer_details,
		  'item_details' => $item_details,
		);
		//error_log(json_encode($transaction));
		$snapToken = $this->midtrans->getSnapToken($transaction);
		error_log($snapToken);
		return $this->output->set_content_type('application/json')->set_output(json_encode([
			'snapToken' => $snapToken,
			]));
    }
}

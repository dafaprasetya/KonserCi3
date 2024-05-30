<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tambah extends CI_Controller {

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
        $this->load->helper(array('form', 'url'));
		cek_login();
		cek_user();
        $this->load->library('form_validation');
        $this->load->library('upload');
		$this->load->model("ModelKonser");
		
    }
	public function index()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->form_validation->set_rules('namaKonser','namaKonser','required|trim');
			$this->form_validation->set_rules('waktu','waktu','required|trim');
			$this->form_validation->set_rules('lokasi','lokasi','required|trim');
			$this->form_validation->set_rules('artis','artis','required|trim');
			$this->form_validation->set_rules('harga','harga','required|trim');
			$this->form_validation->set_rules('qty','qty','required|trim');
			$this->form_validation->set_rules('deskripsi','deskripsi','required|trim');
			$config['upload_path'] = './assets/gambar/konser/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';
			$config['file_name'] = $this->input->post('namaKonser').rand(0,1000);
			$this->upload->initialize($config);
			$this->load->library('upload', $config);
			$this->upload->do_upload('bannerKonser');
			if ( ! $this->upload->do_upload('bannerKonser')){
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect('admin/konser/tambah');
			}
			if ($this->form_validation->run()) {
				$namaKonser = $this->input->post('namaKonser');
				$waktu = $this->input->post('waktu');
				$lokasi = $this->input->post('lokasi');
				$artist = $this->input->post('artis');
				$harga = $this->input->post('harga');
				$qty = $this->input->post('qty');
				$deskripsi = $this->input->post('deskripsi');
				$gambar = 'assets/gambar/konser/'.$this->upload->data()['file_name'];
				$this->ModelKonser->tambah($gambar, $namaKonser, $artist, $waktu, $harga, $lokasi, $deskripsi, $qty);
				redirect('admin/dashboard');
			}
			else {
				$this->session->set_flashdata('error', validation_errors());
				redirect('admin/konser/tambah');
			}
		}
		$this->load->view('admin/tambahkonser');
	}
	public function Edit($konserId) {
		$this->form_validation->set_rules('namaKonser','namaKonser','required|trim');
		$this->form_validation->set_rules('waktu','waktu','required|trim');
		$this->form_validation->set_rules('lokasi','lokasi','required|trim');
		$this->form_validation->set_rules('artis','artis','required|trim');
		$this->form_validation->set_rules('harga','harga','required|trim');
		$this->form_validation->set_rules('qty','qty','required|trim');
		$this->form_validation->set_rules('deskripsi','deskripsi','required');
		$config['upload_path'] = './assets/gambar/konser/';
		$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';
		$config['file_name'] = $this->input->post('namaKonser').rand(0,1000);
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		$this->upload->do_upload('bannerKonser');
		if ( ! $this->upload->do_upload('bannerKonser')){
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect('admin/konser/dashboard/edit/'.$konserId);
		}
		if ($this->form_validation->run()) {
			$gambar = 'assets/gambar/konser/'.$this->upload->data()['file_name'];
			$data = array(
				'bannerKonser' => $gambar,
				'namaKonser' => $this->input->post('namaKonser'),
				'artist' => $this->input->post('artis'),
				'waktu' => $this->input->post('waktu'),
				'harga' => $this->input->post('harga'),
				'lokasi' => $this->input->post('lokasi'),
				'deskripsi' => $this->input->post('deskripsi'),
				'qty' => $this->input->post('qty'),
				'status' => $this->input->post('status')
			);
			$this->ModelKonser->edit($konserId, $data);
			redirect('admin/dashboard');
		}
	}
	
	
}

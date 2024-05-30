<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

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
		
    }
	public function index()
	{
		$this->load->model('modeluser');
		if ($this->session->userdata('is_login')) {
			redirect('home');
		}
        $data['judul'] = 'Register';
		$this->load->view('auth/register', $data);
	}
    public function register() {
		$this->load->model('ModelUser');
		if ($this->session->userdata('is_login')) {
			redirect('home');
		}
		$this->form_validation->set_rules('nama', 'nama','trim|required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('username', 'username','trim|required|min_length[1]|max_length[255]|is_unique[user.username]');
		$this->form_validation->set_rules('email', 'email','trim|required|min_length[1]|max_length[255]|is_unique[user.email]');
		$this->form_validation->set_rules('password', 'password','trim|required|min_length[1]|max_length[255]');
		if ($this->form_validation->run())
		   {
			$nama = $this->input->post('nama');
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$role = 'user';
			// $this->auth->register($username,$password,$email, $role);
			$this->ModelUser->register($nama, $username, $email, $password);
			// $this->load->model('modeluser')->register($username, $email,$password,$role);
			$this->session->set_flashdata('success_register',$nama);
			redirect('auth/login');
		}
		else
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('auth/register');
		}
	}
}

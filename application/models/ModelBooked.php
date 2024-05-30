<?php 
    class ModelBooked extends CI_Model 
    {
        
        public function __construct()
        {
            parent::__construct();
            $this->load->model("ModelKonser");            
        }
        function booked() {
            $booked = $this->db->get('bookedTicket');
            return $booked;
        }
        function addBooked($data) {
            $this->db->insert('bookedTicket', $data);
			$this->ModelKonser->uqty($data["konserId"], $data["jumlah"]);
        }
        function getBill($userId) {
            $booked = $this->db->get_where('bookedTicket', array('userId'=>$userId));
            if ($booked->num_rows() > 0) {
                return $booked;
            }else {
                redirect('home');
            }
        }
        function bayar($bookedId) {
            $booked = $this->db->get_where('bookedTicket', array('bookedId'=>$bookedId));
            if ($booked->num_rows() > 0) {
                return $booked;
            }else {
                redirect('home');
            }
        }
        function getTerbayar() {
            $booked = $this->db->get_where('bookedTicket', array('status'=>'PAID'));
            if ($booked->num_rows() > 0) {
                return $booked;
            }else {
                redirect('admin/dashboard');
            }
        }
        function getBelumTerbayar() {
            $booked = $this->db->get_where('bookedTicket', array('status'=>'UNPAID'));
            if ($booked->num_rows() > 0) {
                return $booked;
            }else {
                redirect('admin/dashboard');
            }
        }
        function success($bookedId, $data) {
            $this->db->where(array('bookedId'=>$bookedId));
            $this->db->update('bookedTicket',$data);
        }
        
    }
?>
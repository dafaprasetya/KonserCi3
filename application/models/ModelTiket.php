<?php 
    class ModelTiket extends CI_Model 
    {
        
        public function __construct()
        {
            parent::__construct();
            $this->load->model("ModelBooked");            
        }
        function getBookedSuccess($transaction_id) {
            $booked = $this->db->get_where('bookedTicket', array('transaction_id'=>$transaction_id));
            if ($booked->num_rows() > 0) {
                return $booked;
            }
        }
        function createTiket($transaction_id, $data) {
            $booked = $this->db->get_where('bookedTicket', array('transaction_id'=>$transaction_id));
            if ($booked->num_rows() > 0) {
                $this->db->insert('tiket', $data);
                return $this->output->set_content_type('application/json')->set_output(json_encode([
                    'success' => 'BERHASIL COY',
                    ]));
            }else {
                return $this->output->set_content_type('application/json')->set_output(json_encode([
                    'error' => 'terjadi kesalahan silahkan hubungi admin',
                    ]));
            }
        }
        function getTiket() {
            $tiket = $this->db->get("tiket");
            return $tiket;
        }
        function getBooked($tiketId) {
            $booked = $this->db->get_where('bookedTicket', array('tiketId'=>$tiketId));
            if ($booked->num_rows() > 0) {
                return $booked;
            }
        }
        
    }
?>
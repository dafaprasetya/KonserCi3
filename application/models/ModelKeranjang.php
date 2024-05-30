<?php 
    class ModelKeranjang extends CI_Model 
    {
        
        const SESSION_KEY = 'userId';
        public function __construct()
        {
            parent::__construct();
        }
    
        function addcart($userId, $konserId, $jumlah)
        {
            // str_replace(' ','',strtoupper(substr($nama,0,2).substr($email,rand(1,3),rand(0,2)).substr($nomor_telp,rand(2,3),rand(1,2)).rand(1000,2000).substr($cat,0,3)));
            $data = array(
                'userId' => $userId,
                'konserId'=>$konserId,
                'jumlah'=>$jumlah,
            );
            $this->db->insert('keranjang',$data);
        }
    }
?>
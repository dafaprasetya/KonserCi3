<?php 
    class ModelKonser extends CI_Model 
    {
        
        const SESSION_KEY = 'userId';
        public function __construct()
        {
            parent::__construct();
        }
        function listKonser() {
            $konser = $this->db->get('konser');
            return $konser;
        }
        function delete($konserId) {
            $konser = $this->db->get_where('konser', array('konserId'=>$konserId));
            if ($konser->num_rows() > 0) {
                # code...
                $this->db->delete('konser',['konserId' => $konserId]);
            }
        }
        function hits() {
            $hits = $this->db->get_where('konser', array('hits'=>'yes'));
            return $hits;
        }
        function detail($konserId) {
            $konser = $this->db->get_where('konser', array('konserId'=>$konserId));
            if ($konser->num_rows() > 0) {
                return $konser;
            }
        }
        function uqty($konserId, $jumlah) {
            $konser = $this->db->get_where('konser', array('konserId'=>$konserId));
            if ($konser->num_rows() > 0) {
                foreach ($konser->result() as $konser) {
                    $getQty = $konser->qty;
                    $update = intval($getQty) - intval($jumlah);
                    $this->db->where(array('konserId'=>$konserId));
                    $this->db->update('konser', array("qty"=>$update));
                }
            }
        }
        function edit($konserId, $data) {
            // $konser = $this->db->get_where('konser', array('konserId'=>$konserId));
            // if ($konser->num_rows() > 0) {
            //     # code...
            $this->db->where(array('konserId'=>$konserId));
            $this->db->update('konser',$data);
        }
        function tambah($bannerKonser, $namaKonser, $artist, $waktu, $harga, $lokasi, $deskripsi, $qty)
        {
            // str_replace(' ','',strtoupper(substr($nama,0,2).substr($email,rand(1,3),rand(0,2)).substr($nomor_telp,rand(2,3),rand(1,2)).rand(1000,2000).substr($cat,0,3)));
            $konserId = str_replace(' ','',strtoupper('k'.substr($namaKonser,0,2).substr($artist, rand(1,3), rand(0,2)).rand(100,2000).'tik'));
            $data_konser = array(
                'konserId' => $konserId,
                'bannerKonser'=>$bannerKonser,
                'namaKonser'=>$namaKonser,
                'artist'=>$artist,
                'waktu'=>$waktu,
                'harga'=>$harga,
                'lokasi'=>$lokasi,
                'deskripsi'=>$deskripsi,
                'qty'=>$qty,
                'status'=>'belum mulai',
            );
            $this->db->insert('konser',$data_konser);
        }
    }
?>
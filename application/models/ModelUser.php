<?php 
    class ModelUser extends CI_Model 
    {
        
        const SESSION_KEY = 'userId';
        public function __construct()
        {
            parent::__construct();
        }
    
        function register($nama, $username, $email, $password)
        {
            // str_replace(' ','',strtoupper(substr($nama,0,2).substr($email,rand(1,3),rand(0,2)).substr($nomor_telp,rand(2,3),rand(1,2)).rand(1000,2000).substr($cat,0,3)));
            $userId = str_replace(' ','',strtoupper('u'.substr($nama,0,2).substr($email, rand(1,3), rand(0,2)).rand(100,2000).'tik'));
            $data_user = array(
                'userId' => $userId,
                'nama'=>$nama,
                'username'=>$username,
                'email'=>$email,
                // 'role'=>$role,
                'password'=>password_hash($password,PASSWORD_DEFAULT),
            );
            $this->db->insert('user',$data_user);
        }
        public function login($username, $password) {
            $query = $this->db->get_where('user', array('username'=>$username));
            if ($query->num_rows() > 0) {
                $data_user = $query->row();
                if (password_verify($password, $data_user->password)) {
                    $this->session->set_userdata('userId', $data_user->userId);
                    $this->session->set_userdata('profilePicture', $data_user->profilePicture);
                    $this->session->set_userdata('role', $data_user->role);
                    $this->session->set_userdata('nama', $data_user->nama);
                    $this->session->set_userdata('username', $data_user->username);
                    $this->session->set_userdata('email', $data_user->email);
                    $this->session->set_userdata('is_login', TRUE);
                    return TRUE;
                }else {
                    return FALSE;
                }
            }else{
                return FALSE;
            }
        }
        public function logout()
        {
            $this->session->unset_userdata('userId');
            $this->session->unset_userdata('ProfilePicture');
            $this->session->unset_userdata('role');
            $this->session->unset_userdata('nama');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('is_login');
        }
    }
?>
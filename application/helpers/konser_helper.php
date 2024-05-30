<?php
function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) 
    {
        redirect('auth/login');
    }
}
function cek_user()
{
    $ci = get_instance();
    $role = $ci->session->userdata('role');
    if ($role != "administrator") 
    {
        $ci->session->set_flashdata('pesan', '<div class="alert alertdanger" role="alert">Akses tidak diizinkan </div>');
        redirect('home');
    }
}
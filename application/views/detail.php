<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | TICKETU</title>
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/home/style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <?php $this->load->view('admin/snippets/style') ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/home/sliders.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/home/custom.css">
</head>
<body>
    
    <!-- -->
    <div class="container-fluid d-md-flex align-items-stretch">
        <!-- Page Content  -->
        <?php $this->load->view('snippets/navbar') ?>
        
        <div id="content" class="p-4 p-md-5">
            <h2 class="line-title mt-2">Konser</h2>
            <div class="row">
                <div class="col-md-9">
                    <?php foreach ($konser->result() as $konser) { ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="container">
                                    <img class="img-fluid" width="400px" src="<?php echo base_url() ?>/<?php echo $konser->bannerKonser ?>" alt="" srcset="">
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <h3><?php echo $konser->namaKonser ?></h3>
                                <p>Jadwal Konser : <b><?php $date = date_create($konser->waktu); echo date_format($date, "D, d M Y")  ?></b></p>
                                <!-- <p>Jadwal Konser : <b><?php echo $konser->waktu  ?></b></p> -->
                                <p>Lokasi : <b><?php echo $konser->lokasi ?>. Kota <?php echo $konser->kota ?></b></p>
                                <p>Band & Artis yang akan hadir : <b><?php echo $konser->artist ?></b></p>
                                <p>Harga : <b><?php echo number_format($konser->harga, 2) ?></b></p>
                                <p>tiket tersedia : <b><?php echo $konser->qty ?></b></p>
                                <?php if ($this->session->userdata('is_login')){?>
            
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#keranjang">
                                        Masukan ke keranjang
                                    </button>
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                                        Beli Langsung
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="keranjang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pesan Tiket</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <form class="mt-3" method="POST" action="<?php echo base_url() ?>/home/addcart/<?php echo $konser->konserId ?>">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Jumlah</label>
                                                        <input type="number" class="form-control" name="jumlah" id="jumlah" aria-describedby="emailHelp" value="1" placeholder="<?php echo $this->session->userdata('email') ?>" require>
                                                        <small class="form-text text-muted">Secara default email mengikuti email anda</small>
                                                    </div>           
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Masukan Ke Keranjang</button>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pesan Tiket</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Form pembelian tiket untuk konser <b><?php echo $konser->namaKonser ?></b></p>
                                                <small class="form-text text-muted">pembeli harap mengisi form dengan lengkap dan harap melanjutkan ke proses pembayaran</small>
                                                <form class="mt-3" method="POST" action="<?php echo base_url() ?>home/addBooked/<?php echo $konser->konserId ?>">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email</label>
                                                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" value="<?php echo $this->session->userdata('email') ?>" placeholder="<?php echo $this->session->userdata('email') ?>" require>
                                                        <small class="form-text text-muted">Secara default email mengikuti email anda</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nomorTelp">Nomor Telepon</label>
                                                        <input type="number" class="form-control" value="62" name="nomorTelp" id="nomorTelp" placeholder="Masukan Nomor Telpon anda" require>
                                                        <small id="emailHelp" class="form-text text-muted">contoh : <b>62812345678911</b></small>
                                                    </div>            
                                                    <div class="form-group">
                                                        <label for="namaPemesan">Nama Pemesan</label>
                                                        <input type="text" class="form-control" value="<?php echo $this->session->userdata('nama') ?>" name="namaPemesan" id="namaPemesan" placeholder="nama" require>
                                                        <small id="emailHelp" class="form-text text-muted">Secara default nama mengikuti nama anda</small>
                                                    </div>            
                                                    <div class="form-group">
                                                        <label for="jumlah">Jumlah Tiket Yang Dipesan</label>
                                                        <input type="number" class="form-control" value="1" name="jumlah" id="jumlah" placeholder="jumlah" require>
                                                        <small id="emailHelp" class="form-text text-muted">Harga per-tiket : <b><?php echo number_format($konser->harga, 2) ?></b></small>
                                                    </div>            
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Book now!</button>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else{?>
                                    <div class="mb-5">
                                        <a href="<?php echo base_url() ?>auth/login" class="btn btn-block btn-outline-primary">Login</a>
                                        <p class="disabled">login to buy ticket</p>
                                    </div>

                                <?php } ?>
                                <!-- Button trigger modal -->

                                
                            </div>
                        </div>
                    <?php } ?>
                    <div class="mt-3">
                        <p><?php echo $konser->deskripsi ?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <?php $this->load->view('snippets/sidebar') ?>
                </div>
            </div>
    
    </div>	    


    <script src="<?php echo base_url() ?>assets/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/popper/popper.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>assets/home/script.js"></script>
    <?php $this->load->view('admin/snippets/script') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="<?php echo base_url() ?>assets/home/sliders.js"></script>
</body>
</html>
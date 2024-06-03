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
<?php $this->load->view('snippets/navbar') ?>

    <div class="container-fluid d-md-flex align-items-stretch">
        <!-- Page Content  -->
        
        
        <div id="content" class="p-4 p-md-5">
            <h2 class="line-title mt-2">Konser</h2>
            <div class="row">
                <div class="col-md-9">
                    <div class="row justify-content-center">
                        <?php $nomor = 1 ?>
                        <?php foreach ($keranjang->result() as $k) {
                            $konser = $this->ModelKonser->detail($k->konserId); 
                            ?>
                        <?php foreach ($konser->result() as $konser) { 
                            $num = $nomor++; ?>
                            
                            <div class="col-md-4 mt-2 mb-2">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="<?php echo base_url() ?>/<?php echo $konser->bannerKonser ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $konser->namaKonser ?></h5>
                                        <p class="card-text"><?php echo substr($konser->deskripsi,0, 94) ?></p>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $num ?>">
                                        Pesan Sekarang <?php echo $k->jumlah ?>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?php echo $num ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Pesan Tiket <?php echo $k->jumlah ?></h5>
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
                                                            <input type="number" class="form-control" value="<?php echo $k->jumlah ?>" name="jumlah" id="jumlah" placeholder="jumlah" require>
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
                                    </div>
                                </div>
                            </div>        
                        <?php } ?>
                        <?php } ?>
                        
                    </div>
                </div>
                <div class="col-md-3">
                    <nav id="sidebar" style="border-right: none;">
                        <div class="pl-4">
                            <h5>HELLO! <?php echo $this->session->userdata("nama") ?></h5>
                            <ul class="list-unstyled components mb-5">
                                <li>
                                    <a href="#pageSubmenu1" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle"></a>
                                    <ul class="collapse list-unstyled" id="pageSubmenu1">
                                        
                                    </ul>
                                </li>
                            </ul>
                            <div class="mb-5">
                                <h5>Kota</h5>
                                <div class="tagcloud">
                                    <a href="#" class="tag-cloud-link">Jakarta</a>
                                    <a href="#" class="tag-cloud-link">Bogor</a>
                                    <a href="#" class="tag-cloud-link">Depok</a>
                                    <a href="#" class="tag-cloud-link">Tanggerang</a>
                                    <a href="#" class="tag-cloud-link">Bekasi</a>
                                </div>
                            </div>
                            </ul>
                            <?php if ($this->session->userdata('is_login')){?>
            
                                <div class="mb-5">
                                    <a href="<?php echo base_url() ?>auth/logout" class="btn btn-block btn-sm btn-outline-danger">Logout</a>
                                </div>
                            <?php } else{?>
                                    <div class="mb-5">
                                        <a href="<?php echo base_url() ?>auth/login" class="btn btn-block btn-sm btn-outline-primary">Login</a>
                                    </div>
            
                            <?php } ?>
                        </div>
                    </nav>
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
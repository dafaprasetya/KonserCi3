<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | TICKETU</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/home/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/home/sliders.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/home/custom.css">
</head>
<body>
<?php $this->load->view('snippets/navbar') ?>

    <section class="game-section mt-4">
        <h2 class="line-title">Konser HITS yang akan datang di TICKETU</h2>
        <div class="owl-carousel custom-carousel owl-theme">
            <?php foreach ($hits->result() as $hits) { ?>
                
                <div class="item" style="background-image: url(<?php echo base_url()."/".$hits->bannerKonser ?>);">
                     <div class="item-desc">
                        <h3 style="color: white;"><?php echo $hits->namaKonser ?></h3>
                        <p><?php echo substr($hits->deskripsi,0, 124) ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <div class="container-fluid d-md-flex align-items-stretch">
        <!-- Page Content  -->
        
        
        <div id="content" class="p-4 p-md-5">
            <h2 class="line-title mt-2">Konser</h2>
            <div class="row">
                <div class="col-md-9">
                    <div class="row justify-content-center">
                        <?php foreach ($konser->result() as $konser) {?>
                            
                            <div class="col-md-4 mt-2 mb-2">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="<?php echo base_url() ?>/<?php echo $konser->bannerKonser ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $konser->namaKonser ?></h5>
                                        <p class="card-text"><?php echo substr($konser->deskripsi,0, 94) ?></p>
                                        <a href="<?php echo base_url() ?>home/konser/<?php echo $konser->konserId ?>" class="btn btn-primary btn-md">Pesan Tiket</a>
                                        <?php if ($this->session->userdata('is_login')){?>    
                                            <form class="mt-2 addcart" action="<?php echo base_url() ?>/home/addcart/<?php echo $konser->konserId ?>" method="post">
                                                <input type="number" name="jumlah" placeholder="masukan jumlah tiket" id="jumlah" value="0">
                                                <button type="submit" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                                                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>        
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="<?php echo base_url() ?>assets/home/sliders.js"></script>
</body>
</html>
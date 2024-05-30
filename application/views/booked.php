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
    <script type="text/javascript"
		src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-l9frwQ_JZlEMWG1h"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/home/sliders.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/home/custom.css">
</head>
<body>
    
    <!-- -->
    <div class="container-fluid d-md-flex align-items-stretch">
        <!-- Page Content  -->
        <?php $this->load->view('snippets/navbar') ?>
        
        <div id="content" class="p-4 p-md-5">
            <h2 class="line-title mt-2">Bill</h2>
            <div class="row">
                <div class="col-md-9">
                    <div class="row justify-content-center">
                        <?php if ($booked->num_rows() > 0) { ?>
                        <?php $num = 0 ?>
                        <?php foreach ($booked->result() as $booked) {?>
                            <?php $tambah = $num++ ?>
                            <div class="col-md-4 mt-2 mb-2">
                                <div class="card" style="width: 18rem;">
                                <?php if ($booked->status == "UNPAID") { ?>
                                    <img class="card-img-top" src="<?php echo base_url() ?>assets/gambar/UNPAID.png" id="gambarBayar" alt="Card image cap">
                                <?php }else { ?>
                                        <img class="card-img-top" src="<?php echo base_url() ?>assets/gambar/PAID.png" id="gambarBayar" alt="Card image cap">
                                    
                                <?php } ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><b><?php echo $booked->namaKonser ?></b></h5>
                                        <p class="card-text"> Booked Id : <?php echo substr($booked->bookedId,0,9) ?></p>
                                        <p class="card-text"> Email : <?php echo $booked->email ?></p>
                                        <p class="card-text"> Nama Pemesan : <?php echo $booked->namaPemesan ?></p>
                                        <p class="card-text"> Total Harga : Rp. <?php echo number_format($booked->totalHarga, 2) ?>,-</p>
                                        <?php if ($booked->status == "UNPAID") { ?>
                                            <!-- <form class="mt-2 addcart" id="bayar<?php echo $tambah ?>" > -->
                                                <a data-href="<?php echo base_url() ?>home/token/<?php echo $booked->bookedId ?>" id="tombolBayar<?php echo $tambah ?>" class="btn btn-primary text-light">Bayar</a> 
                                                <!-- <button type="submit"></button> -->
                                            <!-- </form> -->
                                            <script>
                                                $(document).ready(function () {
                                                    $('#tombolBayar<?php echo $tambah ?>').click(function (e){
                                                        e.preventDefault();
                                                        $.ajax({
                                                            type :"POST",
                                                            url : $(this).data("href"),
                                                            // dataType: "json",
                                                            // data : {},
                                                            success:function(response){
                                                                console.log('Waiting For Snapppp!!!!!!!');
                                                                snap.pay(response.snapToken, {
                                                                    onSuccess: function(result){
                                                                        console.log('success');
                                                                        // console.log(result);
                                                                        $.ajax({
                                                                            type : "POST",
                                                                            url : "<?php echo base_url() ?>home/paymentSuccess/<?php echo $booked->bookedId ?>",
                                                                            data : {
                                                                                'transaction_id' : result.transaction_id,
                                                                                'transaction_time' : result.transaction_time,
                                                                                'payment_type' : result.payment_type,
                                                                            },
                                                                            success:function(response){
                                                                                // console.log(response);
                                                                                console.log(response.success);
                                                                                
                                                                                $.ajax({
                                                                                    type : "POST",
                                                                                    url : "<?php echo base_url() ?>home/tiketCreate/"+result.transaction_id,
                                                                                    data : {
                                                                                        'transaction_id' : result.transaction_id,
                                                                                    },
                                                                                    success:function(response){
                                                                                        console.log(response.success);
                                                                                    },error:function(response){
                                                                                        console.log(response.error);
                                                                                    },
                                                                                }),
                                                                                $("#tombolBayar<?php echo $tambah ?>").html("Lihat Tiket");
                                                                                $("#gambarBayar").attr("src","<?php echo base_url() ?>assets/gambar/PAID.png");
                                                                            }
                                                                        })
                                                                    },
                                                                    onPending: function(result){
                                                                        console.log('pending');console.log(result);
                                                                        $("#tombolBayar").html("Buka Kembali Pembayaran");
                                                                    },
                                                                    onError: function(result){console.log('error');console.log(result);},
                                                                    onClose: function(){console.log('customer closed the popup without finishing the payment');}
                                                                })
                                                                // console.log(response.responseJSON['snapToken']);
                                                            },error: function(response){
                                                                console.log('error');
                                                            }
                                                        })
                                                    })
                                                })
                                            </script>
                                           
                                            <?php }else { ?>
                                                <a class="text-light btn btn-primary btn-md">Lihat Tiket</a> 
                                            
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>        
                        <?php } ?>
                        <?php } ?>
                        
                    </div>
                </div>

                <div class="col-md-3">
                    <?php $this->load->view('snippets/sidebar') ?>
                </div>
            </div>
    
    </div>	    

  <!-- @TODO: You can add the desired ID as a reference for the embedId parameter. -->

  
    <script src="<?php echo base_url() ?>assets/jquery/jquery.min.js"></script>
    
    <script src="<?php echo base_url() ?>assets/popper/popper.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>assets/home/script.js"></script>
    <?php $this->load->view('admin/snippets/script') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="<?php echo base_url() ?>assets/home/sliders.js"></script>
    

</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <?php $this->load->view('admin/snippets/style') ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('admin/snippets/sidebar') ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('admin/snippets/topbar') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <?php $this->load->view('admin/snippets/konser') ?>

                    <!-- Content Row -->

                    <div class="row">

                       

                        
                    </div>
                    
                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Semua konser</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tiket Id</th>
                                            <th>Booked Id</th>
                                            <th>Lihat Detail</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tiket Id</th>
                                            <th>Booked Id</th>
                                            <th>Lihat Detail</th>
                                        </tr>
                                    </tfoot>
                                    <tbody> 
                                    <?php 
                                            $nomor = 1;
                                            foreach ($tiket->result() as $row)
                                            {
                                                echo "<tr>";
                                               
                                                echo '<td>'.$nomor++.'</td>';
                                                echo '<td>'.$row->tiketId.'</td>';
                                                echo '<td>'.$row->bookedId.'</td>';
                                                $num = $nomor++;
                                                $booked = $this->ModelTiket->getBooked($row->tiketId);
                                                ?>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#detail<?php echo $num ?>">
                                                        lihat selengkapnya
                                                    </button>
                                                </td>
                                                
                                                <?php foreach ($booked->result() as $booked) { ?>
                                                
                                                        <div class="modal fade" id="detail<?php echo $num ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Booking Detail</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Tiket Id : <b><?php echo $booked->tiketId ?></b></p>
                                                                    <hr>
                                                                    <p>Booked Id: <b><?php echo $booked->bookedId ?></b></p>
                                                                    <p>Konser ID : <b><?php echo $booked->konserId ?></b></p>
                                                                    <p>Nama Konser : <b><?php echo $booked->namaKonser ?></b></p>
                                                                    <p>ID user pemesan : <b><?php echo $booked->userId ?></b></p>
                                                                    <p>Nama User : <b><?php echo $booked->userBooked ?></b></p>
                                                                    <p>Pemesan : <b><?php echo $booked->namaPemesan ?> </b> no.Telp: <b><?php echo $booked->nomorTelp ?></b></p>
                                                                    <p>Total Harga : <b><?php echo $booked->totalHarga ?></b></p>
                                                                    <p>Status : <b><?php echo $booked->status ?></b></p>
                                                                    <hr>
                                                                    <p>Transaction ID : <b><?php echo $booked->transaction_id ?></b></p>
                                                                    <p>Transaction Time : <b><?php echo $booked->transaction_time ?></b></p>
                                                                    <p>Payment Type : <b><?php echo $booked->payment_type ?></b></p>
                                                                    <hr>
                                                                    <p>Created At : <b><?php echo $booked->time ?></b></p>
                                                                    
                                                                </div>
                                                                
                                                                </div>
                                                            </div>
                                                        </div> 
                                                <?php } ?>
                                                
                                            <?php
                                            
                                            }
                                        ?>
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/snippets/script') ?>
    

</body>

</html>
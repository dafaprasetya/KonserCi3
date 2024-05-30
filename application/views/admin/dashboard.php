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
                                            <th>konser ID</th>
                                            <th>Nama Konser</th>
                                            <th>Artis</th>
                                            <th>Waktu</th>
                                            <th>Harga</th>
                                            <th>Lokasi</th>
                                            <th>Jumlah Tiket</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>konser ID</th>
                                            <th>Nama Konser</th>
                                            <th>Artis</th>
                                            <th>Waktu</th>
                                            <th>Harga</th>
                                            <th>Lokasi</th>
                                            <th>Jumlah Tiket</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody> 
                                    <?php 
                                            $nomor = 1;
                                            foreach ($konser->result() as $row)
                                            {
                                                echo "<tr>";
                                               
                                                echo '<td>'.$row->konserId.'</td>';
                                                echo '<td>'.$row->namaKonser.'</td>';
                                                echo '<td>'.$row->artist.'</td>';
                                                echo '<td>'.$row->waktu.'</td>';
                                                echo '<td>'.$row->harga.'</td>';
                                                echo '<td>'.$row->lokasi.'</td>';
                                                echo '<td>'.$row->qty.'</td>';
                                                echo '<td>'.$row->status.'</td>';
                                                ?>
                                                <td>
                                                    
                                                    <a href="<?php echo base_url() ?>admin/konser/dashboard/edit/<?php echo $row->konserId ?>" class="btn mb-2 btn-sm btn-warning">Edit</a>
                                                    <a href="<?php echo base_url() ?>admin/konser/dashboard/delete/<?php echo $row->konserId ?>" class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                                
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
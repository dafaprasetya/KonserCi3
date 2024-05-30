<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Konser</title>
    <?php $this->load->view('admin/snippets/style') ?>
</head>
<body id="page-top">
    
    <div id="wrapper">

        <?php $this->load->view('admin/snippets/sidebar') ?>
        <div id="content-wrapper">
            <?php $this->load->view('admin/snippets/topbar') ?>
            <div class="container-fluid">
                <!-- TOTAL KONSER -->
                <?php $this->load->view('admin/snippets/konser') ?>
                <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Konser</h6>
                            <?php if ($this->session->flashdata("error")) { ?>
                                <h1>
                                    <b><?php echo $this->session->flashdata("error") ?></b>
                                </h1>
                            <?php } ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if (isset($detail)) {
                                    foreach ($detail->result() as $detail) { ?>
                                    <form action="<?php echo base_url() ?>admin/konser/tambah/edit/<?php echo $detail->konserId ?>" method="post" enctype="multipart/form-data">
                                        <table class="table table-borderless center" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th><label for="nama" class="form-label">Nama Konser</label></th>
                                                    <th>
                                                        <input placeholder="Masukan nama konser" value="<?php echo $detail->namaKonser ?>" name="namaKonser" id="namaKonser" type="text" class="form-control border-top-0 border-right-0 border-left-0">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th><label for="waktu" class="form-label">Tanggal Konser</label></th>
                                                    <th>
                                                        <input placeholder="Masukan tanggal konser" value="<?php echo $detail->waktu ?>" name="waktu" id="waktu" type="date" class="form-control border-top-0 border-right-0 border-left-0">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th><label for="nama" class="form-label">Lokasi Konser</label></th>
                                                    <th>
                                                        <input placeholder="Masukan nama konser" value="<?php echo $detail->lokasi ?>" name="lokasi" id="lokasi" type="text" class="form-control border-top-0 border-right-0 border-left-0">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th><label for="nama" class="form-label">Artis utama</label></th>
                                                    <th>
                                                        <input placeholder="Masukan nama artis utama" value="<?php echo $detail->artist ?>" name="artis" id="artis" type="text" class="form-control border-top-0 border-right-0 border-left-0">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th><label for="platinum" class="form-label">Harga Tiket dan Jumlah Tiket</label></th>
                                                    <th>
                                                        <input placeholder="Masukan harga tiket" value="<?php echo $detail->harga ?>" name="harga" id="harga" type="text" class="form-control border-top-0 border-right-0 border-left-0">
                                                    </th>
                                                    <th>
                                                        <input placeholder="Masukan jumlah tiket" value="<?php echo $detail->qty ?>" name="qty" id="qty" type="number" class="form-control border-top-0 border-right-0 border-left-0">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                
                                                    <th><label for="silver" class="form-label">Banner konser</label></th>
                                                    <th>
                                                        <input placeholder="Masukan banner tiket" name="bannerKonser" id="bannerKonser" type="file" class="form-control border-top-0 border-right-0 border-left-0">
                                                    </th>
                                                
                                                </tr>
                                            </thead>
                                            <thead >
                                                <tr>
                                                    <th><label for="keterangan" class="form-label">Deskripsi konser</label></th>
                                                    <th>
                                                        <textarea name="deskripsi" placeholder="Masukan keterangan konser" id="deskripsi" cols="10" rows="2" class="form-control"><?php echo $detail->deskripsi ?></textarea>
                                                    </th>
                                                </tr>
                                            </thead>            
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <label for="status" class="form-label">Status</label>
                                                    </th>
                                                    <th>
                                                    <select class="form-select" id="status" name="status" aria-label="Default select example">
                                                        <option selected><?php echo $detail->status ?></option>
                                                        <option value="1">Selesai</option>
                                                        <option value="2">Berlangsung</option>
                                                        <option value="3">Belum Mulai</option>
                                                    </select>
                                                    </th>
                                                </tr>
                                            </thead>      
                                        </table>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </form>

                                <?php
                                    }
                                } else {?>
                                <form action="<?php echo base_url() ?>admin/konser/tambah" method="post" enctype="multipart/form-data">
                                    <table class="table table-borderless center" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th><label for="nama" class="form-label">Nama Konser</label></th>
                                                <th>
                                                    <input placeholder="Masukan nama konser" name="namaKonser" id="namaKonser" type="text" class="form-control border-top-0 border-right-0 border-left-0">
                                                </th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th><label for="waktu" class="form-label">Tanggal Konser</label></th>
                                                <th>
                                                    <input placeholder="Masukan tanggal konser" name="waktu" id="waktu" type="date" class="form-control border-top-0 border-right-0 border-left-0">
                                                </th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th><label for="nama" class="form-label">Lokasi Konser</label></th>
                                                <th>
                                                    <input placeholder="Masukan nama konser" name="lokasi" id="lokasi" type="text" class="form-control border-top-0 border-right-0 border-left-0">
                                                </th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th><label for="nama" class="form-label">Artis utama</label></th>
                                                <th>
                                                    <input placeholder="Masukan nama artis utama" name="artis" id="artis" type="text" class="form-control border-top-0 border-right-0 border-left-0">
                                                </th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th><label for="platinum" class="form-label">Harga Tiket dan Jumlah Tiket</label></th>
                                                <th>
                                                    <input placeholder="Masukan harga tiket" name="harga" id="harga" type="text" class="form-control border-top-0 border-right-0 border-left-0">
                                                </th>
                                                <th>
                                                    <input placeholder="Masukan jumlah tiket" name="qty" id="qty" type="number" class="form-control border-top-0 border-right-0 border-left-0">
                                                </th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                            
                                                <th><label for="silver" class="form-label">Banner konser</label></th>
                                                <th>
                                                    <input placeholder="Masukan banner tiket" name="bannerKonser" id="bannerKonser" type="file" class="form-control border-top-0 border-right-0 border-left-0">
                                                </th>
                                            
                                            </tr>
                                        </thead>
                                        <thead >
                                            <tr>
                                                <th><label for="keterangan" class="form-label">Deskripsi konser</label></th>
                                                <th>
                                                    <textarea name="deskripsi" placeholder="Masukan keterangan konser" id="deskripsi" cols="10" rows="2" class="form-control"></textarea>
                                                </th>
                                            </tr>
                                        </thead>                    
                                    </table>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </form>
                                <?php } ?>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/snippets/script') ?>


</body>
</html>
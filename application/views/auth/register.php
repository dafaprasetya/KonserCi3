<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/custom/auth/auth.css">
</head>
<body style="background-image: url('<?php echo base_url() ?>assets/custom/auth/bckg.png'); background-size: cover;">

    <?php if ($this->session->flashdata("error")) { ?>
        <div class="toast-container top-0 end-0 p-3" id="toastPlacement">
            <div class="toast fade show" role="success" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">ERROR</strong>
                    <small class="text-body-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                        </svg>
                    </small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <b><?php echo $this->session->flashdata("error") ?></b>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="container d-flex justify-content-center">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-center m-3">
                <h4><b>Register</b></h4>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo base_url() ?>auth/register/register">
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Name of you">
                    </div>
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="username" name="username" class="form-control" id="username" placeholder="Unique username for login">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Unique email for login">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password must strong">
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
        
            </div>
        </div>
    </div>
    <div class="mt-3 contain d-flex justify-content-center"><a href="<?php echo base_url() ?>auth/login">login</a></div>
    <script src="<?php echo base_url() ?>assets/popper/popper.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.js"></script>
</body>
</html>
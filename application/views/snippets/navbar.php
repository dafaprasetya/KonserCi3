<nav class="navbar navbar-expand-sm navbar-light fixed-top justify-content-between">
        <a class="navbar-brand" href="#">
            <!-- <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" alt=""> -->
            <h4>U</h4>
            
        </a>
        <?php if ($this->session->userdata('is_login')){?>
            <div class="inline">
                <a href="<?php echo base_url() ?>home/cart/<?php echo $this->session->userdata('userId') ?>" class="ml-3 mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    </svg>
                </a>
                <a href="<?php echo base_url() ?>home/bill/<?php echo $this->session->userdata('userId') ?>" class="mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-text-fill" viewBox="0 0 16 16">
                        <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1m-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1m0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1"/>
                    </svg>
                </a>

                <a href="<?php echo base_url() ?>auth/logout" class="btn btn-md btn-sm btn-danger">Logout</a>
            </div>
        <?php } else{?>
            <a href="<?php echo base_url() ?>auth/login" class="btn btn-md btn-primary">Login</a>
        <?php } ?>
</nav>
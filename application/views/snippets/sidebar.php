<nav id="sidebar" style="border-right: none;">
    <div class="pl-4">
        <h5 class="text-dark">HELLO! <?php echo $this->session->userdata("nama") ?></h5>
        <ul class="list-unstyled components text-dark mb-5">
            <li>
                <a href="#pageSubmenu1" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle"></a>
                <ul class="collapse list-unstyled" id="pageSubmenu1">      
                </ul>
            </li>
            </ul>
            <div class="mb-5">
                <h5 class="text-dark">Kota</h5>
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
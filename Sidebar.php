<div class="col-lg-3">
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded border mt-2">
        <div class="container-fluid ">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start " tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel" style="width:250px ">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MainMenu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo ((isset($_GET['x']) && $_GET['x'] == 'home') || !isset($_GET['x'])) ? 'active link-light bg-success' : 'link-dark'; ?>"
                                aria-current="page" href="home"><i class="bi bi-house "></i> Dashboard</a>
                        </li>

                        <?php if($hasil['level']==1 || $hasil['level']==3){?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'daftar') ? 'active link-light bg-success' : 'link-dark'; ?>"
                                href="daftar"><i class="bi bi-card-list "></i>
                                Daftar Beras</a>
                        </li>
                        <?php } ?>
                        <?php if($hasil['level']==1){?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'katber') ? 'active link-light bg-success' : 'link-dark'; ?>"
                                href="katber"><i class="bi bi-tags"></i>
                                Kategori Beras</a>
                        </li>
                        <?php } ?>

                        <?php if($hasil['level']==1 || $hasil['level']==2 || $hasil['level']==3){?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'order') ? 'active link-light bg-success' : 'link-dark'; ?>"
                                href="order"><i class="bi bi-bag "></i>
                                Order</a>
                        </li>
                        <?php }?>


                        <?php if($hasil['level']==1){?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'user') ? 'active link-light bg-success' : 'link-dark'; ?>"
                                href="user"><i class="bi bi-people"></i> User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'report') ? 'active link-light bg-success' : 'link-dark'; ?>"
                                href="report"><i class="bi bi-bar-chart-line"></i> report</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
<?= $this->include('layouts/header/index') ?>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <?= $this->include('layouts/navbar_top/mahasiswa') ?>
        <!-- Page Header Ends -->

        <!-- Page Body Start-->
        <div class="page-body-wrapper horizontal-menu">
            <!-- Page Sidebar Start-->
            <?= $this->include('layouts/navbar_side/mahasiswa') ?>
            <!-- Page Sidebar Ends-->

            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row starter-main">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h5>Mahasiswa</h5>
                                    <div class="setting-list">
                                        <ul class="list-unstyled setting-option">
                                            <li>
                                                <div class="setting-primary"><i class="icon-settings"></i></div>
                                            </li>
                                            <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                                            <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                                            <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">

                                </div>
                            </div>
                        </div>

                    </div> <!-- Container-fluid Ends-->
                </div>
                <!-- footer start-->
                <?= $this->include('layouts/footer/operator') ?>
                <!-- footer ends-->
            </div>
        </div>
        <?= $this->include('layouts/script/operator') ?>
</body>

</html>
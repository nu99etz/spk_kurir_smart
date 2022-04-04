<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-<?php echo $config['main-color']; ?> navbar-<?php echo $config['second-color']; ?>">
    <div class="container">
        <a href="<?php echo $config['base_url'] . $config['path']; ?>" class="navbar-brand">
            <!-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
            <span class="brand-text font-weight-light">Skripsi SMART</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?php echo $config['base_url'] . $config['path']; ?>" class="nav-link">Home</a>
                </li>

                <?php if (Auth::getSession('role') == 1) {
                ?>
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Master Data</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <!-- <li><a href="<?php echo $config['base_url'] . $config['path']; ?>/kurir" class="dropdown-item">Data Kurir </a></li> -->
                            <li><a href="<?php echo $config['base_url'] . $config['path']; ?>/kriteria" class="dropdown-item">Data Kriteria</a></li>
                            <li><a href="<?php echo $config['base_url'] . $config['path']; ?>/nilai_kriteria" class="dropdown-item">Nilai Kriteria</a></li>
                            <li><a href="<?php echo $config['base_url'] . $config['path']; ?>/nilai_bobot" class="dropdown-item">Nilai Bobot</a></li>
                            <li><a href="<?php echo $config['base_url'] . $config['path']; ?>/kurir" class="dropdown-item">Data Kurir</a></li>
                        </ul>
                    </li>
                <?php    } ?>

                <?php if (Auth::getSession('role') == 1) {
                ?>
                    <li class="nav-item">
                        <a href="<?php echo $config['base_url'] . $config['path']; ?>/data_alternatif" class="nav-link">Penilaian Kurir</a>
                    </li>
                <?php   } ?>

                <li class="nav-item">
                    <a href="<?php echo $config['base_url'] . $config['path']; ?>/spk_smart" class="nav-link">Ranking SMART</a>
                </li>
            </ul>

        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- Notifications Dropdown Menu -->
            <?php if (Auth::getSession('role') == 1) {
            ?>
                <li class="nav-item">
                    <a class="nav-link" id="logout" href="#">
                        <i class="fa fa-sign-out-alt"></i> <?php echo ucwords(Auth::getSession('nama_user')); ?>
                    </a>
                </li>
            <?php   } else {
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $config['base_url'] . $config['path']; ?>/auth/login">
                        <i class="fa fa-sign-in-alt"></i> Login
                    </a>
                </li>
            <?php   } ?>

        </ul>
    </div>
</nav>
<!-- /.navbar -->

<script>
    $('#logout').click(function() {
        Swal.fire({
            title: 'Apakah Anda Yakin Keluar Dari Sistem ?',
            showCancelButton: true,
            confirmButtonText: `Logout`,
            confirmButtonColor: '#d33',
            icon: 'question'
        }).then((result) => {
            if (result.value) {
                let _url = "<?php echo $config['base_url'] . $config['path']; ?>/auth/proses_logout";
                send((data, xhr = null) => {
                    if (data.status == "success") {
                        Swal.fire({
                            type: 'success',
                            title: "Logout Sukses",
                            text: data.messages,
                            timer: 3000,
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.href = "<?php echo $config['base_url'] . $config['path']; ?>";
                        });
                    } else if (data.status == "failed") {
                        toastr.error(data.messages);
                    }
                }, _url, "json");
            }
        })
    });
</script>
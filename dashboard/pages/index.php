<?php

defined('__VALID_ENTRANCE') or die('Dilarang Akses Halaman Ini :v');

Page::useLayout("app");

$sqlkaryawan = "select count(*) as total_karyawan from karyawan";
$querykaryawan = mysqli_query($conn->connect(), $sqlkaryawan);
$totalkaryawan = mysqli_fetch_assoc($querykaryawan);

$sqlkaryawanAlternatif = "select count(*) as total_karyawan from karyawan where id in (select id_karyawan from data_alternatif)";
$querykaryawanAlternatif = mysqli_query($conn->connect(), $sqlkaryawanAlternatif);
$totalkaryawanAternatif = mysqli_fetch_assoc($querykaryawanAlternatif);

?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Dashboard </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Layout</a></li> -->
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $totalkaryawan['total_karyawan'];?></h3>

                        <p>Kurir</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $totalkaryawanAternatif['total_karyawan'];?></h3>

                        <p>Data Alternatif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php Page::buildLayout(); ?>
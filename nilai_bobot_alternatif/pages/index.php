<?php

defined('__VALID_ENTRANCE') or die('Dilarang Akses Halaman Ini :v');

Page::useLayout("app");

$sql = "select*from kriteria where 1 = 1";
$query_kriteria = mysqli_query($conn->connect(), $sql);

?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Nilai Bobot Alternatif</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo $config['base_url'] . $config['path']; ?>">Home</a></li>
                    <li class="breadcrumb-item active">Kriteria</li>
                    <li class="breadcrumb-item active">Nilai Bobot Alternatif</li>
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
            <!-- /.col-md-6 -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Nilai Bobot Alternatif</h5>
                    </div>
                    <div class="card-body">
                        <table id="alternatif" class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <th>No</th>
                                <th>Nama Kurir</th>
                                <?php while ($kriteria = mysqli_fetch_assoc($query_kriteria)) {
                                ?>
                                    <th><?php echo ucwords($kriteria['nama_kriteria']); ?></th>
                                <?php  } ?>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<script>
    let _table = $("#alternatif");
    let _url = "<?php echo $config['base_url'] . $config['path']; ?>/nilai_bobot_alternatif/list_nilai_bobot_alternatif";

    DataTables(_url, _table);

</script>

<?php Page::buildLayout(); ?>
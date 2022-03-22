<?php

defined('__VALID_ENTRANCE') or die('Dilarang Akses Halaman Ini :v');

Page::useLayout("app");

$sql = "select*from kriteria where 1 = 1";
$query_kriteria = mysqli_query($conn->connect(), $sql);

$sqlKriteria = "select id from kriteria";
$queryKriteria = mysqli_query($conn->connect(), $sqlKriteria);

$kriteriaRow = [];
while ($kriteria = mysqli_fetch_array($queryKriteria)) {
    $kriteriaRow[] = $kriteria['id'];
}

$sqlNilaiBobot = "select*from nilai_bobot";
$queryNilaiBobot = mysqli_query($conn->connect(), $sqlNilaiBobot);

$nilaiBobotRow = [];
while ($nilaiBobot = mysqli_fetch_array($queryNilaiBobot)) {
    $nilaiBobotRow[$nilaiBobot['id_kriteria']] = $nilaiBobot['nilai_bobot_kriteria'];
}

// Maintence::debug($nilaiBobotRow);

$sumNilaiBobot = array_sum($nilaiBobotRow);

if ($sumNilaiBobot != 100) {
    $status = 422;
    $msg = "Nilai Bobot Harus 100%";
} else {

    // cek jumlah karyawan jika jumlah karyawan kurang dari 3 maka tidak bisa dilakukan perankingan
    $sqlKurir = "select count(*) as jumlah_karyawan from karyawan where id in (select id_karyawan from data_alternatif)";
    $queryKurir = mysqli_query($conn->connect(), $sqlKurir);
    $jumlahKurir = mysqli_fetch_array($queryKurir);

    if ($jumlahKurir['jumlah_karyawan'] < 3) {
        $status = 422;
        $msg = "jumlah data alternatif harus lebih dari 2";
    } else {
        // MENGHITUNG Normalisasi BOBOT
        $normalisasiBobot = [];
        foreach ($nilaiBobotRow as $key => $value) {
            $normalisasiBobot[$key] = $value / $sumNilaiBobot;
        }

        // Maintence::debug($normalisasiBobot);

        function getNilai($data, $idKriteria)
        {
            if (isset($data[$idKriteria])) {
                return $data[$idKriteria];
            } else {
                return 0;
            }
        }

        $sql = "select a.*, b.nama_kriteria, c.nama_karyawan from data_alternatif a left join kriteria b on a.id_kriteria = b.id join karyawan c on a.id_karyawan = c.id";

        $query = mysqli_query($conn->connect(), $sql);

        $map = [];
        $record = [];
        $no = 1;

        while ($alternatif = mysqli_fetch_array($query)) {
            $row = [];
            $map[$alternatif['id_karyawan']][$alternatif['nama_karyawan']][$alternatif['id_kriteria']] = $alternatif['nilai_alternatif'];
        }

        foreach ($map as $key => $value) {
            $row = [];
            $row['id_karyawan'] = $key;
            foreach ($value as $key2 => $value2) {
                $row['nama'] = $key2;
            }
            foreach ($kriteriaRow as $value) {
                $row['nilai'][$value] = getNilai($value2, $value);
            }
            $record[] = $row;
        }

        // MAPPING UNTUK NILAI MIN MAX
        $row = [];
        foreach ($kriteriaRow as $kriteriaValue) {
            foreach ($record as $key => $valueRecord) {
                $row[$kriteriaValue][$valueRecord['id_karyawan']] = $valueRecord['nilai'][$kriteriaValue];
            }
        }
        $mapMinMax = $row;

        // MENCARI NILAI MIN DAN MAX
        $minMax = [];
        foreach ($mapMinMax as $key => $value) {
            $minMax[$key]['max'] = max($mapMinMax[$key]);
            $minMax[$key]['min'] = min($mapMinMax[$key]);
        }

        // Maintence::debug($minMax);

        // MENGHITUNG NILAI UTILITY
        $recordUtility = [];
        foreach ($record as $key => $value) {
            $row = [];
            $row['id_karyawan'] = $value['id_karyawan'];
            $row['nama'] = $value['nama'];
            $row['nilai'] = $value['nilai'];
            $row['nilai_utility'] = [];
            foreach ($kriteriaRow as $kriteriaValue) {
                $row['nilai_utility'][$kriteriaValue] = ($value['nilai'][$kriteriaValue] - $minMax[$kriteriaValue]['min']) / ($minMax[$kriteriaValue]['max'] - $minMax[$kriteriaValue]['min']);
            }
            $recordUtility[] = $row;
        }

        // MENGHITUNG NILAI AKHIR
        $recordNA = [];
        foreach ($recordUtility as $key => $value) {
            $row = [];
            $row['id_karyawan'] = $value['id_karyawan'];
            $row['nama'] = $value['nama'];
            $row['nilai'] = $value['nilai'];
            $row['nilai_utility'] = $value['nilai_utility'];
            $na = 0;
            foreach ($kriteriaRow as $kriteriaValue) {
                $na += ($normalisasiBobot[$kriteriaValue] * $value['nilai_utility'][$kriteriaValue]);
            }
            $row['nilai_akhir'] = $na;
            $recordNA[] = $row;
        }

        // PROSES SORT RANK
        array_multisort(array_column($recordNA, 'nilai_akhir'), SORT_DESC, $recordNA);

        $nilaiutility = "";
        $no = 1;
        foreach ($recordNA as $key => $value) {
            $nilaiutility .= "<tr>";
            $nilaiutility .= "<td>" . $no . "</td>";
            foreach ($kriteriaRow as $valueKriteria) {
                $nilaiutility .= "<td>" . $value['nilai_utility'][$valueKriteria] . "</td>";
            }
            $nilaiutility .= "</tr>";
            $no++;
        }

        $rank = "";
        $no = 1;
        foreach ($recordNA as $key => $value) {
            $rank .= "<tr>";
            $rank .= "<td>" . $no . "</td>";
            $rank .= "<td>" . $value['id_karyawan'] . "</td>";
            $rank .= "<td>" . $value['nama'] . "</td>";
            $rank .= "<td>" . $value['nilai_akhir'] . "</td>";
            $rank .= "</tr>";
            $no++;
        }
        $status = 200;
        $msg = "Perankingan Sukses Dilakukan";
    }
}

?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Ranking Weighted Product</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo $config['base_url'] . $config['path']; ?>">Home</a></li>
                    <li class="breadcrumb-item active">Ranking WP</li>
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
                <?php if ($status == 422) {
                    $alert = 'danger';
                    $icon = 'fa-ban';
                    $notif = 'Gagal';
                } else if ($status == 200) {
                    $alert = 'success';
                    $icon = 'fa-check';
                    $notif = 'Sukses';
                } ?>
                <div class="alert alert-<?php echo $alert;?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fa <?php echo $icon;?>"></i> <?php echo $notif;?></h5>
                    <?php echo $msg;?>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Nilai Utility SMART</h5>
                    </div>
                    <div class="card-body">
                        <table id="Nilaiutility" class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <th>No</th>
                                <?php while ($kriteria = mysqli_fetch_assoc($query_kriteria)) {
                                ?>
                                    <th><?php echo $kriteria['nama_kriteria']; ?></th>
                                <?php   } ?>
                            </thead>
                            <tbody><?php echo $nilaiutility; ?></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Ranking SMART</h5>
                    </div>
                    <div class="card-body">
                        <table id="ranking" class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <th>No</th>
                                <th>Id Kurir</th>
                                <th>Nama Kurir</th>
                                <th>Hasil</th>
                            </thead>
                            <tbody><?php echo $rank; ?></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php
$modal_title = "Form Ranking";
$modal_id = "modal_ranking";
$modal_size = "sm";
include(Route::getViewPath("include/modal"));
?>

<script>
    let _table = $("#ranking");
    let _table_utility = $('#Nilaiutility');
</script>

<?php Page::buildLayout(); ?>
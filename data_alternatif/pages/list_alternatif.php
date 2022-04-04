<?php

if (Route::is_ajax()) {

    function getDeskripsi($data, $idKriteria)
    {
        if (isset($data[$idKriteria])) {
            return $data[$idKriteria];
        } else {
            return " - ";
        }
    }

    $sql = "select a.*, b.nama_karyawan, c.nama_kriteria, d.id_kriteria, d.nilai_parameter, d.nilai_bobot from data_alternatif a left join karyawan b on a.id_kurir = b.id left join nilai_kriteria d on a.id_penilaian = d.id left join kriteria c on d.id_kriteria = c.id";

    $query = mysqli_query($conn->connect(), $sql);

    $map = [];
    $record = [];
    $no = 1;

    $sqlKriteria = "select id from kriteria";
    $queryKriteria = mysqli_query($conn->connect(), $sqlKriteria);

    $kriteriaRow = [];
    while ($kriteria = mysqli_fetch_array($queryKriteria)) {
        $kriteriaRow[] = $kriteria['id'];
    }

    while ($alternatif = mysqli_fetch_array($query)) {
        $row = [];
        $map[$alternatif['id_kurir']][$alternatif['nama_karyawan']][$alternatif['id_kriteria']] = $alternatif['nilai_parameter'];
    }

    foreach ($map as $key => $value) {
        $row = [];
        $row[] = $no;
        foreach ($value as $key2 => $value2) {
            $row[] = $key2;
        }
        foreach ($kriteriaRow as $value) {
            $row[] = getDeskripsi($value2, $value);
        }
        // if (Auth::getSession('role') == 1) {
        $button = '<button type="button" name="hapus" id="' . $key . '" class="hapus btn-flat btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
        $button .= '<button type="button" name="ubah" id="' . $key . '" class="ubah btn-flat btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
        $row[] = $button;
        // }
        $no++;
        $record[] = $row;
    }

    echo json_encode([
        'data' => $record,
    ]);
}

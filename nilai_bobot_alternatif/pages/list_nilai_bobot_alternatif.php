<?php

if (Route::is_ajax()) {

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

    $sqlKriteria = "select id from kriteria";
    $queryKriteria = mysqli_query($conn->connect(), $sqlKriteria);

    $kriteriaRow = [];
    while ($kriteria = mysqli_fetch_array($queryKriteria)) {
        $kriteriaRow[] = $kriteria['id'];
    }

    while ($alternatif = mysqli_fetch_array($query)) {
        $row = [];
        $map[$alternatif['id_karyawan']][$alternatif['nama_karyawan']][$alternatif['id_kriteria']] = $alternatif['nilai_alternatif'];
    }

    foreach ($map as $key => $value) {
        $row = [];
        $row[] = $no;
        foreach ($value as $key2 => $value2) {
            $row[] = $key2;
        }
        foreach ($kriteriaRow as $value) {
            $row[] = getNilai($value2, $value);
        }

        $no++;
        $record[] = $row;
    }

    echo json_encode([
        'data' => $record,
    ]);
}

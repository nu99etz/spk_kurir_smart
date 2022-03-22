<?php

if (Route::is_ajax()) {

    $sql = "select*from kriteria_produk a join produk b on a.id_produk = b.id join kriteria c on a.id_kriteria = c.id";

    $query = mysqli_query($conn->connect(), $sql);

    $map = [];
    $record = [];
    $no = 1;

    while ($alternatif = mysqli_fetch_array($query)) {
        $row = [];
        $row[$alternatif['nama_kriteria']] = $alternatif['nilai_kriteria'];
        $map[$alternatif['id_produk']][$alternatif['nama_produk']][] = $row;
    }

    foreach ($map as $key => $value) {
        $row = [];
        $row[] = $no;
        foreach($value as $key2 => $value2) {
            $row[] = $key2;
        }
        foreach ($value2 as $key3 => $value3) {
            foreach ($value3 as $value4) {
                $row[] = $value4;
            }
        }
        $button = '<button type="button" name="hapus" id="' . $key . '" class="hapus btn-flat btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
        $button .= '<button type="button" name="ubah" id="' . $key . '" class="ubah btn-flat btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
        $row[] = $button;
        $no++;
        $record[] = $row;
    }

    // Maintence::debug($record);

    echo json_encode([
        'data' => $record,
    ]);
}

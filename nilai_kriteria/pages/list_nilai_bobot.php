<?php

if (Route::is_ajax()) {

    $sql = "select a.*, b.nama_kriteria from nilai_kriteria a join kriteria b on a.id_kriteria = b.id where 1=1";

    $query = mysqli_query($conn->connect(), $sql);

    $record = [];
    $no = 1;

    while ($nilai_bobot = mysqli_fetch_array($query)) {
        $row = [];
        $row[] = $no;
        $row[] = $nilai_bobot['nama_kriteria'];
        $row[] = $nilai_bobot['nilai_parameter'];
        $row[] = $nilai_bobot['nilai_bobot'];
        // if(Auth::getSession('role') == 1) {
        $button = '<button type="button" name="hapus" id="' . $nilai_bobot['id'] . '" class="hapus btn-flat btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
        $button .= '<button type="button" name="ubah" id="' . $nilai_bobot['id'] . '" class="ubah btn-flat btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
        $row[] = $button;
        // }
        $record[] = $row;
        $no++;
    }

    echo json_encode([
        'data' => $record,
    ]);
}

<?php

if (Route::is_ajax()) {

    $sql = "select*from karyawan";

    $query = mysqli_query($conn->connect(), $sql);

    $record = [];
    $no = 1;

    while ($karyawan = mysqli_fetch_array($query)) {
        $row = [];
        $row[] = $no;
        $row[] = $karyawan['nama_karyawan'];
        // if(Auth::getSession('role') == 1) {
            $button = '<button type="button" name="hapus" id="' . $karyawan['id'] . '" class="hapus btn-flat btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
            $button .= '<button type="button" name="ubah" id="' . $karyawan['id'] . '" class="ubah btn-flat btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $row[] = $button;
        // }
        $record[] = $row;
        $no++;
    }

    echo json_encode([
        'data' => $record,
    ]);
}
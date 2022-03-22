<?php

if (Route::is_ajax()) {

    $sql = "select*from kriteria where 1=1";

    $query = mysqli_query($conn->connect(), $sql);

    $record = [];
    $no = 1;

    while ($kriteria = mysqli_fetch_array($query)) {
        $row = [];
        $row[] = $no;
        $row[] = $kriteria['nama_kriteria'];
        if($kriteria['status_kriteria'] == 0) {
            $row[] = 'Benefit';
        } else if($kriteria['status_kriteria'] == 1) {
            $row[] = 'Cost';
        }
        // if(Auth::getSession('role') == 1) {
            $button = '<button type="button" name="hapus" id="' . $kriteria['id'] . '" class="hapus btn-flat btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
            $button .= '<button type="button" name="ubah" id="' . $kriteria['id'] . '" class="ubah btn-flat btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $row[] = $button;
        // }
        $record[] = $row;
        $no++;
    }

    echo json_encode([
        'data' => $record,
    ]);
}
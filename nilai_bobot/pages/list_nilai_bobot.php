<?php

if (Route::is_ajax()) {

    $sql = "select a.*, b.nama_kriteria from nilai_bobot a join kriteria b on a.id_kriteria = b.id";

    $query = mysqli_query($conn->connect(), $sql);

    $record = [];
    $no = 1;

    $sumTotalNilaiBobot = 0;
    while ($nilai_bobot = mysqli_fetch_array($query)) {
        $row = [];
        $row[] = $no;
        $row[] = $nilai_bobot['nama_kriteria'];
        $row[] = $nilai_bobot['nilai_bobot_kriteria'] . "%";
        $sumTotalNilaiBobot += $nilai_bobot['nilai_bobot_kriteria'];
        // if(Auth::getSession('role') == 1) {
        $button = '<button type="button" name="hapus" id="' . $nilai_bobot['id_kriteria'] . '" class="hapus btn-flat btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
        $button .= '<button type="button" name="ubah" id="' . $nilai_bobot['id_kriteria'] . '" class="ubah btn-flat btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
        $row[] = $button;
        // }
        $record[] = $row;
        $no++;
    }

    $row = [];
    $row[] = "";
    $row[] = "Total Nilai Bobot";
    $row[] = $sumTotalNilaiBobot . "%";
    $row[] = "";
    $record[] = $row;

    echo json_encode([
        'data' => $record,
    ]);
}

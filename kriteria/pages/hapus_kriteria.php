<?php

if (Route::is_ajax()) {

    $id = $p_act;

    $sql_kriteria = "delete from kriteria where id = $id";

    $query_kriteria = mysqli_query($conn->connect(), $sql_kriteria);

    if(!$query_kriteria) {
        $response = [
            'status' => 422,
            'messages' => 'Hapus Kriteria Gagal'
        ];
    } else {
        $response = [
            'status' => 200,
            'messages' => 'Hapus Kriteria Sukses'
        ];
    }

    echo json_encode($response);
}
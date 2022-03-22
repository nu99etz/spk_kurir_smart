<?php

if (Route::is_ajax()) {

    $id = $p_act;

    $sqlAlternatif = "delete from kriteria_produk where id_produk = $id";

    $queryAlternatif = mysqli_query($conn->connect(), $sqlAlternatif);

    if(!$queryAlternatif) {
        $response = [
            'status' => 422,
            'messages' => 'Hapus Alternatif Gagal'
        ];
    } else {
        $response = [
            'status' => 200,
            'messages' => 'Hapus Alternatif Sukses'
        ];
    }

    echo json_encode($response);
}
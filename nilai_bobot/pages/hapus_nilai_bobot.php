<?php

if (Route::is_ajax()) {

    $id = $p_act;

    $sql_produk = "delete from nilai_bobot where id_kriteria = $id";
    
    $query_produk = mysqli_query($conn->connect(), $sql_produk);

    if(!$query_produk) {
        $response = [
            'status' => 422,
            'messages' => 'Hapus Nilai Bobot Gagal'
        ];
    } else {
        $response = [
            'status' => 200,
            'messages' => 'Hapus Nilai Bobot Sukses'
        ];
    }

    echo json_encode($response);
}
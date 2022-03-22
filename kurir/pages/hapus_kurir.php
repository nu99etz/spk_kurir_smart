<?php

if (Route::is_ajax()) {

    $id = $p_act;

    $sql_karyawan = "delete from karyawan where id = $id";
    
    $query_karyawan = mysqli_query($conn->connect(), $sql_karyawan);

    if(!$query_karyawan) {
        $response = [
            'status' => 422,
            'messages' => 'Hapus karyawan Gagal'
        ];
    } else {
        $response = [
            'status' => 200,
            'messages' => 'Hapus karyawan Sukses'
        ];
    }

    echo json_encode($response);
}
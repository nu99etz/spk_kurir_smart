<?php

if (Route::is_ajax()) {

    $id = $p_act;

    $sqlCheckAlternatif = "select count(id_kurir) as total from data_alternatif where id_kurir = $id";
    $query = mysqli_query($conn->connect(), $sqlCheckAlternatif);
    $fk = mysqli_fetch_assoc($query);

    if ($fk['total'] > 0) {
        $response = [
            'status' => 422,
            'messages' => 'Data kurir gagal dihapus karena referensi ke data_alternatif'
        ];
    } else {
        $sql_karyawan = "delete from karyawan where id = $id";
        $query_karyawan = mysqli_query($conn->connect(), $sql_karyawan);

        $response = [
            'status' => 200,
            'messages' => 'Hapus kurir Sukses'
        ];
    }

    echo json_encode($response);
}

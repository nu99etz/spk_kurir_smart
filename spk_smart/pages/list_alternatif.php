<?php

if (Route::is_ajax()) {

    function ifExist($conn, $id)
    {
        $sql = "select count(id) as total from temp_list where id_karyawan = $id";
        $query = mysqli_query($conn->connect(), $sql);
        $total = mysqli_fetch_assoc($query);

        if ($total['total'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    $sql = "select id, nama_karyawan from karyawan where id in (select id_kurir from data_alternatif)";

    $query = mysqli_query($conn->connect(), $sql);

    $record = [];
    $no = 1;

    while ($kurir = mysqli_fetch_assoc($query)) {
        $row = [];
        if (ifExist($conn, $kurir['id'])) {
            $url = $config['base_url'] . $config['path'] . "/spk_smart/proses_pemilihan/delete/" . $kurir['id'];
            $row[] = '<input type = "checkbox" id = "pilih" act = "' . $url . '" checked>';
        } else {
            $url = $config['base_url'] . $config['path'] . "/spk_smart/proses_pemilihan/add/" . $kurir['id'];
            $row[] = '<input type = "checkbox" id = "pilih" act = "' . $url . '">';
        }
        $row[] = $no;
        $row[] = $kurir['id'];
        $row[] = $kurir['nama_karyawan'];
        $no++;
        $record[] = $row;
    }

    echo json_encode([
        'data' => $record,
    ]);
}

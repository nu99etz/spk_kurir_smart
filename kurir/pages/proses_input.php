<?php

if (Route::is_ajax()) {

    // validasi data
    $msg = array();
    foreach ($_POST as $key => $value) {
        if ($_POST[$key] == "") {
            $msg[$key] = $key . " Tidak Boleh Kosong";
        }
    }

    // check NIK jika tidak berupa angka muncul validasi
    if (!is_numeric($_POST['nik'])) {
        $msg['nik'] = "nik harus berupa angka";
    }

    // check panjang NIK jika lebih atau kurang 9 digit muncul validasi
    if (strlen($_POST['nik']) != 9) {
        $msg['nik'] = "nik harus berisi 9 digit";
    }

    if ($msg) {
        $error_validation = implode("<br/>", $msg);
        $response = array(
            'status' => 422,
            'messages' => $error_validation
        );
        echo json_encode($response);
    } else {
        if (empty($_POST["_method"])) {

            $nik = $_POST['nik'];
            $nama_karyawan = ucwords($_POST['nama_karyawan']);
            $tanggal_lahir = $_POST['tanggal_lahir'];
            $alamat = $_POST['alamat'];
            $sql = "insert into karyawan (nik, nama_karyawan, tanggal_lahir, alamat) values ('$nik', '$nama_karyawan', '$tanggal_lahir', '$alamat')";

            $query = mysqli_query($conn->connect(), $sql);

            if (!$query) {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Input data kurir'
                ];
            } else {
                $response = [
                    'status' => 200,
                    'messages' => 'Sukses Input data kurir'
                ];
            }
        } else {

            // proses update data
            if ($_POST['_method'] == "PUT") {
                $nik = $_POST['nik'];
                $nama_karyawan = ucwords($_POST['nama_karyawan']);
                $tanggal_lahir = $_POST['tanggal_lahir'];
                $alamat = $_POST['alamat'];
                $id = $_POST['id'];

                $sql = "update karyawan set nik = '$nik', nama_karyawan = '$nama_karyawan', tanggal_Lahir = '$tanggal_lahir', alamat = '$alamat' where id = $id and 1=1";

                $query = mysqli_query($conn->connect(), $sql);

                if (!$query) {
                    $response = [
                        'status' => 422,
                        'messages' => 'Gagal Update data kurir'
                    ];
                } else {
                    $response = [
                        'status' => 200,
                        'messages' => 'Sukses Update data kurir'
                    ];
                }
            } else {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Update data kurir'
                ];
            }
        }

        echo json_encode($response);
    }
}

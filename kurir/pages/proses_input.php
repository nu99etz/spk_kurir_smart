<?php

if (Route::is_ajax()) {

    // validasi data
    $msg = array();
    foreach ($_POST as $key => $value) {
        if (empty($_POST[$key])) {
            $msg[$key] = $key . " Tidak Boleh Kosong";
        }
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

            $nama_karyawan = ucwords($_POST['nama_karyawan']);
            $sql = "insert into karyawan (nama_karyawan) values ('$nama_karyawan')";

            $query = mysqli_query($conn->connect(), $sql);

            if (!$query) {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Input karyawan'
                ];
            } else {
                $response = [
                    'status' => 200,
                    'messages' => 'Sukses Input karyawan'
                ];
            }
        } else {
            
            // proses update data
            if ($_POST['_method'] == "PUT") {
                $nama_karyawan = ucwords($_POST['nama_karyawan']);
                $id = $_POST['id'];

                $sql = "update karyawan set nama_karyawan = '$nama_karyawan' where id = $id and 1=1";

                $query = mysqli_query($conn->connect(), $sql);

                if (!$query) {
                    $response = [
                        'status' => 422,
                        'messages' => 'Gagal Update karyawan'
                    ];
                } else {
                    $response = [
                        'status' => 200,
                        'messages' => 'Sukses Update karyawan'
                    ];
                }
            } else {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Update karyawan'
                ];
            }
        }

        echo json_encode($response);
    }
}

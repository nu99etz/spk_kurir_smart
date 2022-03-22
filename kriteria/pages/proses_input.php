<?php

if (Route::is_ajax()) {

    // validasi data
    $msg = array();
    foreach ($_POST as $key => $value) {
        if ($_POST[$key] == "") {
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

            $nama_kriteria = $_POST['nama_kriteria'];
            $status_kriteria = $_POST['status_kriteria'];

            $sql = "insert into kriteria (nama_kriteria, status_kriteria) values ('$nama_kriteria', '$status_kriteria')";

            $query = mysqli_query($conn->connect(), $sql);

            if (!$query) {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Input Kriteria'
                ];
            } else {
                $response = [
                    'status' => 200,
                    'messages' => 'Sukses Input Kriteria'
                ];
            }
        } else {
            
            // proses update data
            if ($_POST['_method'] == "PUT") {

                $nama_kriteria = $_POST['nama_kriteria'];
                $status_kriteria = $_POST['status_kriteria'];
                $id = $_POST['id'];

                $sql = "update kriteria set nama_kriteria = '$nama_kriteria', status_kriteria = '$status_kriteria' where id = $id and 1=1";

                $query = mysqli_query($conn->connect(), $sql);

                if (!$query) {
                    $response = [
                        'status' => 422,
                        'messages' => 'Gagal Update Kriteria'
                    ];
                } else {
                    $response = [
                        'status' => 200,
                        'messages' => 'Sukses Update Kriteria'
                    ];
                }
            } else {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Update Kriteria'
                ];
            }
        }

        echo json_encode($response);
    }
}

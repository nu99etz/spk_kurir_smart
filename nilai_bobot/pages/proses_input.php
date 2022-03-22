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

            $id_kriteria = $_POST['nama_kriteria'];
            $nilai_bobot_kriteria = $_POST['nilai_bobot_kriteria'];

            $sql = "insert into nilai_bobot (id_kriteria, nilai_bobot_kriteria) values ('$id_kriteria', '$nilai_bobot_kriteria')";

            $query = mysqli_query($conn->connect(), $sql);

            if (!$query) {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Input Nilai Bobot'
                ];
            } else {
                $response = [
                    'status' => 200,
                    'messages' => 'Sukses Input Nilai Bobot'
                ];
            }
        } else {

            // proses update data
            if ($_POST['_method'] == "PUT") {

                $id_kriteria = $_POST['nama_kriteria'];
                $nilai_bobot_kriteria = $_POST['nilai_bobot_kriteria'];
                $id = $_POST['id'];

                $sql = "update nilai_bobot set nilai_bobot_kriteria = '$nilai_bobot_kriteria' where id_kriteria = $id and 1=1";

                $query = mysqli_query($conn->connect(), $sql);

                if (!$query) {
                    $response = [
                        'status' => 422,
                        'messages' => 'Gagal Update Nilai Bobot'
                    ];
                } else {
                    $response = [
                        'status' => 200,
                        'messages' => 'Sukses Update Nilai Bobot'
                    ];
                }
            } else {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Update Nilai Bobot'
                ];
            }
        }

        echo json_encode($response);
    }
}

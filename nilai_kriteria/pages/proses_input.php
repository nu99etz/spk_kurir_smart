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

            $id_kriteria = $_POST['nama_kriteria'];
            $batas_nilai_parameter = ucwords($_POST['nilai_parameter']);
            $nilai_bobot_kriteria = $_POST['nilai_bobot'];

            $sql = "insert into nilai_kriteria (id_kriteria, nilai_parameter, nilai_bobot) values ('$id_kriteria', '$batas_nilai_parameter', '$nilai_bobot_kriteria')";

            $query = mysqli_query($conn->connect(), $sql);

            if (!$query) {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Input Nilai Kriteria'
                ];
            } else {
                $response = [
                    'status' => 200,
                    'messages' => 'Sukses Input Nilai Kriteria'
                ];
            }
        } else {

            // proses update data
            if ($_POST['_method'] == "PUT") {

                $id_kriteria = $_POST['nama_kriteria'];
                $batas_nilai_parameter = ucwords($_POST['nilai_parameter']);
                $nilai_bobot_kriteria = $_POST['nilai_bobot'];
                $id = $_POST['id'];

                $sql = "update nilai_kriteria set id_kriteria = '$id_kriteria', nilai_parameter = '$batas_nilai_parameter', nilai_bobot = '$nilai_bobot_kriteria' where id = $id and 1=1";

                $query = mysqli_query($conn->connect(), $sql);

                if (!$query) {
                    $response = [
                        'status' => 422,
                        'messages' => 'Gagal Update Nilai Kriteria'
                    ];
                } else {
                    $response = [
                        'status' => 200,
                        'messages' => 'Sukses Update Nilai Kriteria'
                    ];
                }
            } else {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Update Nilai Kriteria'
                ];
            }
        }

        echo json_encode($response);
    }
}

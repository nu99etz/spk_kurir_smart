<?php

if (Route::is_ajax()) {

    // Maintence::debug($_POST);

    function getNilai($conn, $id, $value)
    {
        $sql = "select*from nilai_kriteria where id_kriteria = $id";
        $query = mysqli_query($conn->connect(), $sql);

        while ($data = mysqli_fetch_assoc($query)) {
            $explodeBobotNilai = explode("-", $data['nilai_parameter']);
            if (count($explodeBobotNilai) > 1) {
                $angka1 = preg_replace("/[^a-zA-Z0-9]/", "", $explodeBobotNilai[0]);
                $angka2 = preg_replace("/[^a-zA-Z0-9]/", "", $explodeBobotNilai[1]);
                if (in_array($value, range($angka1, $angka2))) {
                    $nilaiBobot = $data['id'];
                }
            } else {
                if ($data['nilai_parameter'] == 0) {
                    $nilaiBobot = $data['id'];
                } else {
                    $angka1 = preg_replace("/[^a-zA-Z0-9]/", "", $data['nilai_parameter']);
                    if ($value > $angka1) {
                        $nilaiBobot = $data['id'];
                    }
                }
            }
        }

        if (empty($nilaiBobot)) {
            return 0;
        }

        return $nilaiBobot;
    }

    function getChar($conn, $id)
    {
        $sql = "select*from nilai_kriteria where id = $id";
        $query = mysqli_query($conn->connect(), $sql);
        $data = mysqli_fetch_assoc($query);
        return $data['nilai_parameter'];
    }

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

        $sqlKriteria = "select*from kriteria";
        $queryKriteria = mysqli_query($conn->connect(), $sqlKriteria);

        $kriteriaRow = [];
        while ($kriteria = mysqli_fetch_array($queryKriteria)) {
            $row = [];
            $row['id'] = $kriteria['id'];
            $row['is_angka'] = $kriteria['is_angka'];
            $row['satuan'] = $kriteria['satuan'];
            $row['posisi_satuan'] = $kriteria['posisi_satuan'];
            $kriteriaRow[] = $row;
        }

        if (empty($_POST["_method"])) {

            $nama_karyawan = $_POST['nama_karyawan'];

            for ($i = 0; $i < count($kriteriaRow); $i++) {
                $kriteria = $kriteriaRow[$i]['id'];
                if ($kriteriaRow[$i]['is_angka'] == 0) {
                    $nilai = getNilai($conn, $kriteria, $_POST['deskripsi'][$kriteria]);
                    $nama = $_POST['deskripsi'][$kriteria] . " " . $kriteriaRow[$i]['satuan'];
                } else {
                    $nilai = $_POST['deskripsi'][$kriteria];
                    $nama = getChar($conn, $nilai);
                }
                $sql = "insert into data_alternatif (id_kurir, nilai, id_penilaian) values ('$nama_karyawan', '$nama', '$nilai')";
                $query = mysqli_query($conn->connect(), $sql);
            }


            if (!$query) {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Input Alternatif'
                ];
            } else {
                $response = [
                    'status' => 200,
                    'messages' => 'Sukses Input Alternatif'
                ];
            }
        } else {

            // proses update data
            if ($_POST['_method'] == "PUT") {

                // Hapus Data Alternatif dulu
                $id = $_POST['id'];

                $sqlHapusAlternatif = "delete from data_alternatif where id_kurir = $id";
                $queryHapusAlternatif = mysqli_query($conn->connect(), $sqlHapusAlternatif);

                $nama_karyawan = $_POST['nama_karyawan'];

                for ($i = 0; $i < count($kriteriaRow); $i++) {
                    $kriteria = $kriteriaRow[$i]['id'];
                    if ($kriteriaRow[$i]['is_angka'] == 0) {
                        $nilai = getNilai($conn, $kriteria, $_POST['deskripsi'][$kriteria]);
                        $nama = $_POST['deskripsi'][$kriteria] . " " . $kriteriaRow[$i]['satuan'];
                    } else {
                        $nilai = $_POST['deskripsi'][$kriteria];
                        $nama = getChar($conn, $nilai);
                    }
                    $sql = "insert into data_alternatif (id_kurir, nilai, id_penilaian) values ('$nama_karyawan', '$nama', '$nilai')";
                    $query = mysqli_query($conn->connect(), $sql);
                }

                if (!$query) {
                    $response = [
                        'status' => 422,
                        'messages' => 'Gagal Update Alternatif'
                    ];
                } else {
                    $response = [
                        'status' => 200,
                        'messages' => 'Sukses Update Alternatif'
                    ];
                }
            } else {
                $response = [
                    'status' => 422,
                    'messages' => 'Gagal Update Alternatif'
                ];
            }
        }

        echo json_encode($response);
    }
}

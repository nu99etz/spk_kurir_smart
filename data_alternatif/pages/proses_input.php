<?php

if (Route::is_ajax()) {

    // Maintence::debug($_POST['nilai']);

    // fungsi untuk megambil nilai yang ada di kurung oke
    function ambilNilaiAlternatif($deskripsi)
    {
        $explodeKata = explode("(", $deskripsi);
        $nilaiAlternatif = 0;
        foreach($explodeKata as $value) {
            $filter_angka = preg_replace("/[^a-zA-Z0-9]/", "", $value);
            if(is_numeric($filter_angka)) {
                $nilaiAlternatif = $value;
            }
        }
        $hilangKata = explode(")", $nilaiAlternatif);
        $nilaiAlternatif = $hilangKata[0];
        return (int) $nilaiAlternatif;
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

        $sqlKriteria = "select id from kriteria";
        $queryKriteria = mysqli_query($conn->connect(), $sqlKriteria);

        $kriteriaRow = [];
        while ($kriteria = mysqli_fetch_array($queryKriteria)) {
            $kriteriaRow[] = $kriteria['id'];
        }

        if (empty($_POST["_method"])) {

            $nama_karyawan = $_POST['nama_karyawan'];

            for ($i = 0; $i < count($kriteriaRow); $i++) {
                $kriteria = $kriteriaRow[$i];
                $deskripsi = ucwords($_POST['deskripsi'][$kriteria]);
                $nilai_alternatif = ambilNilaiAlternatif($_POST['deskripsi'][$kriteria]);
                $sql = "insert into data_alternatif (id_karyawan, id_kriteria, deskripsi , nilai_alternatif) values ('$nama_karyawan', '$kriteria', '$deskripsi', '$nilai_alternatif')";
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

                $sqlHapusAlternatif = "delete from data_alternatif where id_karyawan = $id";
                $queryHapusAlternatif = mysqli_query($conn->connect(), $sqlHapusAlternatif);

                $nama_karyawan = $_POST['nama_karyawan'];

                for ($i = 0; $i < count($kriteriaRow); $i++) {
                    $kriteria = $kriteriaRow[$i];
                    $deskripsi = ucwords($_POST['deskripsi'][$kriteria]);
                    $nilai_alternatif = ambilNilaiAlternatif($_POST['deskripsi'][$kriteria]);
                    $sql = "insert into data_alternatif (id_karyawan, id_kriteria, deskripsi , nilai_alternatif) values ('$nama_karyawan', '$kriteria', '$deskripsi', '$nilai_alternatif')";
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

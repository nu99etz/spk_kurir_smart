<?php

require_once $config['vendor'] . "autoload.php";

use PhpOffice\PhpSpreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if (Route::is_ajax()) {

    if (empty($_FILES['file_excel']['name'])) {
        $response = array(
            'status' => 422,
            'messages' => "file tidak ada"
        );
        echo json_encode($response);
    } else {
        $arr_file = explode(".", $_FILES['file_excel']['name']);
        $extension = end($arr_file);

        if ($extension == 'csv') {
            $reader = new Csv();
        } else {
            $reader = new Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);

        $data = $spreadsheet->getActiveSheet()->toArray();

        $sql_truncate = "DELETE FROM kriteria";
        $query_truncate = mysqli_query($conn->connect(), $sql_truncate);

        for ($i = 0; $i < count($data); $i++) {
            $id = $data[$i][0];
            $nama_kriteria = $data[$i][1];
            $status_kriteria = $data[$i][2];
            $sql = "insert into kriteria (id, nama_kriteria, status_kriteria) values ('$id', '$nama_kriteria', '$status_kriteria')";
            $query = mysqli_query($conn->connect(), $sql);
        }

        $response = array(
            'status' => 200,
            'messages' => "data sukses diimport"
        );
        echo json_encode($response);
    }
}

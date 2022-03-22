<?php

function converter($conn, $id, $alternatif)
{
    $sql = "select*from nilai_bobot_kriteria where id_kriteria = $id";
    $query = mysqli_query($conn->connect(), $sql);
    $record = [];
    while ($nilai_bobot = mysqli_fetch_assoc($query)) {
        $row = [];
        $explode = explode('-', $nilai_bobot['batas_nilai_parameter']);
        $hilang_huruf = [];
        foreach ($explode as $value) {
            if (is_numeric($value)) {
                $hilang_huruf[] = $value;
            } else {
                $filter_angka = preg_replace("/[^a-zA-Z0-9]/", "", $value);
                $hilang_huruf[] = $filter_angka;
            }
        }
        $row['nilai_parameter'] = $hilang_huruf;
        $row['nilai_bobot'] = $nilai_bobot['nilai_bobot_kriteria'];
        $record[] = $row;
    }
    // Maintence::debug($record);

    // Check alternatif jika nilai nya tidak numeric maka hilangkan karakter
    if (is_numeric($alternatif)) {
        $alternatif = $alternatif;
    } else {
        $filter_angka = preg_replace("/[^a-zA-Z0-9]/", "", $alternatif);
        $alternatif = $filter_angka;
    }

    foreach ($record as $key => $value) {
        if (count($value['nilai_parameter']) > 1) {
            if (in_array($alternatif, range($value['nilai_parameter'][0], $value['nilai_parameter'][1]))) {
                $nilai_bobot = $value['nilai_bobot'];
            }
        } else {
            if ($alternatif > $value['nilai_parameter'][0]) {
                $nilai_bobot = $value['nilai_bobot'];
            }
        }
    }

    return $nilai_bobot;
}

$sql = "select*from kriteria_produk a join produk b on a.id_produk = b.id join kriteria c on a.id_kriteria = c.id";

$query = mysqli_query($conn->connect(), $sql);

$map = [];
$record = [];
$no = 1;

while ($alternatif = mysqli_fetch_array($query)) {
    $row = [];
    $row[$alternatif['id_kriteria']] = $alternatif['nilai_kriteria'];
    $map[$alternatif['id_produk']][$alternatif['nama_produk']][] = $row;
}

foreach ($map as $key => $value) {
    $row = [];
    $row[] = $no;
    foreach ($value as $key2 => $value2) {
        $row[] = $key2;
    }
    foreach ($value2 as $key3 => $value3) {
        foreach ($value3 as $key4 => $value4) {
            $row[] = converter($conn, $key4, $value4);
        }
    }
    $no++;
    $record[] = $row;
}

Maintence::debug($record);

echo json_encode([
    'data' => $record,
]);

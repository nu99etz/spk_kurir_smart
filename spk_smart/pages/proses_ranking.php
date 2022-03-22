<?php

if (Route::is_ajax()) {


    $sumNilaiBobot = array_sum($_POST['nilai']);

    if ($sumNilaiBobot != 100) {
        $response = array(
            'status' => 422,
            'messages' => "nilai bobot harus 100%"
        );
        echo json_encode($response);
    } else {

        $sqlKriteria = "select id from kriteria";
        $queryKriteria = mysqli_query($conn->connect(), $sqlKriteria);

        $kriteriaRow = [];
        while ($kriteria = mysqli_fetch_array($queryKriteria)) {
            $kriteriaRow[] = $kriteria['id'];
        }

        // MENGHITUNG Normalisasi BOBOT
        $normalisasiBobot = [];
        foreach ($_POST['nilai'] as $key => $value) {
            $normalisasiBobot[$key] = $value / $sumNilaiBobot;
        }

        function getNilai($data, $idKriteria)
        {
            if (isset($data[$idKriteria])) {
                return $data[$idKriteria];
            } else {
                return 0;
            }
        }

        $sql = "select a.*, b.nama_kriteria, c.nama_karyawan from data_alternatif a left join kriteria b on a.id_kriteria = b.id join karyawan c on a.id_karyawan = c.id";

        $query = mysqli_query($conn->connect(), $sql);

        $map = [];
        $record = [];
        $no = 1;

        while ($alternatif = mysqli_fetch_array($query)) {
            $row = [];
            $map[$alternatif['id_karyawan']][$alternatif['nama_karyawan']][$alternatif['id_kriteria']] = $alternatif['nilai_alternatif'];
        }

        foreach ($map as $key => $value) {
            $row = [];
            $row['id_karyawan'] = $key;
            foreach ($value as $key2 => $value2) {
                $row['nama'] = $key2;
            }
            foreach ($kriteriaRow as $value) {
                $row['nilai'][$value] = getNilai($value2, $value);
            }
            $record[] = $row;
        }

        // MAPPING UNTUK NILAI MIN MAX
        $row = [];
        foreach ($kriteriaRow as $kriteriaValue) {
            foreach ($record as $key => $valueRecord) {
                $row[$kriteriaValue][$valueRecord['id_karyawan']] = $valueRecord['nilai'][$kriteriaValue];
            }
        }
        $mapMinMax = $row;

        // MENCARI NILAI MIN DAN MAX
        $minMax = [];
        foreach ($mapMinMax as $key => $value) {
            $minMax[$key]['max'] = max($mapMinMax[$key]);
            $minMax[$key]['min'] = min($mapMinMax[$key]);
        }

        // Maintence::debug($minMax);

        // MENGHITUNG NILAI UTILITY
        $recordUtility = [];
        foreach ($record as $key => $value) {
            $row = [];
            $row['id_karyawan'] = $value['id_karyawan'];
            $row['nama'] = $value['nama'];
            $row['nilai'] = $value['nilai'];
            $row['nilai_utility'] = [];
            foreach ($kriteriaRow as $kriteriaValue) {
                $row['nilai_utility'][$kriteriaValue] = ($value['nilai'][$kriteriaValue] - $minMax[$kriteriaValue]['min']) / ($minMax[$kriteriaValue]['max'] - $minMax[$kriteriaValue]['min']);
            }
            $recordUtility[] = $row;
        }

        // MENGHITUNG NILAI AKHIR
        $recordNA = [];
        foreach ($recordUtility as $key => $value) {
            $row = [];
            $row['id_karyawan'] = $value['id_karyawan'];
            $row['nama'] = $value['nama'];
            $row['nilai'] = $value['nilai'];
            $row['nilai_utility'] = $value['nilai_utility'];
            $na = 0;
            foreach ($kriteriaRow as $kriteriaValue) {
                $na += ($normalisasiBobot[$kriteriaValue] * $value['nilai_utility'][$kriteriaValue]);
            }
            $row['nilai_akhir'] = $na;
            $recordNA[] = $row;
        }

        // PROSES SORT RANK
        array_multisort(array_column($recordNA, 'nilai_akhir'), SORT_DESC, $recordNA);

        $nilaiutility = "";
        $no = 1;
        foreach ($recordNA as $key => $value) {
            $nilaiutility .= "<tr>";
            $nilaiutility .= "<td>" . $no . "</td>";
            foreach ($kriteriaRow as $valueKriteria) {
                $nilaiutility .= "<td>" . $value['nilai_utility'][$valueKriteria] . "</td>";
            }
            $nilaiutility .= "</tr>";
            $no++;
        }

        $rank = "";
        $no = 1;
        foreach ($recordNA as $key => $value) {
            $rank .= "<tr>";
            $rank .= "<td>" . $no . "</td>";
            $rank .= "<td>" . $value['id_karyawan'] . "</td>";
            $rank .= "<td>" . $value['nama'] . "</td>";
            $rank .= "<td>" . $value['nilai_akhir'] . "</td>";
            $rank .= "</tr>";
            $no++;
        }

        echo json_encode([
            'status' => 200,
            'messages' => 'Perankingan Sukses Dilakukan',
            'rank' => $rank,
            'utility' => $nilaiutility
        ]);
    }
}

<?php

if (Route::is_ajax()) {

    function addCheckList($conn, $id)
    {
        $sql = "insert into temp_list (id_karyawan) values ('$id')";
        $query = mysqli_query($conn->connect(), $sql);
    }

    function deleteCheckList($conn, $id)
    {
        $sql = "delete from temp_list where id_karyawan = $id";
        $query = mysqli_query($conn->connect(), $sql);
    }

    if ($p_act == 'add') {

        if (!empty($id)) {
            addCheckList($conn, $id);
        } else {
            $sql = "select id from karyawan where id in (select id_karyawan from data_alternatif)";
            $query = mysqli_query($conn->connect(), $sql);

            $sqlDelete = "delete from temp_list";
            $queryDelete = mysqli_query($conn->connect(), $sqlDelete);

            while ($kurir = mysqli_fetch_assoc($query)) {
                addCheckList($conn, $kurir['id']);
            }
        }

        $response = [
            'status' => 200,
        ];
    } else if ($p_act == 'delete') {

        if (!empty($id)) {
            deleteCheckList($conn, $id);
        } else {
            $sqlDelete = "delete from temp_list";
            $queryDelete = mysqli_query($conn->connect(), $sqlDelete);
        }

        $response = [
            'status' => 200,
        ];
    }

    echo json_encode($response);
}

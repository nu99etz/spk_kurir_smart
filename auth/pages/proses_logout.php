<?php

if (Route::is_ajax()) {

    // hapus cek list kurir
    mysqli_query($conn->connect(), "delete from temp_list");

    session_destroy();
    ob_clean();

    echo json_encode([
        'status' => "success",
        'messages' => 'Logout Sukses'
    ]);

    session_start();
}

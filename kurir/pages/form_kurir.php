<?php

if (Route::is_ajax()) {

    if ($p_act == "edit" && !empty($id)) {

        // Ambil Data karyawan sesuai data yang mau diedit
        $sql = "select*from karyawan where id = $id and 1=1";
        $query = mysqli_query($conn->connect(), $sql);
        $karyawan = mysqli_fetch_assoc($query);

        $nama_karyawan = $karyawan['nama_karyawan'];
    } else {
        $nama_karyawan = "";
    }

?>

    <form id="karyawan" method="post" action="<?php echo $config['base_url'] . $config['path']; ?>/karyawan/proses_input" enctype="multipart/form-data">

        <?php if ($p_act == "edit" && !empty($id)) {
        ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php } ?>

        <div class="form-group">
            <label for="nama_karyawan">Nama Karyawan</label>
            <input type="text" class="form-control rounded-0" name="nama_karyawan" id="nama_karyawan" placeholder="Nama Karyawan" value="<?php echo $nama_karyawan; ?>">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-warning btn-flat"><i class="fas fa-redo"></i> Reset</button>
        </div>
    </form>

<?php
}
?>
<?php

if (Route::is_ajax()) {

    if ($p_act == "edit" && !empty($id)) {

        // Ambil Data karyawan sesuai data yang mau diedit
        $sql = "select*from karyawan where id = $id and 1=1";
        $query = mysqli_query($conn->connect(), $sql);
        $karyawan = mysqli_fetch_assoc($query);

        $nik = $karyawan['nik'];
        $nama_karyawan = $karyawan['nama_karyawan'];
        $tanggal_lahir = $karyawan['tanggal_lahir'];
        $alamat = $karyawan['alamat'];
    } else {
        $nik = "";
        $nama_karyawan = "";
        $tanggal_lahir = "";
        $alamat = "";
    }

?>

    <form id="kurir" method="post" action="<?php echo $config['base_url'] . $config['path']; ?>/kurir/proses_input" enctype="multipart/form-data">

        <?php if ($p_act == "edit" && !empty($id)) {
        ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php } ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nik">NIP</label>
                    <input type="text" class="form-control rounded-0" name="nik" id="nik" placeholder="NIP" maxlength="9" value="<?php echo $nik; ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_karyawan">Nama Kurir</label>
                    <input type="text" class="form-control rounded-0" name="nama_karyawan" id="nama_karyawan" placeholder="Nama Kurir" value="<?php echo $nama_karyawan; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control rounded-0" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control rounded-0" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-warning btn-flat"><i class="fas fa-redo"></i> Reset</button>
        </div>
    </form>

<?php
}
?>
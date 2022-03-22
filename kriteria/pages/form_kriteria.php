<?php

if (Route::is_ajax()) {

    if ($p_act == "edit" && !empty($id)) {

        // Ambil Data Produk sesuai data yang mau diedit
        $sql = "select*from kriteria where id = $id and 1=1";
        $query = mysqli_query($conn->connect(), $sql);
        $kriteria = mysqli_fetch_assoc($query);

        $nama_kriteria = $kriteria['nama_kriteria'];
        $status_kriteria = $kriteria['status_kriteria'];
    } else {
        $nama_kriteria = "";
        $status_kriteria = "";
    }

?>

    <form id="kriteria" method="post" action="<?php echo $config['base_url'] . $config['path']; ?>/kriteria/proses_input" enctype="multipart/form-data">

        <?php if ($p_act == "edit" && !empty($id)) {
        ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php } ?>

        <div class="form-group">
            <label for="nama_kriteria">Nama Kriteria</label>
            <input type="text" class="form-control rounded-0" name="nama_kriteria" id="nama_kriteria" placeholder="Nama Kriteria" value="<?php echo $nama_kriteria; ?>">
        </div>

        <div class="form-group">
            <label for="status_kriteria">Status Kriteria</label>
            <select class="custom-select rounded-0" id="status_kriteria" name="status_kriteria">
                <?php if ($status_kriteria == 0) {
                ?>
                    <option value="0" selected>Benefit</option>
                    <option value="1">Cost</option>
                <?php  } else if ($status_kriteria == 1) {
                ?>
                    <option value="0">Benefit</option>
                    <option value="1" selected>Cost</option>
                <?php   } else {
                ?>
                    <option value="0">Benefit</option>
                    <option value="1">Cost</option>
                <?php     } ?>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-warning btn-flat"><i class="fas fa-redo"></i> Reset</button>
        </div>
    </form>

<?php
}
?>
<?php

if (Route::is_ajax()) {

?>

    <form id="import" method="post" action="<?php echo $config['base_url'] . $config['path']; ?>/data_alternatif/proses_import" enctype="multipart/form-data">

        <div class="form-group">
            <label>Nama File</label>
            <input type="file" id="file_excel" class="form-control" name="file_excel" placeholder="Nama File">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-warning btn-flat"><i class="fas fa-redo"></i> Reset</button>
        </div>
    </form>

<?php
}
?>
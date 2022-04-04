<?php

if (Route::is_ajax()) {

    if ($p_act == "edit" && !empty($id)) {

        // Ambil Data nilai_bobot_kriteria sesuai data yang mau diedit
        $sql = "select*from nilai_kriteria where id = $id and 1=1";
        $query = mysqli_query($conn->connect(), $sql);
        $nilaiBobotKriteria = mysqli_fetch_assoc($query);

        $idKriteria = $nilaiBobotKriteria['id_kriteria'];
        $batas_nilai_parameter = $nilaiBobotKriteria['nilai_parameter'];
        $nilai_bobot_kriteria = $nilaiBobotKriteria['nilai_bobot'];
    } else {

        $idKriteria = "";
        $batas_nilai_parameter = "";
        $nilai_bobot_kriteria = "";
    }

    $sqlKriteria = "select id, nama_kriteria from kriteria";
    $queryKriteria = mysqli_query($conn->connect(), $sqlKriteria);

?>

    <form id="nilai_bobot" method="post" action="<?php echo $config['base_url'] . $config['path']; ?>/nilai_kriteria/proses_input" enctype="multipart/form-data">

        <?php if ($p_act == "edit" && !empty($id)) {
        ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php } ?>

        <div class="form-group">
            <label for="nama_kriteria">Nama Kriteria</label>
            <select class="custom-select rounded-0" style="width: 100%;" id="nama_kriteria" name="nama_kriteria">
                <option></option>
                <?php while ($kriteria = mysqli_fetch_assoc($queryKriteria)) {
                    if (!empty($idKriteria)) {
                        if ($kriteria['id'] == $idKriteria) {
                ?>
                            <option value="<?php echo $kriteria['id']; ?>" selected><?php echo $kriteria['nama_kriteria']; ?></option>
                        <?php  } else {
                        ?>
                            <option value="<?php echo $kriteria['id']; ?>"><?php echo $kriteria['nama_kriteria']; ?></option>
                        <?php    }
                    } else {
                        ?>
                        <option value="<?php echo $kriteria['id']; ?>"><?php echo $kriteria['nama_kriteria']; ?></option>
                    <?php    }
                    ?>
                <?php  } ?>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nilai_parameter">Nilai Parameter</label>
                    <input type="text" class="form-control rounded-0" name="nilai_parameter" id="nilai_parameter" placeholder="Nilai Parameter" value="<?php echo $batas_nilai_parameter; ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="nilai_bobot">Nilai Bobot</label>
                    <input type="number" class="form-control rounded-0" name="nilai_bobot" id="nilai_bobot" placeholder="Nilai Bobot" value="<?php echo $nilai_bobot_kriteria; ?>">
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

<script>
    $('#nama_kriteria').select2({
        placeholder: '--PILIH KRITERIA--',
    });
</script>
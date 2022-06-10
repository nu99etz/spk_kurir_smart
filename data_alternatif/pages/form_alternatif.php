<?php

defined('__VALID_ENTRANCE') or die('Dilarang Akses Halaman Ini :v');

Page::useLayout("app");

function getPenilaian($conn, $id_kriteria, $id = null)
{
    $sql = "select*from nilai_kriteria where id_kriteria = $id_kriteria order by nilai_bobot desc";
    $query = mysqli_query($conn->connect(), $sql);
    $select = "";
    while ($nilai = mysqli_fetch_assoc($query)) {
        if ($id == "") {
            $select .= '<option value = ' . $nilai['id'] . '>' . $nilai['nilai_parameter'] . ' (' . $nilai['nilai_bobot'] . ')</option>';
        } else {
            if ($id == $nilai['id']) {
                $select .= '<option value = ' . $nilai['id'] . ' selected>' . $nilai['nilai_parameter'] . ' (' . $nilai['nilai_bobot'] . ')</option>';
            } else {
                $select .= '<option value = ' . $nilai['id'] . '>' . $nilai['nilai_parameter'] . ' (' . $nilai['nilai_bobot'] . ')</option>';
            }
        }
    }
    return $select;
}

if ($p_act == "edit" && !empty($id)) {

    $sql_data_alternatif = "select a.*, b.*, c.* from data_alternatif a join nilai_kriteria b on a.id_penilaian = b.id join kriteria c on b.id_kriteria = c.id where id_kurir = $id";
    $query_data_alternatif = mysqli_query($conn->connect(), $sql_data_alternatif);

    $recordKriteriakaryawan = [];
    while ($kriteriakaryawan = mysqli_fetch_assoc($query_data_alternatif)) {
        $row = [];
        $row['id_penilaian'] = $kriteriakaryawan['id_penilaian'];
        if($kriteriakaryawan['is_angka'] == 1) {
            $row['nilai'] = $kriteriakaryawan['nilai_parameter'];
        } else if($kriteriakaryawan['is_angka'] == 0){
            $nilai = explode(" ", $kriteriakaryawan['nilai']);
            $row['nilai'] = $nilai[0];
        }
        $recordKriteriakaryawan[] = $row;
    }

    // Maintence::debug($recordKriteriakaryawan);

    $sql_karyawan = "select id, nama_karyawan from karyawan where id in (select id_kurir from data_alternatif where id_kurir = $id)";

    $act = "Ubah";
} else {

    $sql_karyawan = "select id, nama_karyawan from karyawan where id not in (select id_kurir from data_alternatif)";
    $recordKriteriakaryawan = '';

    $act = "Tambah";
}


$query_karyawan = mysqli_query($conn->connect(), $sql_karyawan);

$sql_kriteria = "select id, nama_kriteria, is_angka from kriteria where 1 = 1";
$query_kriteria = mysqli_query($conn->connect(), $sql_kriteria);

$record = [];
while ($kriteria = mysqli_fetch_assoc($query_kriteria)) {
    $row = [];
    $row['id'] = $kriteria['id'];
    $row['nama_kriteria'] = $kriteria['nama_kriteria'];
    $row['is_angka'] = $kriteria['is_angka'];
    $record[] = $row;
}

?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $act; ?> Form Penilaian Kurir</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo $config['base_url'] . $config['path']; ?>">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $act; ?> Form Penilaian Kurir</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container">
        <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0"><?php echo $act; ?> Form Penilaian Kurir</h5>
                    </div>
                    <div class="card-body">

                        <form id="alternatif" method="post" action="<?php echo $config['base_url'] . $config['path']; ?>/data_alternatif/proses_input" enctype="multipart/form-data">

                            <?php if ($p_act == "edit" && !empty($id)) {
                            ?>
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <?php } ?>

                            <div class="form-group">
                                <label for="nama_karyawan">Nama karyawan</label>
                                <select class="custom-select rounded-0" style="width: 100%;" id="nama_karyawan" name="nama_karyawan">
                                    <option></option>
                                    <?php while ($karyawan = mysqli_fetch_assoc($query_karyawan)) {
                                        if (!empty($id)) {
                                            if ($karyawan['id'] == $id) {
                                    ?>
                                                <option value="<?php echo $karyawan['id']; ?>" selected><?php echo $karyawan['nama_karyawan']; ?></option>
                                            <?php  } else {
                                            ?>
                                                <option value="<?php echo $karyawan['id']; ?>"><?php echo $karyawan['nama_karyawan']; ?></option>
                                            <?php    }
                                        } else {
                                            ?>
                                            <option value="<?php echo $karyawan['id']; ?>"><?php echo $karyawan['nama_karyawan']; ?></option>
                                        <?php    }
                                        ?>
                                    <?php  } ?>
                                </select>
                            </div>

                            <?php if (empty($recordKriteriakaryawan)) {
                                for ($i = 0; $i < count($record); $i++) {

                            ?>
                                    <?php if ($record[$i]['is_angka'] == 1) {
                                        $nilai_kriteria = getPenilaian($conn, $record[$i]['id']);
                                    ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="<?php echo $record[$i]['nama_kriteria']; ?>">Penilaian <?php echo $record[$i]['nama_kriteria']; ?></label>
                                                    <select class="custom-select rounded-0" style="width: 100%;" id="deskripsi[<?php echo $record[$i]['id']; ?>]; ?>" name="deskripsi[<?php echo $record[$i]['id']; ?>]; ?>">
                                                        <option value="" disabled selected hidden>-- PILIH PENILAIAN --</option>
                                                        <?php echo $nilai_kriteria; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?php   } else if ($record[$i]['is_angka'] == 0) {
                                    ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="<?php echo $record[$i]['nama_kriteria']; ?>">Penilaian <?php echo $record[$i]['nama_kriteria']; ?></label>
                                                    <input type="number" class="form-control rounded-0" id="deskripsi[<?php echo $record[$i]['id']; ?>]; ?>" name="deskripsi[<?php echo $record[$i]['id']; ?>]; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php    }
                                }
                            } else if (!empty($recordKriteriakaryawan)) {
                                for ($i = 0; $i < count($record); $i++) {

                                    ?>
                                    <?php if ($record[$i]['is_angka'] == 1) {
                                        $nilai_kriteria = getPenilaian($conn, $record[$i]['id'], $recordKriteriakaryawan[$i]['id_penilaian']);
                                    ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="<?php echo $record[$i]['nama_kriteria']; ?>">Penilaian <?php echo $record[$i]['nama_kriteria']; ?></label>
                                                    <select class="custom-select rounded-0" style="width: 100%;" id="deskripsi[<?php echo $record[$i]['id']; ?>]; ?>" name="deskripsi[<?php echo $record[$i]['id']; ?>]; ?>">
                                                        <option value="" disabled selected hidden>-- PILIH PENILAIAN --</option>
                                                        <?php echo $nilai_kriteria; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?php   } else if ($record[$i]['is_angka'] == 0) {
                                    ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="<?php echo $record[$i]['nama_kriteria']; ?>">Penilaian <?php echo $record[$i]['nama_kriteria']; ?></label>
                                                    <input type="number" class="form-control rounded-0" id="deskripsi[<?php echo $record[$i]['id']; ?>]; ?>" name="deskripsi[<?php echo $record[$i]['id']; ?>]; ?>" value="<?php echo $recordKriteriakaryawan[$i]['nilai']; ?>">
                                                </div>
                                            </div>
                                        </div>
                            <?php    }
                                }
                            } ?>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i> Simpan</button>
                                <button type="reset" class="btn btn-warning btn-flat"><i class="fas fa-redo"></i> Reset</button>
                            </div>
                        </form>

                        <script>
                            $('#nama_karyawan').select2({
                                placeholder: '--PILIH KARYAWAN--',
                            });

                            $(document).on('submit', 'form#alternatif', function() {
                                event.preventDefault();
                                let _data = new FormData($(this)[0]);
                                let _url = $(this).attr('action');


                                Swal.fire({
                                    title: 'Apakah Anda Yakin Data Yang Dinput Sudah Benar ?',
                                    showCancelButton: true,
                                    confirmButtonText: `Simpan`,
                                    confirmButtonColor: '#d33',
                                    icon: 'question'
                                }).then((result) => {
                                    if (result.value) {
                                        send((data, xhr = null) => {
                                            if (data.status == 422) {
                                                FailedNotif(data.messages);
                                            } else if (data.status == 200) {
                                                SuccessNotif(data.messages);
                                                setInterval(function() {
                                                    window.location.href = '<?php echo $config['base_url'] . $config['path']; ?>/data_alternatif';
                                                }, 1000);
                                            }
                                        }, _url, "json", "post", _data);
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php Page::buildLayout(); ?>
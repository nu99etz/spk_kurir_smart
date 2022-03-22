<?php

defined('__VALID_ENTRANCE') or die('Dilarang Akses Halaman Ini :v');

Page::useLayout("app");

if ($p_act == "edit" && !empty($id)) {

    $sql_data_alternatif = "select*from data_alternatif where id_karyawan = $id";
    $query_data_alternatif = mysqli_query($conn->connect(), $sql_data_alternatif);

    $recordKriteriakaryawan = [];
    while ($kriteriakaryawan = mysqli_fetch_assoc($query_data_alternatif)) {
        $row = [];
        $row['nilai_alternatif'] = $kriteriakaryawan['nilai_alternatif'];
        $row['deskripsi'] = $kriteriakaryawan['deskripsi'];
        $recordKriteriakaryawan[] = $row;
    }

    $sql_karyawan = "select id, nama_karyawan from karyawan where id in (select id_karyawan from data_alternatif where id_karyawan = $id)";

    $act = "Ubah";
} else {

    $sql_karyawan = "select id, nama_karyawan from karyawan where id not in (select id_karyawan from data_alternatif)";
    $recordKriteriakaryawan = '';

    $act = "Tambah";
}


$query_karyawan = mysqli_query($conn->connect(), $sql_karyawan);

$sql_kriteria = "select id, nama_kriteria from kriteria where 1 = 1";
$query_kriteria = mysqli_query($conn->connect(), $sql_kriteria);

$record = [];
while ($kriteria = mysqli_fetch_assoc($query_kriteria)) {
    $row = [];
    $row['id'] = $kriteria['id'];
    $row['nama_kriteria'] = $kriteria['nama_kriteria'];
    $record[] = $row;
}

?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $act; ?> Data Alternatif</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo $config['base_url'] . $config['path']; ?>">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $act; ?> Data Alternatif</li>
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
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fa fa-info"></i> <b>Perhatian!</b></h5>
                   Untuk pengisian deskripsi sesuaikan seperti contoh dibawah ini : <br/>
                   Contoh : <b>deskripsi (nilai)</b> </br>
                   Untuk nilai <b>1-3</b><br/>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0"><?php echo $act; ?> Data Alternatif</h5>
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="<?php echo $record[$i]['nama_kriteria']; ?>">Deskripsi <?php echo $record[$i]['nama_kriteria']; ?></label>
                                                <textarea class="form-control rounded-0" name="deskripsi[<?php echo $record[$i]['id']; ?>]; ?>" placeholder="Deskripsi <?php echo $record[$i]['nama_kriteria']; ?>"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php   }
                            } else if (!empty($recordKriteriakaryawan)) {
                                for ($i = 0; $i < count($record); $i++) {
                                ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="<?php echo $record[$i]['nama_kriteria']; ?>">Deskripsi <?php echo $record[$i]['nama_kriteria']; ?></label>
                                                <textarea class="form-control rounded-0" name="deskripsi[<?php echo $record[$i]['id']; ?>]; ?>" placeholder="Deskripsi <?php echo $record[$i]['nama_kriteria']; ?>"><?php echo $recordKriteriakaryawan[$i]['deskripsi']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                            <?php   }
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
<?php

defined('__VALID_ENTRANCE') or die('Dilarang Akses Halaman Ini :v');

Page::useLayout("app");

?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Nilai Bobot Kriteria</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo $config['base_url'] . $config['path']; ?>">Home</a></li>
                    <li class="breadcrumb-item active">Kriteria</li>
                    <li class="breadcrumb-item active">Nilai Bobot Kriteria</li>
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
                        <h5 class="card-title m-0">Nilai Bobot Kriteria</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-flat btn-primary float-right btn-add"><i class="fa fa-plus"></i> Tambah</button>
                        <br />
                        <br />
                        <table id="nilai_bobot" class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <th>No</th>
                                <th>Nama Kriteria</th>
                                <th>Nilai Parameter</th>
                                <th>Nilai Kriteria</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php
$modal_title = "Form Nilai Bobot";
$modal_id = "modal_nilai_bobot";
$modal_size = "lg";
include(Route::getViewPath("include/modal"));
?>

<script>
    let _table = $("#nilai_bobot");
    let _url = "<?php echo $config['base_url'] . $config['path']; ?>/nilai_kriteria/list_nilai_bobot";
    let _modal = $('#modal_nilai_bobot');

    DataTables(_url, _table);

    $(document).on('click', '.btn-add', function() {
        let _url = "<?php echo $config['base_url'] . $config['path']; ?>/nilai_kriteria/form_nilai_bobot";
        getViewModal(_url, _modal);
    });

    $(document).on('click', '.btn-import', function() {
        let _url = "<?php echo $config['base_url'] . $config['path']; ?>/nilai_kriteria/form_import";
        getViewModal(_url, _modal);
    });

    $(document).on('click', '.ubah', function() {
        let _id = $(this).attr('id');
        let _url = "<?php echo $config['base_url'] . $config['path']; ?>/nilai_kriteria/form_nilai_bobot/edit/" + _id;
        getViewModal(_url, _modal);
    });

    $(document).on('submit', 'form#nilai_bobot', function() {
        event.preventDefault();
        let _data = new FormData($(this)[0]);
        let _url = $(this).attr('action');

        send((data, xhr = null) => {
            if (data.status == 422) {
                FailedNotif(data.messages);
            } else if (data.status == 200) {
                SuccessNotif(data.messages);
                _modal.modal('hide');
                _table.DataTable().ajax.reload();
            }
        }, _url, "json", "post", _data);
    });

    $(document).on('submit', 'form#import', function() {
        event.preventDefault();
        let _data = new FormData($(this)[0]);
        let _url = $(this).attr('action');

        send((data, xhr = null) => {
            if (data.status == 422) {
                FailedNotif(data.messages);
            } else if (data.status == 200) {
                SuccessNotif(data.messages);
                _modal.modal('hide');
                _table.DataTable().ajax.reload();
            }
        }, _url, "json", "post", _data);
    });

    $(document).on('click', '.hapus', function() {
        let _id = $(this).attr('id');
        let _url = "<?php echo $config['base_url'] . $config['path']; ?>/nilai_kriteria/hapus_nilai_bobot/" + _id;
        Swal.fire({
            title: 'Apakah Anda Yakin Menghapus Data Ini ?',
            showCancelButton: true,
            confirmButtonText: `Hapus`,
            confirmButtonColor: '#d33',
            icon: 'question'
        }).then((result) => {
            if (result.value) {
                send((data, xhr = null) => {
                    if (data.status == 200) {
                        Swal.fire("Sukses", data.messages, 'success');
                        _table.DataTable().ajax.reload();
                    } else if (data.status == 422) {
                        Swal.fire("Gagal", data.messages, 'error');
                    }
                }, _url, "json", "get");
            }
        })
    });
</script>

<?php Page::buildLayout(); ?>
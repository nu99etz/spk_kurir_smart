<?php

defined('__VALID_ENTRANCE') or die('Dilarang Akses Halaman Ini :v');

Page::useLayout("app");

?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Data kurir</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo $config['base_url'] . $config['path']; ?>">Home</a></li>
                    <li class="breadcrumb-item active">Master Data</li>
                    <li class="breadcrumb-item active">Data kurir</li>
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
                        <h5 class="card-title m-0">Data kurir</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($config['import_mode']) {
                        ?>
                            <button type="button" class="btn btn-sm btn-flat btn-success float-right btn-import"><i class="fa fa-file-import"></i> Import</button>
                        <?php } ?>
                        <button type="button" class="btn btn-sm btn-flat btn-primary float-right btn-add"><i class="fa fa-plus"></i> Tambah</button>
                        <br />
                        <br />
                        <table id="kurir" class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama kurir</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
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
$modal_title = "Form kurir";
$modal_id = "modal_kurir";
$modal_size = "lg";
include(Route::getViewPath("include/modal"));
?>

<script>
    let _table = $("#kurir");
    let _url = "<?php echo $config['base_url'] . $config['path']; ?>/kurir/list_kurir";
    let _modal = $('#modal_kurir');

    DataTables(_url, _table);

    $(document).on('click', '.btn-add', function() {
        let _url = "<?php echo $config['base_url'] . $config['path']; ?>/kurir/form_kurir";
        getViewModal(_url, _modal);
    });

    $(document).on('click', '.btn-import', function() {
        let _url = "<?php echo $config['base_url'] . $config['path']; ?>/kurir/form_import";
        getViewModal(_url, _modal);
    });

    $(document).on('click', '.ubah', function() {
        let _id = $(this).attr('id');
        let _url = "<?php echo $config['base_url'] . $config['path']; ?>/kurir/form_kurir/edit/" + _id;
        getViewModal(_url, _modal);
    });

    $(document).on('submit', 'form#kurir', function() {
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
        let _url = "<?php echo $config['base_url'] . $config['path']; ?>/kurir/hapus_kurir/" + _id;
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
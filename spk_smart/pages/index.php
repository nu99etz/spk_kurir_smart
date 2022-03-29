<?php

defined('__VALID_ENTRANCE') or die('Dilarang Akses Halaman Ini :v');

Page::useLayout("app");

$sql = "select count(id) as total from karyawan where id in (select id_karyawan from data_alternatif)";
$query = mysqli_query($conn->connect(), $sql);
$total = mysqli_fetch_assoc($query);

function total($conn)
{
    $sql = "select count(id) as total from temp_list";
    $query = mysqli_query($conn->connect(), $sql);
    $total = mysqli_fetch_assoc($query);
    return $total['total'];
}
// Maintence::debug($_SESSION);

?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Perankingan SMART</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo $config['base_url'] . $config['path']; ?>">Home</a></li>
                    <li class="breadcrumb-item active">Perankingan SMART</li>
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
                    Silahkan untuk memilih minimal 3 kurir untuk melakukan perankingan.
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Perankingan SMART</h5>
                    </div>
                    <div class="card-body">
                        <?php if (total($conn) > 2) {
                        ?>
                            <button type="button" class="btn btn-sm btn-flat btn-primary float-right btn-rank"><i class="fa fa-trophy"></i> Ranking</button>
                            <br />
                            <br />
                        <?php   }  ?>

                        <!-- <form method="post" action="#" enctype="multipart/form-data"> -->
                        <table id="alternatif" class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <?php if ($total['total'] != total($conn)) {
                                ?>
                                    <th><input type="checkbox" id="pilih" act="<?php echo $config['base_url'] . $config['path']; ?>/spk_smart/proses_pemilihan/add/"></th>
                                <?php } else {
                                ?>
                                    <th><input type="checkbox" id="pilih" act="<?php echo $config['base_url'] . $config['path']; ?>/spk_smart/proses_pemilihan/delete/" checked></th>
                                <?php   } ?>
                                <th>No</th>
                                <th>Id Kurir</th>
                                <th>Nama Kurir</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<script>
    let _table = $("#alternatif");
    let _url = "<?php echo $config['base_url'] . $config['path']; ?>/spk_smart/list_alternatif";

    DataTables(_url, _table);

    $(document).on('click', '.btn-rank', function() {
        let _url = "<?php echo $config['base_url'] . $config['path']; ?>/spk_smart/hasil_ranking";
        window.location.href = _url;
    });

    $(document).on('click', '.ubah', function() {
        let _id = $(this).attr('id');
        let _url = "<?php echo $config['base_url'] . $config['path']; ?>/data_alternatif/form_alternatif/edit/" + _id;
        window.location.href = _url;
    });

    $(document).on('click', '#pilih', function() {
        let _url = $(this).attr('act');
        send((data, xhr = null) => {
            if (data.status == 200) {
                window.location.href = "<?php echo $config['base_url'] . $config['path']; ?>/spk_smart/";
            }
        }, _url, "json", "get");
    })

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
        let _url = "<?php echo $config['base_url'] . $config['path']; ?>/data_alternatif/hapus_alternatif/" + _id;
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
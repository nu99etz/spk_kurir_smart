<!DOCTYPE html>
<html>

<head>
    <?php include(Route::getViewPath('include/header')); ?>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><?php echo $config['tenants-name']; ?></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan Login Terlebih Dahulu</p>

                <form id="form-login" action="<?php echo $config['base_url'] . $config['path']; ?>/auth/proses_login/login" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block"><i class = "fa fa-sign-in-alt"></i> Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <script>
        $('#form-login').on('submit', function() {
            event.preventDefault();
            let _data = new FormData($(this)[0]);
            let _url = $('#form-login').attr('action');
            console.log(_url)
            send((data, xhr = null) => {
                if (data.status == 200) {
                    Swal.fire({
                        type: 'success',
                        title: "Login Sukses",
                        text: data.messages,
                        timer: 3000,
                        icon: 'success',
                        showCancelButton: false,
                        showConfirmButton: false
                    }).then(function() {
                        window.location.href = "<?php echo $config['base_url'] . $config['path']; ?>";
                    });
                } else if (data.status == 402) {
                    FailedNotif(data.messages);
                }
            }, _url, "json", "post", _data);
        });
    </script>

</body>

</html>
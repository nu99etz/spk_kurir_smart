<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <?php include(Route::getViewPath('include/header')); ?>
</head>

<body class="hold-transition layout-top-nav">

    <div class="wrapper">
        <?php include(Route::getViewPath('include/navbar')); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php echo array_pop($content); ?>
        </div>

        <?php include(Route::getViewPath('include/footer')); ?>

    </div>

</body>

</html>
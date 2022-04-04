<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <!-- <div class="float-right d-none d-sm-inline">
        Anything you want
    </div> -->
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date('Y'); ?> <?php echo $config['nama_mhs_npm']; ?> </strong> All rights reserved.
</footer>

<?php if ($config['debug-memory']) {
?>
    <div class="row">
        <?php
        $memDebug = Page::memoryDebug();
        echo 'The script is now using: <strong>' . round($memDebug['usageMemory'] / 1024) . 'KB</strong> of memory.<br>';
        echo 'Peak usage: <strong>' . round($memDebug['peakMemory'] / 1024) . 'KB</strong> of memory.<br><br>';
        ?>
    </div>
<?php } ?>
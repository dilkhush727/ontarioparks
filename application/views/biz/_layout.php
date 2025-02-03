<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex">

<?php $this->load->view('biz/components/head'); ?>

<body>
    <?php $this->load->view('biz/components/header'); ?>
    <main class="container">
        <?php $this->load->view($content); ?>
    </main>
    <?php $this->load->view('biz/components/footer'); ?>
</body>

</html>
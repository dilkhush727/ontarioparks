<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex">

<?php $this->load->view('biz/components/head'); ?>

<body>
    <main>
        <?php $this->load->view($content); ?>
    </main>
    <?php $this->load->view('biz/components/footer'); ?>
</body>

</html>
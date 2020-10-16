<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>
    <!-- get country -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/lib/country/build/css/countrySelect.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/lib/country/build/css/demo.css">
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/my.css">

    <link rel="stylesheet" href="<?= base_url('assets/lib/tel/build/css') ?>/intlTelInput.css">
    <link rel="stylesheet" href="<?= base_url('assets/lib/tel/build/css') ?>/demo.css">
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Kanit:wght@600&display=swap");

    .country-select {
        position: relative;
        display: block;
    }

    .mytitle {
        font-family: "Kanit", sans-serif;
        color: #f69168;
        font-size: 25px;
    }

    .mysubtitle {
        font-family: "Kanit", sans-serif;
        color: #f69168;
        font-size: 15px;
    }

    .bg-main {
        background: #F69168;
        /* fallback for old browsers */
        /* background: -webkit-linear-gradient(to right, #F37335, #FDC830); */
        /* Chrome 10-25, Safari 5.1-6 */
        /* background: linear-gradient(to right, #F37335, #FDC830); */
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .bgc {
        border: none;
        padding: 25px;
        background: url(<?= base_url('assets/img/image/img.svg') ?>);
        background-repeat: no-repeat;
        background-size: 200px;
        background-position: right;
    }

    .bgc2 {
        border: none;
        padding: 25px;
        background: url(<?= base_url('assets/img/image/image.svg') ?>);
        background-repeat: no-repeat;
        background-size: 200px;
        background-position: right;
    }

    .logo-size {
        width: 135px;
    }

    #tel {
        display: block;
    }

    .iti--allow-dropdown {
        display: block;
    }
</style>

<body class="bg-main">
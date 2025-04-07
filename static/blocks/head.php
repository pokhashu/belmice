<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="/vendor/jquery/jquery-3.7.1.min.js"></script>
    <script src="/vendor/jquery/jquery.md5.min.js"></script>
    <script src="/vendor/jquery/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lvovich/dist/lvovich.min.js"></script>
<!--    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
    <script src="/vendor/bootstrap/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/vendor/swiper/swiper-bundle.min.css">
    <link href="/vendor/bootstrap/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/vendor/font-awesome-4.7.0/css/font-awesome.min.css">
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="icon" href="/public/images/favicon.ico" type="image/x-icon">
    <title><?= $page_data['title'] ?></title>
    <meta name="description" content="<?= $page_data['description'] ?>">
    <meta name="keywords" content="<?= $page_data['keywords'] ?>">

    <meta property="og:title" content="<?= $page_data['og']['title'] ?>" />
    <meta property="og:description" content="<?= $page_data['og']['description'] ?>" />
    <meta property="og:url" content="https://micebel.by/" />
</head>
<body>
<?php //echo '<h2>'.$_SERVER['DOCUMENT_ROOT'].'</h2>'; ?>
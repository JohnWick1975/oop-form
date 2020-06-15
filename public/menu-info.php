<?php

require '../bootloader.php';

if (!is_logged_in()){
    header('Location: login.php');
}

$rows = App::$db->getRowsWhere('menu', []);

$table = [
    'attr' => [
        'class' => 'users-table'
    ],
    'headings' => [
        'Dish Name',
        'Price'
    ],
    'rows' => $rows
];
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <?php require 'header.php'; ?>
        <main>
            <?php require '../core/templates/table.tpl.php' ?>
        </main>
    </body>
</html>

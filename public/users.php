<?php

require '../bootloader.php';

if (!is_logged_in()){
    header('Location: login.php');
}

$rows = App::$db->getRowsWhere('users', []);


$table = [
    'attr' => [
        'class' => 'users-table'
    ],
    'headings' => [
        'Name',
        'Email',
        'Password',
        'age',
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
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Document</title>
    </head>
    <body>
        <?php require 'header.php'; ?>
        <main>
            <?php require '../core/templates/table.tpl.php'; ?>
        </main>
    </body>
</html>

<?php

require_once '../bootloader.php';

date_default_timezone_set('Europe/Vilnius');


if (!is_logged_in()) {
    header('Location: login.php');
}


function convert_time(&$rows)
{
    foreach ($rows as &$row) {
        $row['timestamp'] = date('Y-m-d H:i:s', $row['timestamp']);
    }
}

function filter_data_table()
{

    $rows = App::$db->getRowsWhere('session', ['user' => $_SESSION['name']]);
    convert_time($rows);
    return $rows;
}

$user_name = $_SESSION['name'];

$table = [
    'attr' => [
        'class' => 'login-table'
    ],
    'headings' => [
        'user',
        'timestamp',
        'session_id'
    ],
    'rows' => filter_data_table()
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
        <h1 class="username"><?php print $user_name; ?></h1>
        <main>
            <?php require '../core/templates/table.tpl.php'; ?>
        </main>
    </body>
</html>

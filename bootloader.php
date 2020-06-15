<?php

define('ROOT', __DIR__);
define('DB_FILE', ROOT . '/app/data/data.json');

require_once ROOT . '/core/functions/html.php';
require_once ROOT . '/core/functions/form.php';
require_once ROOT . '/core/functions/validator.php';
require_once ROOT . '/core/functions/file.php';
require_once ROOT . '/core/functions/auth.php';
require_once ROOT . '/app/classes/App.php';
require_once ROOT . '/core/classes/FileDB.php';

$app = new App(DB_FILE);

session_start();
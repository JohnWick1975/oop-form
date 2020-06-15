<?php

session_start();

if (!isset($_SESSION['view'])){
    $_SESSION['view'] = 0;
}

$_SESSION['view']++;

$user_session_id = session_id();

$message_id = "Jums buvo paskirtas  $user_session_id ";
$message_count = "Jus apsilankete  {$_SESSION['view']} kartu";

?>
<html lang="en">
    <head>
        <title>Test</title>
    </head>
    <body>
        <main>
            <h1><?php print $message_id; ?></h1>
            <h2><?php print $message_count; ?></h2>
        </main>
    </body>
</html>
<?php
/**
 * Check if user is logged in.
 *
 * @return bool
 */
function is_logged_in(): bool
{
        return App::$db->getRowWhere('users', [
            'name' => $_SESSION['name'] ?? null,
            'password' => $_SESSION['password'] ?? null
        ]) ? true : false;
}

/**
 * Logout with server/client - side cookies destroy and
 * redirect if $redirect = true.
 *
 * @param bool $redirect
 */
function logout($redirect = false)
{
    $_SESSION = [];

    setcookie(session_name(), null, time() - 3600);

    session_destroy();

    if ($redirect) {
        header('Location: login.php');
    }
}

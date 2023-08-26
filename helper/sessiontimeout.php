<?php
// start the session
session_start();

// set the session timeout to 1 hour
$session_timeout = 60 * 60; // 1 hour

// check if the session has expired
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
    // session expired, destroy the session and redirect to the login page
    session_unset();
    session_destroy();
    header('Location: login');
    exit;
}

// update the last activity time
$_SESSION['last_activity'] = time();


?>

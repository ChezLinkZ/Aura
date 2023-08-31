<?php
session_start();

if (!isset($_SESSION['online_users'])) {
    $_SESSION['online_users'] = array();
}

// Add the user to the online users list if not already added
$username = $_SESSION['username'];
if (!in_array($username, $_SESSION['online_users'])) {
    $_SESSION['online_users'][] = $username;
}
?>

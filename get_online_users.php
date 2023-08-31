<?php
session_start();

if (!isset($_SESSION['online_users'])) {
    $_SESSION['online_users'] = array();
}

$onlineUsers = $_SESSION['online_users'];

echo json_encode(array("onlineUsers" => $onlineUsers));
?>

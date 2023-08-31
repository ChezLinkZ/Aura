<?php
session_start();

if (isset($_SESSION['user_status']) && $_SESSION['user_status'] === 'online') {
    echo 'online';
} else {
    echo 'offline';
}
?>

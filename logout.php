<?php
session_start();
$_SESSION['user_id'] = '';
header("Location: ".  $_SERVER['HTTP_REFERER']);
die();
?>

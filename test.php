<?php

ini_set('log_errors', 'on');
ini_set('error_log', 'php.log');

require('function.php');

session_start();

$_SESSION['history'][] = '一行目';
$_SESSION['history'][] = '二行目';

d(p($_SESSION['history']));

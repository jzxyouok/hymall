<?php
header('Content-type:text/html;charset=utf-8');
define('APP_PATH', './App/');
define('APP_DEBUG', true);
$_GET['m']='Admin';
$_GET['c']='Index';
$_GET['a']='index';
require './ThinkPHP/ThinkPHP.php';

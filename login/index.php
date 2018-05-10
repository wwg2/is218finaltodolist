<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

include '../models/Database.php';
include '../models/User.php';

session_start();

$action = filter_input(INPUT_POST, 'action');

switch($action) {
	
    case 'login':
        do_login();
        break;
    default:
        include '../views/login.php';
        break;
}
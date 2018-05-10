<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

session_start();

include '../models/Database.php';
include '../models/User.php';
$action = filter_input(INPUT_POST, 'action');

switch($action) {
	
    case 'register':
        do_register();
        break;
    default:
        include '../views/register.php';
        break;
}
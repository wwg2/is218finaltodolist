<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
date_default_timezone_set('America/New_York');
session_start();

if(!isset($_SESSION['email'])) {
    header('Location: ../login');
}

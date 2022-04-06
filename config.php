<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$ip = 'localhost';
$username = 'root';
$password = '';

$database = mysqli_connect('localhost', 'root', '', 'parduotuves_sandelis');


if (!$database) {
    die("Connection failed: " . mysqli_connect_error());
}


$page = $_REQUEST['page'] ?? null;

function isLoged(): bool
{
    if (isset($_SESSION['pastas'])) {
        return true;
    } else {
        return false;
    }
}

?>

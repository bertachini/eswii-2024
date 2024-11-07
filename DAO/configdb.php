<?php
$host     = "localhost";
$database      = "bd_prospects";
$user       = "root";
$password   = "";

function conectarDB() {
    try {
        $conn = new \MySQLi($host, $user, $password, $database);
        return $conn;
    } catch (mysqli_sql_exception $e) {
        throw new \Exception("Database connection failed, how miserable... $e);
?>

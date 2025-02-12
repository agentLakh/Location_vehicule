<?php
$host = 'localhost';
$dbname = 'location_voiture';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,
    array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        )
    );
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<?php
// config/database.php
function getConnection(): PDO {
    $host   = 'localhost';
    $dbname = 'librarymidterm_db'; // Matches your phpMyAdmin image
    $user   = 'root';
    $pass   = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}
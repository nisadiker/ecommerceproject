<?php
session_start(); //-- Session başlatıldı --

//-- PHP hatalarını göstermek için --
ini_set('display_errors', '1'); // 1 açık, 0 kapalı
ini_set('display_startup_errors', '1'); // 1 açık, 0 kapalı
error_reporting(E_ALL);

//-- Veritabanı bağlantı bilgileri --
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

//-- Veritabanı sorgusu işlevi --
function berkhoca_query_parser($sql='') {
    global $servername, $username, $password, $dbname;

    // Bağlantıyı oluştur
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (empty($sql)) {
        return 'sql ifadesi boş';
    }

    $query_result = $conn->query($sql);
    $array_result = [];
    while ($row = $query_result->fetch_assoc()) {
        $array_result[] = $row;
    }
    
    $conn->close(); // Bağlantıyı kapat
    return $array_result;
}
?>

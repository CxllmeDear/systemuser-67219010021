<?php
$servername = "localhost";
$username = "root"; // หรือ username ของคุณ
$password = "";     // หรือ password ของคุณ
$dbname = "systemuser";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// ตั้งค่าภาษาไทย
$conn->set_charset("utf8");
?>
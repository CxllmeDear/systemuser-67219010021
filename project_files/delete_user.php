<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // คำสั่ง SQL สำหรับลบ
    $sql = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // ลบเสร็จให้กลับไปหน้า account.php
        header("Location: account.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // ถ้าไม่มี ID ส่งมา ให้กลับไปหน้าแรก
    header("Location: account.php");
}
?>
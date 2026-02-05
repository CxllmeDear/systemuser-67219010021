<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    // เข้ารหัสรหัสผ่านเพื่อความปลอดภัย
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        // ถ้าสำเร็จ ให้เด้งกลับไปหน้า account.php
        echo "<script>alert('เพิ่มข้อมูลสำเร็จ'); window.location='account.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มผู้ใช้ใหม่</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>เพิ่มผู้ใช้ใหม่</h2>
    <form method="post" action="add_user.php" class="card p-4 shadow-sm mt-3">
        <div class="mb-3">
            <label>ชื่อ-นามสกุล:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>อีเมล:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>รหัสผ่าน:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>สิทธิ์การใช้งาน:</label>
            <select name="role" class="form-select">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
        <a href="account.php" class="btn btn-secondary">ยกเลิก</a>
    </form>
</body>
</html>
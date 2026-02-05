<?php
include 'db.php';

$id = $_GET['id']; // รับค่า ID ที่ส่งมาจากลิงก์

// ดึงข้อมูลเดิมมาแสดง
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // อัปเดตข้อมูล
    $sql_update = "UPDATE users SET name='$name', email='$email', role='$role' WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('แก้ไขข้อมูลสำเร็จ'); window.location='account.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลผู้ใช้</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>แก้ไขข้อมูลผู้ใช้</h2>
    <form method="post" class="card p-4 shadow-sm mt-3">
        <div class="mb-3">
            <label>ชื่อ-นามสกุล:</label>
            <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label>อีเมล:</label>
            <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label>สิทธิ์การใช้งาน:</label>
            <select name="role" class="form-select">
                <option value="user" <?php if($row['role']=='user') echo 'selected'; ?>>User</option>
                <option value="admin" <?php if($row['role']=='admin') echo 'selected'; ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">อัปเดตข้อมูล</button>
        <a href="account.php" class="btn btn-secondary">ยกเลิก</a>
    </form>
</body>
</html>
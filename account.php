<?php
include 'db.php'; // เรียกไฟล์เชื่อมต่อฐานข้อมูล

// ดึงข้อมูลผู้ใช้ทั้งหมดจากตาราง users
$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายชื่อผู้ใช้ (Account)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>รายชื่อผู้ใช้ในระบบ</h1>
        <a href="add_user.php" class="btn btn-success">+ เพิ่มผู้ใช้ใหม่</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>ชื่อ-นามสกุล</th>
                <th>อีเมล</th>
                <th>สถานะ (Role)</th>
                <th>วันที่สร้าง</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <span class="badge bg-<?php echo ($row['role'] == 'admin') ? 'danger' : 'primary'; ?>">
                            <?php echo $row['role']; ?>
                        </span>
                    </td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบข้อมูลนี้?');">ลบ</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">ไม่พบข้อมูลผู้ใช้</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
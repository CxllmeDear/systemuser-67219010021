<?php
session_start();
include 'db.php';

// 1. ตรวจสอบว่าล็อกอินหรือยัง
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// 2. ตรวจสอบว่ามี ID ส่งมาไหม
if (!isset($_GET['id'])) {
    header("Location: account.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// ถ้าหา ID ไม่เจอ
if (!$row) {
    echo "<script>alert('ไม่พบข้อมูลผู้ใช้'); window.location='account.php';</script>";
    exit();
}

// 3. บันทึกข้อมูลเมื่อกดปุ่ม Update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // อัปเดตข้อมูล (เฉพาะชื่อ, อีเมล, สถานะ)
    $sql_update = "UPDATE users SET name='$name', email='$email', role='$role' WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('แก้ไขข้อมูลสำเร็จ'); window.location='account.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลผู้ใช้</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="style.css" rel="stylesheet">
</head>
<body class="container mt-5">
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom p-4 border-warning border-top border-4"> <div class="mb-4 text-center">
                    <h4 class="fw-bold text-warning"><i class="bi bi-pencil-square"></i> แก้ไขข้อมูลผู้ใช้</h4>
                    <p class="text-muted small">ID: <?php echo $row['id']; ?></p>
                </div>

                <form method="post">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="fName" 
                               placeholder="ชื่อ" value="<?php echo $row['name']; ?>" required>
                        <label for="fName">ชื่อ-นามสกุล</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="fEmail" 
                               placeholder="อีเมล" value="<?php echo $row['email']; ?>" required>
                        <label for="fEmail">อีเมล</label>
                    </div>

                    <div class="form-floating mb-4">
                        <select name="role" class="form-select" id="fRole">
                            <option value="user" <?php if($row['role']=='user') echo 'selected'; ?>>User (ผู้ใช้ทั่วไป)</option>
                            <option value="admin" <?php if($row['role']=='admin') echo 'selected'; ?>>Admin (ผู้ดูแลระบบ)</option>
                        </select>
                        <label for="fRole">สิทธิ์การใช้งาน</label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning text-white btn-custom flex-grow-1 shadow-sm">
                            <i class="bi bi-save"></i> บันทึกการแก้ไข
                        </button>
                        <a href="account.php" class="btn btn-light btn-custom text-muted">ยกเลิก</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>
</html>
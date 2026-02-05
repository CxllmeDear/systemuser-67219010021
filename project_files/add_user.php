<?php
session_start();
include 'db.php';

// เช็คสิทธิ์ (ถ้าไม่ใช่ Admin ห้ามเพิ่ม? หรือถ้าล็อกอินแล้วเพิ่มได้เลย)
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // 1. เช็คว่าอีเมลซ้ำไหม?
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result_check = $conn->query($check_email);

    if ($result_check->num_rows > 0) {
        // ถ้าเจออีเมลซ้ำ ให้แจ้งเตือน
        $error = "อีเมลนี้มีอยู่ในระบบแล้ว กรุณาใช้อีเมลอื่น";
    } else {
        // 2. ถ้าไม่ซ้ำ ค่อยบันทึก
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('เพิ่มข้อมูลสำเร็จ'); window.location='account.php';</script>";
            exit();
        } else {
            $error = "เกิดข้อผิดพลาด: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มผู้ใช้ใหม่</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom p-4">
                <h4 class="mb-4 fw-bold text-success">เพิ่มผู้ใช้ใหม่</h4>
                
                <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

                <form method="post">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="fName" 
                               placeholder="ชื่อ" value="<?php echo isset($name) ? $name : ''; ?>" required>
                        <label for="fName">ชื่อ-นามสกุล</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="fEmail" 
                               placeholder="อีเมล" value="<?php echo isset($email) ? $email : ''; ?>" required>
                        <label for="fEmail">อีเมล</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="fPass" placeholder="รหัสผ่าน" required>
                        <label for="fPass">รหัสผ่าน</label>
                    </div>
                    <div class="form-floating mb-4">
                        <select name="role" class="form-select" id="fRole">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        <label for="fRole">สิทธิ์การใช้งาน</label>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success btn-custom flex-grow-1">บันทึกข้อมูล</button>
                        <a href="account.php" class="btn btn-light btn-custom text-muted">ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
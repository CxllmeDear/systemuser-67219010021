<?php
session_start();
include 'db.php';
// ... (Logic PHP ส่วน Login เหมือนเดิมครับ) ...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... ใส่โค้ด Logic เดิมตรงนี้ ...
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_role'] = $row['role'];
            header("Location: account.php");
            exit();
        } else { $error = "รหัสผ่านไม่ถูกต้อง"; }
    } else { $error = "ไม่พบอีเมลนี้"; }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ SystemUser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet"> </head>
<body class="d-flex align-items-center justify-content-center vh-100">
    
    <div class="card card-custom p-5" style="width: 400px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">Admin System</h2>
            <p class="text-muted">กรุณาเข้าสู่ระบบเพื่อจัดการข้อมูล</p>
        </div>

        <?php if(isset($error)) echo "<div class='alert alert-danger text-center'>$error</div>"; ?>

        <form method="post">
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">อีเมล</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">รหัสผ่าน</label>
            </div>
            <button type="submit" class="btn btn-primary w-100 btn-custom py-2">เข้าสู่ระบบ</button>
        </form>
    </div>

</body>
</html>
<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="style.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-shield-lock-fill"></i> SystemUser</a>
            <div class="d-flex align-items-center text-white">
                <span class="me-3"><i class="bi bi-person-circle"></i> <?php echo $_SESSION['user_name']; ?></span>
                <a href="logout.php" class="btn btn-light btn-sm btn-custom text-primary">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold m-0"><i class="bi bi-people-fill text-primary"></i> รายชื่อผู้ใช้งาน</h4>
                <a href="add_user.php" class="btn btn-success btn-custom shadow-sm">
                    <i class="bi bi-plus-lg"></i> เพิ่มผู้ใช้ใหม่
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-custom align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>อีเมล</th>
                            <th>สถานะ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="text-muted">#<?php echo $row['id']; ?></td>
                                <td class="fw-bold"><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td>
                                    <?php 
                                        $badgeClass = ($row['role'] == 'admin') ? 'bg-danger' : 'bg-success';
                                        $icon = ($row['role'] == 'admin') ? 'bi-key-fill' : 'bi-person-fill';
                                    ?>
                                    <span class="status-badge text-white <?php echo $badgeClass; ?>">
                                        <i class="bi <?php echo $icon; ?>"></i> <?php echo ucfirst($row['role']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-warning btn-sm rounded-circle" title="แก้ไข">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="delete_user.php?id=<?php echo $row['id']; ?>" 
                                       class="btn btn-outline-danger btn-sm rounded-circle ms-1"
                                       onclick="return confirm('ยืนยันการลบข้อมูล?');" title="ลบ">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center py-4 text-muted">ไม่พบข้อมูล</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
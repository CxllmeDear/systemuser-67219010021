<!DOCTYPE html>
<html lang="th">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom p-4">
                <h4 class="mb-4 fw-bold text-success">เพิ่มผู้ใช้ใหม่</h4>
                <form method="post">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="fName" placeholder="ชื่อ" required>
                        <label for="fName">ชื่อ-นามสกุล</label>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-success btn-custom flex-grow-1">บันทึกข้อมูล</button>
                        <a href="account.php" class="btn btn-light btn-custom text-muted">ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
session_start();
require 'db.php';

$message = '';

if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($name) && !empty($email) && !empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hashed_password]);
            $message = "<div class='alert alert-success'>تم إنشاء الحساب بنجاح! يمكنك تسجيل الدخول الآن.</div>";
        } catch (PDOException $e) {
            $message = "<div class='alert alert-danger'>هذا البريد الإلكتروني مسجل بالفعل!</div>";
        }
    } else {
        http_response_code(400); 
        $message = "<div class='alert alert-warning'>يرجى تعبئة جميع الحقول.</div>";
    }
}


if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // إنشاء الجلسة لحماية المسارات
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: dashboard.php");
        exit();
    } else {
        http_response_code(401); // كود خطأ لعدم المصادقة
        $message = "<div class='alert alert-danger'>البريد الإلكتروني أو كلمة المرور غير صحيحة.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>نظام المصادقة الآمن</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style> body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; } </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h2 class="text-center mb-4 text-primary">نظام المصادقة (Task 1)</h2>
            <?= $message ?>
            
            <!-- نموذج تسجيل الدخول -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title">تسجيل الدخول</h4>
                    <form method="POST">
                        <div class="mb-3">
                            <label>البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>كلمة المرور</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100">دخول</button>
                    </form>
                </div>
            </div>

            <!-- نموذج إنشاء حساب -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">إنشاء حساب جديد</h4>
                    <form method="POST">
                        <div class="mb-3">
                            <label>الاسم الكامل</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>كلمة المرور</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" name="register" class="btn btn-success w-100">تسجيل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
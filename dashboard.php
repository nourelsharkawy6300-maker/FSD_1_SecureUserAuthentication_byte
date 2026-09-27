<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// تسجيل الخروج
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5 text-center">
    <div class="card shadow p-5">
        <h1 class="text-success">مرحباً بك يا <?= htmlspecialchars($_SESSION['user_name']) ?>!</h1>
        <p class="lead">أنت الآن داخل المسار المحمي (Protected Route). لا يمكن الوصول لهذه الصفحة بدون مصادقة.</p>
        <div class="mt-4">
            <a href="?logout=true" class="btn btn-danger btn-lg">تسجيل الخروج</a>
        </div>
    </div>
</div>
</body>
</html>
<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $model = $_POST['model'];
    $manufacturer_name = $_POST['manufacturer_name'];
    $hospital_id = $_POST['hospital_id'];
    $image = $_FILES['image']['name'];

    // Handle image upload
    if (!empty($image)) {
        $targetDir = 'images/';
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $imageName = 'machine_type_' . time() . '.' . $imageFileType;
        $targetPath = $targetDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = $targetPath;
        } else {
            $_SESSION['error'] = 'خطأ في رفع الملف';
            header('location: machine_type.php');
            exit();
        }
    } else {
        $imagePath = null;
    }

    // Prepare an INSERT statement
    $stmt = $conn->prepare("INSERT INTO machine_type (name, hospital_id, model, manufacturer_name, image) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sisss", $name, $hospital_id, $model, $manufacturer_name, $imagePath);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'تم إضافة موديل الماكينة بنجاح';
        } else {
            $_SESSION['error'] = $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = 'خطأ في إعداد قاعدة البيانات';
    }
} else {
    $_SESSION['error'] = 'يرجى تعبئة الخانات المطلوبة';
}

header('location: machine_type.php');
?>

<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
  $inspection_date = $_POST['inspection_date'];
  $next_inspection_date = $_POST['next_inspection_date'];
  $inspection_type = $_POST['inspection_type'];
  $machine_id = $_POST['machine_id'];

  $sql = "INSERT INTO inspection (inspection_date, next_inspection_date, inspection_type, machine_id)
          VALUES ('$inspection_date', '$next_inspection_date', '$inspection_type', '$machine_id')";
  if ($conn->query($sql)) {
    $_SESSION['success'] = 'تمت إضافة الفحص بنجاح';
  } else {
    $_SESSION['error'] = $conn->error;
  }
} else {
  $_SESSION['error'] = 'املأ النموذج أولاً';
}

header('location: inspection.php');
?>

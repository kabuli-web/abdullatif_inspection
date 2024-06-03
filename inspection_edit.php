<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {
  $id = $_POST['id'];
  $inspection_date = $_POST['inspection_date'];
  $next_inspection_date = $_POST['next_inspection_date'];
  $inspection_type = $_POST['inspection_type'];
  $machine_id = $_POST['machine_id'];

  $sql = "UPDATE inspection SET 
            inspection_date = '$inspection_date',
            next_inspection_date = '$next_inspection_date',
            inspection_type = '$inspection_type',
            machine_id = '$machine_id'
          WHERE id = '$id'";
  if ($conn->query($sql)) {
    $_SESSION['success'] = 'تم تحديث الفحص بنجاح';
  } else {
    $_SESSION['error'] = $conn->error;
  }
} else {
  $_SESSION['error'] = 'املأ النموذج أولاً';
}

header('location: inspection.php');
?>

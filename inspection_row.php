<?php
include 'includes/session.php';

if (isset($_POST['id'])) {
  $id = $_POST['id'];

  $sql = "SELECT * FROM inspection WHERE id = '$id'";
  $query = $conn->query($sql);
  $row = $query->fetch_assoc();

  echo json_encode($row);
}
?>

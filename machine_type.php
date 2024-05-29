<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      الاجهزة
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> الاجهزة</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> اضافة الايصال جديد</a>
            </div>
            <div class="box-body">
              <table id="arabic_table" class="table table-bordered">
                <thead>
                  <th>الاسم</th>
                  <th>الموديل</th>
                  <th>شركة الصنع</th>
                  <th>المستشفى</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM machine_type ORDER BY id DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $id = $row['hospital_id'];
                      $hospital_sql = "SELECT * FROM hospital WHERE id='$id'";
                      $hospital_query = $conn->query($hospital_sql);
                      $hospital = $hospital_query->fetch_assoc();
                      
                      echo "
                            <tr>
                                <td>" . $row['name'] . "</td>
                                <td>" . $row['model'] . "</td>
                                <td>" . $row['manufacturer_name'] . "</td>
                             
                                <td>" . $hospital['name'] . "</td>
                                <td>
                                    <button class='btn btn-success btn-sm btn-flat edit' data-id='" . $row['id'] . "'><i class='fa fa-edit'></i> تعديل</button>
                                    <button class='btn btn-danger btn-sm btn-flat delete' data-id='" . $row['id'] . "'><i class='fa fa-trash'></i> حذف</button>
                                </td>
                            </tr>
                        ";
                  
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/machine_type_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>

$(document).ready(function () {

  $('.select2').select2();


});

$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
  
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'machine_type_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){

      // Additional code to fill in fields in the "edit" modal
    
      $('#edit input[name="name"]').val(response.name);
      $('#edit input[name="hospital_id"]').val(response.hospital_id);
      $('#edit input[name="machine_type_id"]').val(response.id);
      $('#edit input[name="model"]').val(response.model);
      $('#delete input[name="machine_type_id"]').val(response.id);
      $('#delete input[name="name"]').val(response.name);
    }
  });
}
</script>
</body>
</html>

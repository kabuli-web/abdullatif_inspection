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
        if (isset($_SESSION['error'])) {
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
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
                    <tr>
                      <th>صورة المكينة</th>
                      <th>الرقم التسلسلي</th>
                      <th>المستشفى</th>
                      <th>موديل الماكينة</th>
                      <th> صفحة الزيارات </th>
                      <th>Tools</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                 $sql = "SELECT machine.id, machine.serial_number, hospital.name AS hospital_name, hospital.logo AS hospital_logo, machine_type.name AS machine_type_name, machine_type.image
                 FROM machine
                 JOIN hospital ON machine.hospital_id = hospital.id
                 JOIN machine_type ON machine.machine_type_id = machine_type.id
                 ORDER BY machine.id DESC";
                 
                   

                    $query = $conn->query($sql);
                    if (!$query) {
                      // Query failed
                      echo "<tr><td colspan='6'>Error: " . $conn->error . "</td></tr>";
                    } else {
                      while ($row = $query->fetch_assoc()) {
                        echo "
                <tr>
                    <td><img src='" . $row['image'] . "' width='100' height='100'></td>
                    <td>" . htmlspecialchars($row['serial_number']) . "</td>
                    <td>" . htmlspecialchars($row['hospital_name'])  . " <img src='images/" . $row['hospital_logo'] . "' width='50' height='50'></td>
                    <td>" . htmlspecialchars($row['machine_type_name']) . "</td>
                    <td><a href='machine_inspections.html?id=" . htmlspecialchars($row['id']) . "'> <button class='btn btn-success btn-sm btn-flat ' ><i class='fa fa-medkit'></i> الزيارات</button></a> </td>
                    <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='" . htmlspecialchars($row['id']) . "'><i class='fa fa-edit'></i> تعديل</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='" . htmlspecialchars($row['id']) . "'><i class='fa fa-trash'></i> حذف</button>
                    </td>
                </tr>
                ";
                      }
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
    <?php include 'includes/machine_modal.php'; ?>
  </div>
  <?php include 'includes/scripts.php'; ?>
  <script>
    $(document).ready(function() {

      $('.select2').select2();


    });

    $(function() {
      $('.edit').click(function(e) {
        e.preventDefault();
        $('#edit').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });

      $('.delete').click(function(e) {
        e.preventDefault();

        $('#delete').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });
    });

    function getRow(id) {
      $.ajax({
        type: 'POST',
        url: 'machine_row.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {

          // Additional code to fill in fields in the "edit" modal

          $('#edit input[name="serial_number"]').val(response.serial_number);
          $('#edit select[name="hospital_id"]').val(response.hospital_id);
          $('#edit select[name="machine_type_id"]').val(response.machine_type_id);
          $('#edit input[name="machine_id"]').val(response.id);

          $('#delete input[name="machine_id"]').val(response.id);
          $('#delete #serial_number').text(response.serial_number);
        }
      });
    }
  </script>
</body>

</html>
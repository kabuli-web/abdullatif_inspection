<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>الفحوصات</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">الفحوصات</li>
        </ol>
      </section>

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
                <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> اضافة فحص جديد</a>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>تاريخ الفحص</th>
                      <th>تاريخ الفحص التالي</th>
                      <th>نوع الفحص</th>
                      <th>اسم المستشفى</th>
                      <th>الأدوات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // SQL query to join inspection with machine and hospital tables
                    $sql = "SELECT inspection.id, inspection.inspection_date, inspection.next_inspection_date, inspection.inspection_type, hospital.name AS hospital_name
                            FROM inspection
                            JOIN machine ON inspection.machine_id = machine.id
                            JOIN hospital ON machine.hospital_id = hospital.id
                            ORDER BY inspection.id DESC";
                    $query = $conn->query($sql);
                    while ($row = $query->fetch_assoc()) {
                      echo "
                        <tr>
                            <td>" . htmlspecialchars($row['inspection_date']) . "</td>
                            <td>" . htmlspecialchars($row['next_inspection_date']) . "</td>
                            <td>" . htmlspecialchars($row['inspection_type']) . "</td>
                            <td>" . htmlspecialchars($row['hospital_name']) . "</td>
                            <td>
                                <button class='btn btn-success btn-sm btn-flat edit' data-id='" . htmlspecialchars($row['id']) . "'><i class='fa fa-edit'></i> تعديل</button>
                                <button class='btn btn-danger btn-sm btn-flat delete' data-id='" . htmlspecialchars($row['id']) . "'><i class='fa fa-trash'></i> حذف</button>
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
    <?php include 'includes/inspection_modal.php'; ?>
  </div>
  <?php include 'includes/scripts.php'; ?>
  <script>
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
        url: 'inspection_row.php',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
          $('#edit input[name="id"]').val(response.id);
          $('#edit input[name="inspection_date"]').val(response.inspection_date);
          $('#edit input[name="next_inspection_date"]').val(response.next_inspection_date);
          $('#edit input[name="inspection_type"]').val(response.inspection_type);
          $('#edit select[name="machine_id"]').val(response.machine_id);

          $('#delete input[name="id"]').val(response.id);
          $('#delete #inspection_type').text(response.inspection_type);
        }
      });
    }
  </script>
</body>
</html>

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
          المستشفيات
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"> المستشفيات</li>
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
                <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> إضافة مستشفى جديد</a>
              </div>
              <div class="box-body">
                <table id="arabic_table" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>الاسم</th>
                      <th>العنوان</th>
                      <th>الهاتف</th>
                      <th>الشعار</th>
                      <th>Tools</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM hospital ORDER BY id DESC";
                    $query = $conn->query($sql);
                    while ($row = $query->fetch_assoc()) {
                      echo "
                        <tr>
                          <td>" . htmlspecialchars($row['name']) . "</td>
                          <td>" . htmlspecialchars($row['address']) . "</td>
                          <td>" . htmlspecialchars($row['phone']) . "</td>
                          <td><img src='images/" . htmlspecialchars($row['logo']) . "' width='50' height='50'></td>
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
    <?php include 'includes/hospital_modal.php'; ?>
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
        url: 'hospital_row.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          $('#edit input[name="name"]').val(response.name);
          $('#edit input[name="address"]').val(response.address);
          $('#edit input[name="phone"]').val(response.phone);
          $('#edit input[name="id"]').val(response.id);
          
          $('#delete input[name="id"]').val(response.id);
          $('#delete #hospital_name').text(response.name);
          $('#edit input[name="logo"]').val(response.logo);
        }
      });
    }
  </script>
</body>

</html>

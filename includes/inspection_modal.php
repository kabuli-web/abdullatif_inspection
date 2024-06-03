<!-- Add -->
<div class="modal fade" id="addnew">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>اضافة فحص جديد</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="inspection_add.php">
          <div class="form-group">
            <label for="inspection_date" class="col-sm-3 control-label">تاريخ الفحص</label>
            <div class="col-sm-9">
              <input type="date" name="inspection_date" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            <label for="next_inspection_date" class="col-sm-3 control-label">تاريخ الفحص التالي</label>
            <div class="col-sm-9">
              <input type="date" name="next_inspection_date" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inspection_type" class="col-sm-3 control-label">نوع الفحص</label>
            <div class="col-sm-9">
              <input type="text" name="inspection_type" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            <label for="machine_id" class="col-sm-3 control-label">الماكينة</label>
            <div class="col-sm-9">
              <select name="machine_id" class="form-control" required>
                <?php
                $sql = "SELECT machine.id, machine.serial_number, hospital.name AS hospital_name 
                        FROM machine 
                        JOIN hospital ON machine.hospital_id = hospital.id";
                $query = $conn->query($sql);
                while ($machine = $query->fetch_assoc()) {
                  echo '<option value="' . $machine['id'] . '">' . $machine['serial_number'] . ' (' . $machine['hospital_name'] . ')</option>';
                }
                ?>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> الغاء</button>
        <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> حفظ</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>تعديل الفحص</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="inspection_edit.php">
          <input type="hidden" name="id">
          <div class="form-group">
            <label for="inspection_date" class="col-sm-3 control-label">تاريخ الفحص</label>
            <div class="col-sm-9">
              <input type="date" name="inspection_date" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            <label for="next_inspection_date" class="col-sm-3 control-label">تاريخ الفحص التالي</label>
            <div class="col-sm-9">
              <input type="date" name="next_inspection_date" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inspection_type" class="col-sm-3 control-label">نوع الفحص</label>
            <div class="col-sm-9">
              <input type="text" name="inspection_type" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            <label for="machine_id" class="col-sm-3 control-label">الماكينة</label>
            <div class="col-sm-9">
              <select name="machine_id" class="form-control" required>
                <?php
                // Same query as above to populate machines in edit modal
                $sql = "SELECT machine.id, machine.serial_number, hospital.name AS hospital_name 
                        FROM machine 
                        JOIN hospital ON machine.hospital_id = hospital.id";
                $query = $conn->query($sql);
                while ($machine = $query->fetch_assoc()) {
                  echo '<option value="' . $machine['id'] . '">' . $machine['serial_number'] . ' (' . $machine['hospital_name'] . ')</option>';
                }
                ?>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> الغاء</button>
        <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check"></i> تحديث</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>حذف الفحص</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="inspection_delete.php">
          <input type="hidden" class="id" name="id">
          <div class="text-center">
            <p>هل أنت متأكد من حذف</p>
            <h2 id="inspection_type" class="bold"></h2>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> الغاء</button>
        <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> حذف</button>
        </form>
      </div>
    </div>
  </div>
</div>

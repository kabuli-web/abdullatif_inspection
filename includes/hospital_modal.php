<!-- Add New Hospital Modal -->
<div class="modal fade" id="addnew">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>إضافة مستشفى جديد</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="hospital_add.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">الاسم</label>
            <div class="col-sm-9">
              <input required type="text" name="name" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="address" class="col-sm-3 control-label">العنوان</label>
            <div class="col-sm-9">
              <input required type="text" name="address" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="phone" class="col-sm-3 control-label">الهاتف</label>
            <div class="col-sm-9">
              <input required type="text" name="phone" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="logo" class="col-sm-3 control-label">الشعار</label>
            <div class="col-sm-9">
              <input required type="file" name="logo" class="form-control">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> إلغاء</button>
        <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> حفظ</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Hospital Modal -->
<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>تعديل المستشفى</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="hospital_edit.php" enctype="multipart/form-data">
          <input type="hidden" name="id">
          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">الاسم</label>
            <div class="col-sm-9">
              <input required type="text" name="name" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="address" class="col-sm-3 control-label">العنوان</label>
            <div class="col-sm-9">
              <input required type="text" name="address" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="phone" class="col-sm-3 control-label">الهاتف</label>
            <div class="col-sm-9">
              <input required type="text" name="phone" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="logo" class="col-sm-3 control-label">الشعار</label>
            <div class="col-sm-9">
              <input type="file" name="logo" class="form-control">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> إلغاء</button>
        <button type="submit" class="btn btn-primary btn-flat" name="edit"><i class="fa fa-save"></i> حفظ</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete Hospital Modal -->
<div class="modal fade" id="delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b><span id="hospital_name"></span></b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="hospital_delete.php">
          <input type="hidden" class="hospital_id" name="id">
          <div class="text-center">
            <p>هل أنت متأكد من حذف</p>
            <h2 id="hospital_name" class="bold"></h2>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> إلغاء</button>
        <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> حذف</button>
        </form>
      </div>
    </div>
  </div>
</div>

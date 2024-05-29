<!-- Add -->
<div class="modal fade" id="addbalance">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>اضافة رصيد</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="balance_add.php">
          		  <div class="form-group">
                  	<label for="description" class="col-sm-3 control-label">تفاصيل</label>

						<div class="col-sm-9">
						<input required type="text" name="description" class="form-control">
						</div>
                	</div>

					<div class="form-group">
                  	<label for="amount" class="col-sm-3 control-label">المبلغ</label>

						<div class="col-sm-9" style="display:flex;">
							<input required type="number" name="amount" min="0" step="0.01" class="form-control">
							<span class="input-group-addon" style="width:fit-content">ريال</span>
						</div>
                	</div>

					<div class="form-group">
                  	<label for="account_id" class="col-sm-3 control-label">الى حساب</label>
						<div class="col-sm-9">
							<select required name="account_id" class="form-control" id="account_id">
							<?php 
								$sql = "SELECT * FROM account";
								$query = $conn->query($sql);

								while ($account = $query->fetch_assoc()) {
									echo '<option value="' . $account['id'] . '">' . $account['name'] . '</option>';
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

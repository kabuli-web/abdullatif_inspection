<!-- Add -->
<div class="modal fade" id="addnew">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>اضافة  جهاز</b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST" action="machine_add.php">
					<div class="form-group">
						<label for="serial_number" class="col-sm-3 control-label">الرقم التسلسلي</label>

						<div class="col-sm-9">
							<input required type="text" name="serial_number" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="machine_type_id" class="col-sm-3 control-label">موديل الماكينة</label>
						<div class="col-sm-9">
							<select required name="machine_type_id" class="form-control" id="hospital_id">
								<?php
								include 'conn.php';
								$sql = "SELECT * FROM machine_type";
								$query = $conn->query($sql);

								while ($machine_type = $query->fetch_assoc()) {
									echo '<option value="' . $machine_type['id'] . '">' . $machine_type['name'] . '</option>';
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="hospital_id" class="col-sm-3 control-label">المستشفى</label>
						<div class="col-sm-9">
							<select required name="hospital_id" class="form-control" id="hospital_id">
								<?php
								include 'conn.php';
								$sql = "SELECT * FROM hospital";
								$query = $conn->query($sql);

								while ($hospital = $query->fetch_assoc()) {
									echo '<option value="' . $hospital['id'] . '">' . $hospital['name'] . '</option>';
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
				<h4 class="modal-title"><b><span class="employee_name"></span></b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST" action="machine_edit.php">
					<input type="number" hidden name="machine_id">
					<div class="form-group">
						<label for="serial_number" class="col-sm-3 control-label">الرقم التسلسلي</label>

						<div class="col-sm-9">
							<input required type="text" name="serial_number" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="machine_type_id" class="col-sm-3 control-label">موديل الماكينة</label>
						<div class="col-sm-9">
							<select required name="machine_type_id" class="form-control" id="hospital_id">
								<?php
								include 'conn.php';
								$sql = "SELECT * FROM machine_type";
								$query = $conn->query($sql);

								while ($machine_type = $query->fetch_assoc()) {
									echo '<option value="' . $machine_type['id'] . '">' . $machine_type['name'] . '</option>';
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="hospital_id" class="col-sm-3 control-label">المستشفى</label>
						<div class="col-sm-9">
							<select required name="hospital_id" class="form-control" id="hospital_id">
								<?php
								include 'conn.php';
								$sql = "SELECT * FROM hospital";
								$query = $conn->query($sql);

								while ($hospital = $query->fetch_assoc()) {
									echo '<option value="' . $hospital['id'] . '">' . $hospital['name'] . '</option>';
								}
								?>
							</select>
						</div>
					</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> الغاء</button>
				<button type="submit" class="btn btn-primary btn-flat" name="edit"><i class="fa fa-save"></i> حفظ</button>
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
				<h4 class="modal-title"><b><span id="serial_number"></span></b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST" action="machine_delete.php">
					<input type="hidden" class="machine_id" name="machine_id">
					

					<div class="text-center">
						<p>حذف الجهاز </p>

					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
				<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
				</form>
			</div>
		</div>
	</div>
</div>
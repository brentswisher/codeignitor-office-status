<style>
	.table {
		font-size: 26px;
	}
	.table tr {
		cursor: pointer;
	}
	.table tr td:first-child {
		width: 250px;
	}
	.table-striped > tbody > tr:nth-child(odd) {
		background-color: #ecf0f1;
	}
	.table-hover > tbody > tr:hover {
		color: #FFF;
		background-color: #95a5a6;
	}
	.table tr td:last-child {
		vertical-align: middle;
		font-size: 20px;
	}
	.table .glyphicon {
		font-size: 26px;
	}
	.table .glyphicon-ok-circle {
		color: green;
	}
	.table .glyphicon-remove-circle {
		color: red;
	}
</style>

<script>
	var employeeStatus = '';

	function updateEmployee(username) {
		$.ajax({url: `status/${username}`, success: function(result){
			loadModal(JSON.parse(result));
		}});
	}

	function updateState(frm){
		let username = $('#employee').val(username);
		let isAvailable = $('#isAvailable').val(isAvailable);
		let statusPublicId = $('#statusId').val(statusPublicId);
		let note = $('#note').val(note);

		$.ajax({
			url: `status/${username}`,
				success: function(result){
					$('#statusModal').modal('hide');
				}	
		});

	}
	function loadModal( { username, isAvailable, note, statusPublicId } = emplyeeInfo ) {
		console.log(arguments);
		$('#employee').val(username);
		$('#isAvailable').val(isAvailable);
		$('#statusId').val(statusPublicId);
		$('#note').val(note);
		$('#statusModal').modal('show');
	}

	// function updateStatus() {
	// 	var employeeId = $('#employeeId').val();

	// 	$('#inOffice').val(employeeStatus[employeeId].inOffice);
	// 	$('#noteId').val(employeeStatus[employeeId].noteId);
	// 	$('#otherNote').val(employeeStatus[employeeId].otherNote);

	// 	updateNote();
	// }
	// function updateNote() {
	// 	checkOther();
	// }
	// function checkOther() {
	// 	if ($('#note').val() != "") {
	// 		$('#otherNote').show();
	// 	} else {
	// 		$('#otherNote').hide();
	// 		$('#otherNote').val('');
	// 	}
	// }
</script>
<button type="button" class="btn btn-lg btn-primary" onClick="updateEmployee();"><span class="glyphicon glyphicon-user"></span> Update My Status</button>

<div class="row">



	<?php $splitUsers = array_chunk($users, ceil(count($users) / 2)); ?>
	<div class="col-md-6">
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>
						Name
					</th>
					<th>
						Status
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($splitUsers[0] as $user_item): ?>
					<tr onClick="updateEmployee('<?=$user_item['username']?>');">
						<td><?=$user_item['lastName'] . ', ' . $user_item['firstName'] ?></td>
						<td>
							<span class="glyphicon glyphicon-<?= ($user_item['isAvailable'] == 1 ? 'ok' : 'remove') ?>-circle"></span>
							 <?php
							 	if(!empty($user_item['status'])){
							 		echo '&nbsp;' . $user_item['status'];
								};
								if(!empty($user_item['note'])){
							 		echo '&nbsp;(' . $user_item['note'] . ')';
								};
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="col-md-6">
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>
						Name
					</th>
					<th>
						Status
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($splitUsers[1] as $user_item): ?>
					<tr onClick="updateEmployee();">
						<td><?=$user_item['lastName'] . ', ' . $user_item['firstName'] ?></td>
						<td>
							<span class="glyphicon glyphicon-<?= ($user_item['isAvailable'] === 1 ? 'ok' : 'remove') ?>-circle"></span>
							&nbsp; <?= $user_item['status'] ?>
							&nbsp; <?= $user_item['note'] ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- <cfIf sb.isLoggedIn> -->
	<div class="modal fade" id="statusModal" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" onSubmit="updateStatus(this)">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">My Status</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<strong>Employee:</strong>
							<br />
							<select name="employee" id="employee" class="form-control">
								<?php foreach ($users as $user_item): ?>
									<option value="<?=$user_item['username']?>">
										<?= $user_item['lastName'] . ', ' . $user_item['firstName'] ?>
									</option>
								<?php endforeach ?>
								<!-- <cfOutput query="qryEmployees">
									<option value="#encodeForHTMLAttribute(qryEmployees.employeeId)#">#encodeForHTML(qryEmployees.fName)# #encodeForHTML(qryEmployees.lName)#</option>
								</cfOutput> -->
							</select>
						</div>
						<div class="form-group">
							<strong>In Office:</strong>
							<br />
							<select name="isAvailable" id="isAvailable" class="form-control">
								<option value="1">Yes</option>
								<option value="0">No</option>
							</select>
						</div>
						<div class="form-group">
							<strong>Status:</strong>
							<br />
							<select name="statusId" id="statusId" class="form-control">
								<option value="">None</option>
								<?php foreach ($statuses as $status_item): ?>
									<option value="<?=$status_item['publicId']?>">
										<?= $status_item['title'] ?>
									</option>
								<?php endforeach ?>
							</select>
							<br />
							<input type="text" name="note" id="note" class="form-control" placeholder="Additional Info (location, duration, etc.)" />
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> Update Status</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<!-- </cfIf> -->
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

<button type="button" class="btn btn-lg btn-primary" onClick="updateEmployee();"><span class="glyphicon glyphicon-user"></span> Update My Status</button>

<div class="row">



	<?php
		$splitUsers = array_chunk($users, ceil(count($users) / 2));  
		foreach ($splitUsers as $user_subset): 
	?>
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
					<?php foreach ($user_subset as $user_item): ?>
						<tr data-user="<?=$user_item['username']?>" onClick="updateEmployee('<?=$user_item['username']?>');">
							<td><?=$user_item['lastName'] . ', ' . $user_item['firstName'] ?></td>
							<td class="status-column">
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
	<?php endforeach; ?>
</div>

<!-- <cfIf sb.isLoggedIn> -->
	<div class="modal fade" id="statusModal" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="statusForm" method="post" onSubmit="return updateStatus(this)">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">My Status</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<strong>Employee:</strong>
							<br />
							<select name="employee" id="employee" class="form-control" onChange>
								<?php foreach ($users as $user_item): ?>
									<option value="<?=$user_item['username']?>">
										<?= $user_item['lastName'] . ', ' . $user_item['firstName'] ?>
									</option>
								<?php endforeach ?>
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

<script>
	var employeeStatus = '';

	function updateEmployee(username) {
		if(username !== undefined){
			$.ajax({url: `/officestatus/dashboard/status/${username}`, success: function(result){
				loadModal(JSON.parse(result));
			}});	
		} else {
			resetModal();
			$('#statusModal').modal('show');
		}
	}

	function updateStatus(frm){
		let username = $('#employee').val();
		let isAvailable = $('#isAvailable').val();
		let statusPublicId = $('#statusId').val();
		let note = $('#note').val();
		$.post({
			url:`/officestatus/dashboard/status/${username}`,
			data: $(frm).serialize(),
			success: function(result,status){
				if(status == 'success'){
					let content = `<span class="glyphicon glyphicon-${ isAvailable == 1 ? 'ok' : 'remove'}-circle"></span>`;
					if(statusPublicId !== ''){
						content += `&nbsp; ${ $('#statusId option:selected').text()}`;
					}
					if(note !== ''){
						content += `&nbsp; ${ note }`;
					}

					$('tr[data-user="'+username+'"] > .status-column').html(content);
					$('#statusModal').modal('hide');
					resetModal();
				} else {
					alert('There was a problem with your status update');
				}
			}	
		});
		return false;
	}

	function resetModal(){
		$('#employee').val('');
		$('#isAvailable').val(1);
		$('#statusId').val('');
		$('#note').val('');
	}
	function loadModal( { username, isAvailable, note, statusPublicId } = emplyeeInfo ) {
		$('#employee').val(username);
		$('#isAvailable').val(isAvailable);
		$('#statusId').val(statusPublicId);
		$('#note').val(note);
		$('#statusModal').modal('show');
	}
	document.getElementById('employee').addEventListener('change', function(e,el){
		updateEmployee(e.target.value);
		console.log(e.target.value);
	}); // FF & friends
	
</script>
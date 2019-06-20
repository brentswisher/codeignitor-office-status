<h1><?php echo $title; ?></h1>
<p>
	<a class="btn btn-sm btn-success" href="create/">
		<span class="glyphicon glyphicon-plus"></span>
		Add New Employee
	</a>
</p>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Username</th>
			<th>Actions</th>
		</tr>
	</thead>
	<?php if(empty($users)){ ?>
		<tr>
			<td colspan="4">There are no employees found.</td>
		</tr>
	<?php } else { ?>
	<?php foreach ($users as $user_item): ?>
		<tr>
			<td><?=$user_item['firstName'] . ' ' . $user_item['lastName'] ?></td>
			<td><?=$user_item['username']?></td>
			<td>
				<a class="btn btn-sm btn-primary" href="edit/<?=$user_item['username']?>">
					<span class="glyphicon glyphicon-pencil"></span> Edit
				</a>
				<a class="btn btn-sm btn-danger" href="delete/<?=$user_item['username']?>">
					<span class="glyphicon glyphicon-trash"></span> Delete
				</a>
			</td>
		</tr>
	<?php endforeach;} ?>	
</table>

<h1><?php echo $title; ?></h1>
<p>
	<a class="btn btn-sm btn-success" href="create/">
		<span class="glyphicon glyphicon-plus"></span>
		Add New Status
	</a>
</p>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<?php if(empty($statuses)){ ?>
		<tr>
			<td colspan="4">There are currently no statuses.</td>
		</tr>
	<?php } else { ?>
	<?php foreach ($statuses as $status_item): ?>
		<tr>
			<td><?=$status_item['title'] ?></td>
			<td>
				<a class="btn btn-sm btn-primary" href="edit/<?=$status_item['publicId']?>">
					<span class="glyphicon glyphicon-pencil"></span> Edit
				</a>
				<a class="btn btn-sm btn-danger" href="delete/<?=$status_item['publicId']?>">
					<span class="glyphicon glyphicon-trash"></span> Delete
				</a>
			</td>
		</tr>
	<?php endforeach;} ?>	
</table>

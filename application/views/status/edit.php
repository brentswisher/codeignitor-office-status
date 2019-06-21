<h1><?php echo $title; ?></h1>

<?php echo validation_errors(); ?>
<?=form_open('status/edit/'.$status_item['publicId'], ['class' => 'form'], ['statusId' => $status_item['publicId']])?>
	<div class="well">
	    <p>
	    	<label for="title">Title</label>
	    	<input type="text" class="form-control" name="title" value="<?=$status_item['title'] ?>" />
	    </p>
		<p>
			<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-save"></span> Save</button>
		</p>
	</div>
</form>
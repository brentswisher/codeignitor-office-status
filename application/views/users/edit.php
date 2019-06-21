<h1><?php echo $title; ?></h1>

<?php echo validation_errors(); ?>
<?=form_open('users/edit/'.$user_detail['username'], ['class' => 'form'], ['userId' => $user_detail['publicId']])?>
	<div class="well">
	    <p>
	    	<label for="username">Username</label>
	    	<input type="text" class="form-control" name="username" value="<?=$user_detail['username'] ?>" />
	    </p>
		<p>
			<label for="firstName">First Name</label>
	    	<input type="text" class="form-control" name="firstName" value="<?=$user_detail['firstName'] ?>" />
	    </p>
		<p>
			<label for="lastName">Last Name</label>
	    	<input type="text" class="form-control" name="lastName" value="<?=$user_detail['lastName'] ?>" />
	    </p>
	    <p>
			<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-save"></span> Save</button>
		</p>
	</div>
</form>
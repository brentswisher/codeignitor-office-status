<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('users/create'); ?>

    <label for="username">Username</label>
    <input type="input" name="username" /><br />

	<label for="firstName">First Name</label>
    <input type="input" name="firstName" /><br />

	<label for="lastName">Last Name</label>
    <input type="input" name="lastName" /><br />

    <input type="submit" name="submit" value="Create new user" />
</form>
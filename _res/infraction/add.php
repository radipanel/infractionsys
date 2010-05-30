<?php
// Prevent the script from being called directly
if( !preg_match( "/index.php/i", $_SERVER['PHP_SELF'] ) ) { die(); }

// Require the functions.php file
require_once( "functions.php" );

// Check if the form has been submitted
if ( isset( $_POST['submitted'] == "true" ) ) {

	// Insert data into variables
	$username = $_POST['username'];

	// So, they've submitted the form, so we clean up some of the inputs
	$reason = $core->clean( $_POST['reason'] );
	
	// And then we figure out if they are issuing an infraction or a warning
	if ( $_POST['type'] == "infraction" ) {
		
		// They are issuing an infraction
		$infraction_issue = addInfractionToUser( $username, $reason );

		// Check if the process finished successfully
		switch ( $infraction_issue ) {
			
			case true:
				// It did
				$status = true;
				break;
			
			case false:
				// It failed :(
				$status = false;
				break;		
		}

	}
	else if ( $_POST['type'] == "warning" ) {

		// They are issuing an infraction
		$warning_issue = addWarningToUser( $username, $reason );

		// Check if the process finished successfully
		switch ( $warning_issue ) {
			
			case true:
				// It did
				$status = true;
				break;
			
			case false:
				// It failed :(
				$status = false;
				break;		
		}
	}
}
else {
?>
<form action="" method="post" id="addInfraction">

	<div class="box">

		<div class="square title">
			<strong>Issue Infraction / Warning To User</strong>
		</div>

		<p>Naughty users? Give them an infraction! Select a user, and click add!</p>
		<label for="username">User:</label>
		<select name="username" id="username">
		<?php
			// First, we grab all the users
			$getUsers = $db->query( "SELECT * FROM users" );
			// And then we use a while loop to create a select HTML statement
			while( $array = $db->assoc( $getUsers ) ) {
		?>
		<option value="<?php echo $array['username']; ?>"><?php echo $array['username']; ?></option>
		<?php
			}
		?>
		</select>

		<label for="type">Type:</label>
		<select name="type" id="type">

			<option value="infraction">Infraction</option>
			<option value="warning">Warning</option>

		</select>

		<label for="reason">Reason:</label>
		<input type="text" name="reason" />

		<input type="hidden" name="submitted" value="true" />

		<input type="submit" value="Add!" />
</form>
<?php
}
?>


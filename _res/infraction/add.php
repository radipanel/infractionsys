<?php
if( !preg_match( "/index.php/i", $_SERVER['PHP_SELF'] ) ) { die(); }

require_once( "functions.php" );

?>
<form action="" method="post" id="addInfraction">

	<div class="box">

		<div class="square title">
			<strong>Issue Infraction / Warning To User</strong>
		</div>

		<p>Naughty users? Give them an infraction! Select a user, and click add!</p>
		<label for="user">User:</label>
		<select name="user" id="user">
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

</form>


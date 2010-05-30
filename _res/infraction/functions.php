<?php
require_once( "../../_inc/glob.php" );

/*
 * addInfractionToUser - adds an infraction to a user.
 * @param  $username - required. the name of the user we are infracting.
 * @param  $reason - required. the reason for adding the infraction.
 */
function addInfractionToUser( $username, $reason ) {

	// First, we grab how many infractions this user currently has
	$preinfraction = $db->query ( "SELECT totalInfractions FROM users WHERE username = {$username}" );

	// So now we have that, we add one to the number
	$newinfraction = $preinfraction + 1;

	// Now, we check if we need to change one into a warning, and we do that when there are 3
	if ( $newinfraction >= 3 ) {
		// They have more than 3 infractions, so we add one warning to the user, so first we check how many they have
		$prewarning = $db->query ( "SELECT totalWarnings FROM users WHERE username = {$username}" );
		
		// Now we have that, we add one
		$newwarning = $prewarning + 1;

		// And to make it fair, we take 3 infractions from their number
		$newinfraction = $newinfraction - 3;

		// And now that has been processed, we can write to the database the updated numbers
		$db->query ( "UPDATE users SET totalInfractions = {$newinfraction} WHERE username = {$username}" );
		$db->query ( "UPDATE users SET totalWarnings = {$newwarning} WHERE username = {$username}" );
	}
	else {
		// They don't have more than 3 infractions, so we just update their total
		$db->query ( "UPDATE users SET totalInfractions = {$newinfraction} WHERE username = {$username}" );
	}

	// And log the infraction
	$db->query ( "INSERT INTO infraction_log (username, reason, addrem) VALUES ({$username}, {$reason}, 'add')" );

	// And it's done ;)
	return true;

}

/*
 * removeInfractionFromUser - removes an infraction from a user.
 * @param  $username - required. the name of the user we are removing an infraction.
 * @param  $reason - required. the reason for removing the infraction.
 */
function removeInfractionFromUser( $username, $reason ) {

	// First, we grab how many infractions this user currently has
	$preinfraction = $db->query ( "SELECT totalInfractions FROM users WHERE username = {$username}" );

	// So now we have that, we take one from the number
	$newinfraction = $preinfraction - 1;

	// And now we just update their total
	$db->query ( "UPDATE users SET totalInfractions = {$newinfraction} WHERE username = {$username}" );
	
	// And log the removed infraction
	$db->query ( "INSERT INTO infraction_log (username, reason, addrem) VALUES ({$username}, {$reason}, 'rem')" );

	// And it's done ;)
	return true;

}

/*
 * addWarningToUser - adds an warning to a user.
 * @param  $username - required. the name of the user we are warning.
 * @param  $reason - required. the reason for adding the infraction.
 */
function addWarningToUser( $username, $reason ) {

	// First, we grab how many warnings this user currently has
	$prewarning = $db->query ( "SELECT totalWarnings FROM users WHERE username = {$username}" );

	// So now we have that, we add one to the number
	$newwarning = $prewarning + 1;

	// Now, we check if the user has 3 warnings and need to alert an administrator
	if ( $newwarning >= 3 ) {
		// They have more than 3 warnings, so we need to alert an admin (although I have no idea how I'm going to do it without hacking the core code >.>)
		$db->query ( "UPDATE users SET totalWarnings = {$newwarning} WHERE username = {$username}" );
	}
	else {
		// They don't have more than 3 warnings, so we just update their total
		$db->query ( "UPDATE users SET totalWarnings = {$newwarning} WHERE username = {$username}" );
	}

	// And log the infraction
	$db->query ( "INSERT INTO infraction_log (username, reason, addrem) VALUES ({$username}, {$reason}, 'add')" );

	// And it's done ;)
	return true;

}

/*
 * removeWarningFromUser - removes a warning from a user.
 * @param  $username - required. the name of the user we are removing a warning.
 * @param  $reason - required. the reason for removing the warning.
 */
function removeWarningFromUser( $username, $reason ) {

	// First, we grab how many warnings this user currently has
	$prewarning = $db->query ( "SELECT totalWarnings FROM users WHERE username = {$username}" );

	// So now we have that, we take one from the number
	$newwarning = $prewarning - 1;

	// And now we just update their total
	$db->query ( "UPDATE users SET totalWarnings = {$newwarning} WHERE username = {$username}" );
	
	// And log the removed infraction
	$db->query ( "INSERT INTO infraction_log (username, reason, addrem) VALUES ({$username}, {$reason}, 'rem')" );

	// And it's done ;)
	return true;

}
?>

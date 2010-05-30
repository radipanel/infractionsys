<?php
require_once( "../../_inc/glob.php" );

/*
 * addInfractionToUser - adds an infraction to a user.
 * @param  $username - required. the name of the user we are infracting.
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
	$db->query ( "INSERT INTO infraction_log (username, reason) VALUES ({$username}, {$reason})" );

	// And it's done ;)
	return true;

}

/*
 * removeInfractionFromUser - removes an infraction from a user.
 * @param  $username - required. the name of the user we are removing an infraction.
 * @return $q      - true if the infraction was removed, false if it wasn't.
 */
function removeInfractionFromUser( $username ) {

}

/*
 * addWarningToUser - adds an warning to a user.
 * @param  $username - required. the name of the user we are warning.
 * @return $q      - true if the warning was added, false if it wasn't.
 */
function addWarningToUser( $username ) {

}

/*
 * removeWarningFromUser - removes a warning from a user.
 * @param  $username - required. the name of the user we are removing a warning.
 * @return $q      - true if the warning was removed, false if it wasn't.
 */
function removeWarningFromUser( $username ) {

}
?>

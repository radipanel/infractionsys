<?php
include( "../../_inc/glob.php" );

/*
 * addInfractionToUser - adds an infraction to a user.
 * @param  $username - required. the name of the user we are infracting.
 * @param  $reason - required. the reason for adding the infraction.
 */
function addInfractionToUser( $username, $reason ) {
	
	// Declare $db as a global variable
	global $db;
	
	// First, we grab how many infractions this user currently has
	$preinfraction = $db->query( "SELECT totalInfractions FROM users WHERE username = '{$username}' LIMIT 1" );
	$preinfraction = mysql_result($preinfraction,"totalInfractions");
	
	// So now we have that, we add one to the number
	$newinfraction = $preinfraction + 1;
	
	// Now, we check if we need to change one into a warning, and we do that when there are 3
	if ( $newinfraction >= 3 ) {
		// They have more than 3 infractions, so we add one warning to the user, so first we check how many they have
		$prewarning = $db->query( "SELECT totalWarnings FROM users WHERE username = '{$username}' LIMIT 1" );
		$prewarning = mysql_result($prewarning,"totalWarnings");
		
		// Now we have that, we add one
		$newwarning = $prewarning + 1;

		// And to make it fair, we take 3 infractions from their number
		$newinfraction = $newinfraction - 3;

		// And now that has been processed, we can write to the database the updated numbers
		$db->query ( "UPDATE users SET totalInfractions = '{$newinfraction}' WHERE username = '{$username}'" );
		$db->query ( "UPDATE users SET totalWarnings = '{$newwarning}' WHERE username = '{$username}'" );
	}
	else {
		// They don't have more than 3 infractions, so we just update their total
		$db->query( "UPDATE users SET totalInfractions = '{$newinfraction}' WHERE username = '{$username}'" );
	}

	// And log the infraction
	$db->query( "INSERT INTO infraction_log (id, username, reason, addrem, timestamp) VALUES (NULL, '{$username}', '{$reason}', 'add', NULL)" );

	// And it's done ;)
	return true;

}

/*
 * removeInfractionFromUser - removes an infraction from a user.
 * @param  $username - required. the name of the user we are removing an infraction.
 * @param  $reason - required. the reason for removing the infraction.
 */
function removeInfractionFromUser( $username, $reason ) {

	// Declare $db as a global variable
	global $db;
	
	// First, we grab how many infractions this user currently has
	$preinfraction = $db->query( "SELECT totalInfractions FROM users WHERE username = '{$username}' LIMIT 1" );
	$preinfraction = mysql_result($preinfraction,"totalInfractions");

	// So now we have that, we take one from the number
	$newinfraction = $preinfraction - 1;

	// And now we just update their total
	$db->query( "UPDATE users SET totalInfractions = '{$newinfraction}' WHERE username = '{$username}'" );
	
	// And log the removed infraction
	$db->query( "INSERT INTO infraction_log (id, username, reason, addrem, timestamp) VALUES (NULL, '{$username}', '{$reason}', 'rem', NULL)" );

	// And it's done ;)
	return true;

}

/*
 * addWarningToUser - adds an warning to a user.
 * @param  $username - required. the name of the user we are warning.
 * @param  $reason - required. the reason for adding the warning.
 */
function addWarningToUser( $username, $reason ) {

	// Declare $db as a global variable
	global $db;
	
	// First, we grab how many warnings this user currently has
	$prewarning = $db->query( "SELECT totalWarnings FROM users WHERE username = '{$username}'" );
	$prewarning = mysql_result($prewarning,"totalWarnings");
	
	// So now we have that, we add one to the number
	$newwarning = $prewarning + 1;

	// Now, we check if the user has 3 warnings and need to alert an administrator
	if ( $newwarning >= 3 ) {
		// They have more than 3 warnings, so now we need to ban them! First, change the number of warnings
		$db->query( "UPDATE users SET totalWarnings = '{$newwarning}' WHERE username = '{$username}'" );

		// And then ban them, using the ban system created by Swimo
		$db->query( "UPDATE users SET banned = '1' WHERE username = '{$username}'" );
	}
	else {
		// They don't have more than 3 warnings, so we just update their total
		$db->query( "UPDATE users SET totalWarnings = '{$newwarning}' WHERE username = '{$username}'" );
	}

	// And log the infraction
	$db->query( "INSERT INTO infraction_log (id, username, reason, addrem, timestamp) VALUES (NULL, '{$username}', '{$reason}', 'add', NULL)" );

	// And it's done ;)
	return true;

}

/*
 * removeWarningFromUser - removes a warning from a user.
 * @param  $username - required. the name of the user we are removing a warning.
 * @param  $reason - required. the reason for removing the warning.
 */
function removeWarningFromUser( $username, $reason ) {

	// Declare $db as a global variable
	global $db;
	
	// First, we grab how many warnings this user currently has
	$prewarning = $db->query( "SELECT totalWarnings FROM users WHERE username = '{$username}' LIMIT 1" );
	$prewarning = mysql_result($prewarning,"totalWarnings");

	// So now we have that, we take one from the number
	$newwarning = $prewarning - 1;

	// And now we just update their total
	$db->query( "UPDATE users SET totalWarnings = '{$newwarning}' WHERE username = '{$username}'" );
	
	// And log the removed infraction
	$db->query( "INSERT INTO infraction_log (id, username, reason, addrem, timestamp) VALUES (NULL, '{$username}', '{$reason}', 'rem', NULL)" );

	// And it's done ;)
	return true;

}
?>

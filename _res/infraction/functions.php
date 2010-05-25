<?php
require_once( "_inc/glob.php" );

/*
 * checkdbfield - checks MySQL table for field existance.
 * @param  $fieldname - required. the name of the field we are trying to find.
 * @return $q      - true if the field exists, false if it doesn't.
 */
function checkdbfield($fieldname) {
	
	$fields = $db->query( "SHOW COLUMNS FROM users [LIKE '". $fieldname ."']" );
	$columns = mysql_num_fields($fields);
	
	for ($i = 0; $i < $columns; $i++) {

		$field_array[] = mysql_field_name($fields, $i);

	}

	if (!in_array($fieldname, $field_array)) {

		return true;

	}
	else {

		return false;

	}
}

/*
 * addinfractiontouser - adds an infraction to a user.
 * @param  $username - required. the name of the user we are infracting.
 * @return $q      - true if the warning was added, false if it wasn't.
 */
function addinfractiontouser($username) {

}

/*
 * addwarningtouser - adds an warning to a user.
 * @param  $username - required. the name of the user we are warning.
 * @return $q      - true if the warning was added, false if it wasn't.
 */
function addwarningtouser($username) {

}
?>

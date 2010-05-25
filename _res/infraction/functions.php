<?php
require_once( "_inc/glob.php" );

/*
 * checkdbfield - checks MySQL table for field existance.
 * @param  $fieldname - required. the name of the field we are trying to find.
 * @return $q      - true if the field exists, false if it doesn;t.
 */
function checkdbfield($fieldname) {
	
	$fields = mysql_list_fields($params['db']['database'], 'users');
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
?>

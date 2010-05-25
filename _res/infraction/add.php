<?php
if( !preg_match( "/index.php/i", $_SERVER['PHP_SELF'] ) ) { die(); }

require_once( "functions.php" );

$num_infract_exist = checkdbfield("num_infract");
$num_warn_exist = checkdbfield("num_warn");

switch $num_infract_exist
	case true:
		break;

	case false:
		$db->query( "ALTER TABLE `users` ADD `num_infract` INT(1) NOT NULL DEFAULT ‘0′" );
		break;

switch $num_warn_exist
	case true:
		break;

	case false:
		$db->query( "ALTER TABLE `users` ADD `num_warn` INT(1) NOT NULL DEFAULT ‘0′" );
		break;
?>
<form action="" method="post" id="addInfraction">

	<div class="box">

		<div class="square title">
			<strong>Issue Infraction / Warning To User</strong>
		</div>

</form>
<?php
}
else {


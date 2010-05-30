<?php
// Prevent the script from being called directly
if( !preg_match( "/index.php/i", $_SERVER['PHP_SELF'] ) ) { die(); }

// Require the functions.php file
require_once( "functions.php" );
?>
<form action="" method="post" id="viewInfraction">

	<div class="box">

		<div class="square title">
			<strong>View Infraction Log For User</strong>
		</div>

		<p>This feature hasn't been coded yet.... But remember that this version is considered <strong>alpha</strong> code and not safe for a production site. I'll get around to it, I promise</p>
</form>

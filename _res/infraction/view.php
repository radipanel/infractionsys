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

		<p>The infraction log is a list of all infractions issued, to whom and for what. Nothing special here, it's just a big list!</p>

		<?php
		// Declare $db as a global
		global $db;

		$infraction_log = $db->query( "SELECT * FROM infraction_log" );
		
		while( $array = $db->assoc( $infraction_log ) ) {
		
			echo "<div class=\"row {$i}\">";
			
			echo "Infraction to <strong>{$array['username']}</strong>";
			echo "<br />";
			echo "<strong>Reason:</strong> {$array['host']}";
			echo "</div>";
			
			$i++;

		}
		?>		
</form>

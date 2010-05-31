<?php
// Prevent the script from being called directly
if( !preg_match( "/index.php/i", $_SERVER['PHP_SELF'] ) ) { die(); }

// Require the functions.php file
require_once( "functions.php" );
?>
<form action="" method="post" id="viewInfraction">

	<div class="box">

		<div class="square title">
			<strong>View Infraction Log</strong>
		</div>

		<p>The infraction log is a list of all infractions issued, to whom and for what. Nothing special here, it's just a big list!</p>

		<?php
		// Declare $db as a global
		global $db;

		$infraction_log = $db->query( "SELECT * FROM infraction_log" );
		
		while( $array = $db->assoc( $infraction_log ) ) {
		
			echo "<div class=\"row {$i}\">";
			
			$array['type'] = ucwords( $array['type'] );
			
			echo "{$array['type']} Report: <strong>{$array['username']}</strong>";
			echo "<br />";
			echo "<strong>Reason:</strong> {$array['reason']}";
			echo "<br />";
			if ( $array['addrem'] == "add" ) {
			echo "<strong>Action:</strong> Added";
			}
			else {
			echo "<strong>Action:</strong> Removed";
			}
			echo "<br />";
			echo "<strong>Issued by:</strong> {$array['issuedby']}";
			echo "<br />";
			echo "<strong>Date / Time:</strong> {$array['timestamp']}";
			echo "</div>";
			
			$i++;

		}
		?>		
</form>

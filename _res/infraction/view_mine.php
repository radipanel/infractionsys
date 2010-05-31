<?php
// Prevent the script from being called directly
if( !preg_match( "/index.php/i", $_SERVER['PHP_SELF'] ) ) { die(); }

// Require the functions.php file
require_once( "functions.php" );

// Declare $db and $user as a global
global $db;
global $user;

// Get their username
$myusername = $user->data['username'];

// Get their numbers of infractions and warnings
$totalInfractions = $db->query( "SELECT totalInfractions FROM users WHERE username='{$myusername}' LIMIT 1" );
$totalInfractions = mysql_result($totalInfractions,"totalInfractions");

$totalWarnings = $db->query( "SELECT totalWarnings FROM users WHERE username='{$myusername}' LIMIT 1" );
$totalWarnings = mysql_result($totalWarnings,"totalWarnings");
?>
<form action="" method="post" id="viewInfraction">

	<div class="box">

		<div class="square title">
			<strong>View My Infraction / Warning Log</strong>
		</div>

		<p>Current Infractions/Warnings:</p>
		<p>You have <strong><?php echo $totalInfractions; ?></strong> infractions.<br /> You have <strong><?php echo $totalWarnings; ?></strong> warnings.</p>
		<br />
		<?php
		$infraction_log = $db->query( "SELECT * FROM infraction_log WHERE username='{$myusername}'" );
		
		while( $array = $db->assoc( $infraction_log ) ) {
		
			echo "<div class=\"row {$i}\">";
			
			$array['type'] = ucwords( $array['type'] );
			
			
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
</div>
</form>


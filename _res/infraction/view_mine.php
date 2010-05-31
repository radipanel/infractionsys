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

		<p>Have you been good? Check out your current infraction / warning level here! Have none? Good!</p>
		<p>You currently have <strong><?php echo $totalInfractions; ?></strong> infractions and <strong><?php echo $totalWarnings; ?></strong> warnings</p>

		<?php
		$infraction_log = $db->query( "SELECT * FROM infraction_log WHERE username='{$myusername}'" );
		
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
</div>

<?php
// Prevent the script from being called directly
if( !preg_match( "/index.php/i", $_SERVER['PHP_SELF'] ) ) { die(); }

// Require the functions.php file
require_once( "functions.php" );
?>
<form action="" method="post" id="removeInfraction">

	<div class="box">

		<div class="square title">
			<strong>Remove Infraction / Warning From User</strong>
		</div>

		<?php
		// Check if the form has been submitted
		if( $_POST['submit'] ) {

			// Insert data into variables
			$username = $_POST['username'];

			// So, they've submitted the form, so we clean up some of the inputs
			$reason = $core->clean( $_POST['reason'] );
	
			// And then we figure out if they are removing an infraction or a warning
			if ( $_POST['type'] == "infraction" ) {
		
					// They are removing an infraction
					$infraction_remove = removeInfractionFromUser( $username, $reason );

					// Check if the process finished successfully
					switch ( $infraction_remove ) {
			
						case true:
							// It did
							$status = true;
							echo "<div class=\"square good\">";
							echo "<strong>Success</strong>";
							echo "<br />";
							echo "Infraction has been removed from user!";
							echo "</div>";
							break;
			
						case false:
							// It failed :(
							$status = false;
							echo "<div class=\"square bad\">";
							echo "<strong>Failure</strong>";
							echo "<br />";
							echo "The server encountered an error while processing your request.";
							echo "</div>";
							break;	
					}

			}
			else if ( $_POST['type'] == "warning" ) {

					// They are issuing an infraction
					$warning_remove = removeWarningFromUser( $username, $reason );
	
					// Check if the process finished successfully
					switch ( $warning_remove ) {
			
						case true:
							// It did
							$status = true;
							echo "<div class=\"square good\">";
							echo "<strong>Success</strong>";
							echo "<br />";
							echo "Warning has been removed from user!";
							echo "</div>";
							break;
			
						case false:
							// It failed :(
							$status = false;
							echo "<div class=\"square bad\">";
							echo "<strong>Failure</strong>";
							echo "<br />";
							echo "The server encountered an error while processing your request.";
							echo "</div>";
							break;		
					}
			}
	}
?>
		<p>Made a mistake? Remove any warning or infraction from a user here! Select the user, make an apology and click remove!</p>
		<table width="100%" cellpadding="3" cellspacing="0">

		<?php
		// First, we grab all the users
		$getUsers = $db->query( "SELECT * FROM users" );

		// Then use a while loop to create the array with it's values
		while( $array = $db->assoc( $getUsers ) ) {
					
				$users[$array['username']] = $array['username'];
					
		}

		echo $core->buildField( "select",
										"required",
										"username",
										"Username",
										"The user we wish to remove infraction from",
										$users);

		$opt_type = Array (
							"infraction" => "Infraction",
							"warning" => "Warning"
		);

		echo $core->buildField( "select",
										"required",
										"type",
										"Type",
										"Warning or infraction?",
										$opt_type );
		
		echo $core->buildField( "text",
										"required",
										"reason",
										"Reason",
										"It's always nice to give a reason",
										$data['reason'] );
		?>

		<input type="hidden" name="submitted" value="true" />

		</table>

		<div class="box" align="right">
			<input class="button" type="submit" name="submit" value="Submit" />
		</div>
</form>
<?php
echo $core->buildFormJS('removeInfraction');
?>

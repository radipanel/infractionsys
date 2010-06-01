<?php
// Prevent the script from being called directly
if( !preg_match( "/index.php/i", $_SERVER['PHP_SELF'] ) ) { die(); }

// Require the functions.php file
require_once( "functions.php" );

?>
<form action="" method="post" id="clearLog">

	<div class="box">

		<div class="square title">
			<strong>CLear Infraction Log</strong>
		</div>

		<?php
		// Check if the form has been submitted
		if( $_POST['submit'] ) {
			
			// First we check that they understood
			if ($_POST['understand'] == "Yes") {

				// First, we reset all the warning and infraction totals (but we don't modify their ban)
				$clean_slate = $db->query ( "UPDATE `users` SET totalWarnings = '0'; UPDATE `users` SET totalInfractions = '0'" );

				// Check if that executed properly
				if ( $clean_slate == true ) {

					// It has, so we continue. This is a very dangerous command that will remove all data from the table and reset the AUTO_INCREMENT
					$log_clear = $db->query( "TRUNCATE TABLE `infraction_log`" );
	
					// Check if the process finished successfully
							switch ( $log_clear ) {
				
								case true:
									// It did
									$status = true;
									echo "<div class=\"square good\">";
									echo "<strong>Success</strong>";
									echo "<br />";
									echo "Infraction log has been cleared";
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
				else {
					// It failed, so we deliver the bad news
					$status = false;
					echo "<div class=\"square bad\">";
					echo "<strong>Failure</strong>";
					echo "<br />";
					echo "The server encountered an error while processing your request.";
					echo "</div>";
					break;	
				}
			}
			else {
				// It failed, so we deliver the bad news
				$status = false;
				echo "<div class=\"square bad\">";
				echo "<strong>Failure</strong>";
				echo "<br />";
				echo "Please enter Yes to signify you understand.";
				echo "</div>";
				break;
			}
		}
		?>

		<p>This tool will clear your infraction log and reset all infraction / warning totals. <strong>This process cannot be reversed!</strong></p>
		<table width="100%" cellpadding="3" cellspacing="0">
		<?php
		echo $core->buildField( "text",
						"required",
						"understand",
						"Understand?",
						"Please enter Yes to proceed with process",
						$data['understand'] );
		?>
		</table>
	</div>
</form>
<?php
echo $core->buildFormJS('clearLog');
?>

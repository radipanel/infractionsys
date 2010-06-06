<?php
	// Include the glob.php file
	require_once( "../../_inc/glob.php" );

	// Declare $db as global
	global $db;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

	<head>

		<title>radiPanel: Infraction System Installer</title>

		<script type="text/javascript" src="../../_js/prototype.js"></script>
		<script type="text/javascript" src="../../_js/scriptaculous.js"></script>
		<script type="text/javascript" src="../../_js/validation.js"></script>
		<script type="text/javascript" src="../../_js/radi.js"></script>

		<style type="text/css" media="screen">@import url('../../_img/style.css');</style>		
		<style type="text/css" media="screen">
			
			#wrap {
			
				width: 600px;
				margin: auto;
			
			}
			
		</style>

	</head>

	<body>
	
	<div id="wrap">

		<?php

		// Now check if they've submitted the form, which is just a button O:)
		if ( $_POST['submit'] ) {

			$sql = file( "_inst_infraction.sql" );
								
			foreach( $sql as $sql_line ) {
		
				$query = $db->query( $sql_line );
			}

		// Done, tell them the good news
		echo "<div class=\"box\">";
		echo "<div class=\"square good\" style=\"margin-bottom: 0px;\">";
		echo "<strong>radiPanel: Infraction System Installed!</strong>";
		echo "<br />";
		echo "radiPanel: Infraction System has been successfully installed! Please delete the /_res/infraction/install.php file to ensure the security of your system.";
		echo "</div>";
		echo "</div>";
		}

		?>
		<form action="" method="post" id="installer">

		<div class="box">
	
			<div class="square title">
	
				<strong>radiPanel: Infraction System Installer</strong>

			</div>
	
			<div class="content">
	
				<p>
				Click the button below to install radiPanel: Infraction System!
				You are advised to <strong>take a backup before proceeding with installation.</strong>
				
				While every care has been taken to ensure the system is stable, the author cannot be held responsible for any loss, damage or destruction of data stored on your system 				through use of this extension. You have been warned!</p>

				<p><strong>To proceed, click Submit!</strong></p>

				<div class="box" align="right">
			
					<input class="button" type="submit" name="submit" value="Submit" />
			
				</div>
			</div>
		</div>
	
		</form>
	</div>

	</body>
</html>

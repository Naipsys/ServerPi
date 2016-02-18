<!DOCTYPE html>
<?php include('ServerPi/config.php'); ?>
<html>
	<head>
		<title><?php echo $TITLE; ?></title>
		<link rel="icon" href="ServerPi/images/favicon.png" type="image/x-ico">
		<link rel="stylesheet" href="ServerPi/theme.css" type="text/css">
		<?php 	$plugins_ref = fopen("ServerPi/plugins/plugins", "r");
			if ($plugins_ref) {
				while (!feof($plugins_ref)) {
					$buffer = fgets($plugins_ref);
					echo '<link rel="stylesheet" href="ServerPi/plugins/'. $buffer .'/style.css" type="text/css">';
				}
				fclose($plugins_ref);
			}
		?>
	</head>
	<body>
		<div id="logo"></div>
		<?php 	$plugins_ref = fopen("ServerPi/plugins/plugins", "r");
			if ($plugins_ref) {
				while (!feof($plugins_ref)) {
					$buffer = fgets($plugins_ref);
					include('ServerPi/plugins/'. $buffer .'/'. $buffer .'.php');
				}
				fclose($plugins_ref);
			}
		?>
		<div id="footer"><p><?php echo $REVISION; ?> - Made by Naipsys - 2016</p></div>
	</body>
</html>

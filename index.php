<!DOCTYPE html>
<?php include('ServerPi/config.php'); ?>
<html>
	<head>
		<title><?php echo $TITLE; ?></title>
		<link rel="icon" href="ServerPi/images/favicon.png" type="image/x-ico">
		<link rel="stylesheet" href="ServerPi/theme.css" type="text/css">
	</head>
	<body>
		<div id="logo"></div>
		<?php include('ServerPi/plugins/plugins.php'); ?>
		<div id="footer"><p><?php echo $REVISION; ?> - Made by Naipsys - 2016</p></div>
	</body>
</html>

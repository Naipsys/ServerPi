<!DOCTYPE html>
<?php include('ServerPi/config.php'); ?>
<html>
	<head>
		<title><?php echo $TITLE; ?></title>
		<link rel="icon" href="ServerPi/images/favicon.png" type="image/x-ico"/>
		<style><?php include('ServerPi/theme.php'); ?></style>
	</head>
	<body>
		<div id="logo"></div>
		<?php include('ServerPi/plugins/plugins.php'); ?>
		<div id="footer"><p><?php echo $REVISION; ?> - Made by Naipsys - 2016</p></div>
	</body>
</html>

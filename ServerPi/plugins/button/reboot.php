<!DOCTYPE html>
<html>
	<head>
		<title>Rebooting the system...</title>
		<link rel="icon" href="../../images/favicon.png" type="image/x-ico"/>
		<style>
			body {
				margin: 0 auto;
				font-family: Arial;
				background-image: url('../../images/bg.png');
			}

			#box {
				position:absolute;
				left: 50%;
				top: 50%;
				width: 400px;
				height: 50px;
				margin-top: -25px;
				margin-left: -200px;
   				background-color: #181818;
			}

			#box p {
				color: white;
				text-align: center;
			}

		</style>
	</head>
	<body>
		<div id="box">
			<p>The system is rebooting...</p>
		</div>
	</body>
</html>
<?php exec('bash -c "sleep 5; sudo reboot" > /dev/null &'); ?>
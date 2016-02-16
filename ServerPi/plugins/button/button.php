<div id="button">
	<a href="#">
		<div id="mount"><p>Mount</p></div>
	</a>
	<a href="">
		<div id="right"><p>Set right to all files</p></div>
	</a>
	<a href="ServerPi/plugins/button/reboot.php">
		<div id="reboot"><p>Reboot</p></div>
	</a>
	<div id="temp"><p><?php $temp = shell_exec('awk \'{printf("%.1f°C",$1/1e3)}\' /sys/class/thermal/thermal_zone0/temp'); echo $temp; ?></p></div>
</div>
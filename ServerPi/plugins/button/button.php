<div id="button">
	<a href="#">
		<div id="mount"><p>Mount /dev/sda1</p></div>
	</a>
	<a href="">
		<div id="right"><p>Chmod 777</p></div>
	</a>
	<a href="ServerPi/plugins/button/reboot.php">
		<div id="reboot"><p>Reboot</p></div>
	</a>
	<div id="temp"><p><?php $temp = shell_exec('awk \'{printf("%.1f°C",$1/1e3)}\' /sys/class/thermal/thermal_zone0/temp'); echo $temp; ?></p></div>
</div>
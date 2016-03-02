<?php
		# Language select
		include('languages/'. $LANGUAGE .'.php');
?>
<div id="button_box">
	<?php 
		$cmd = shell_exec('sudo fdisk -l | grep /dev/sd | tail -n 1 | cut -d " " -f 1');
		if ($cmd == "") {
			echo '<div class="nothing_to_mount"><p>'. $LANGUAGE_BUTTON['nothing_to_mount'] .'</p></div>';
		}
		else
		{
			if (is_dir($_SERVER['DOCUMENT_ROOT'] . '/usb/'))
			{
				echo '<a href="ServerPi/plugins/button/umount.php"><div class="umount"><p>'. $LANGUAGE_BUTTON['unmount'] .' '. $cmd . '</p></div></a>';
			}
			else
			{
				echo '<a href="ServerPi/plugins/button/mount.php"><div class="mount"><p>'. $LANGUAGE_BUTTON['mount'] .' '. $cmd . '</p></div></a>';
			}
		}
	?>
	<a href="ServerPi/plugins/button/reboot.php" onclick="return(confirm('Are you sure to reboot the system?'));">
		<div class="reboot"><p><?php echo $LANGUAGE_BUTTON['reboot']; ?></p></div>
	</a>
	<div class="temp" style="background-color: <?php $temp = shell_exec('awk \'{printf("%.1f",$1/1e3)}\' /sys/class/thermal/thermal_zone0/temp'); if($temp > 60) { echo '#f24f5a'; } elseif ($temp > 50) { echo '#e3a42c';} else { echo '#29d251'; } {
	}?>;">
		<p><?php echo shell_exec('awk \'{printf("%.1f°C",$1/1e3)}\' /sys/class/thermal/thermal_zone0/temp'); ?></p>
		</div>
</div>

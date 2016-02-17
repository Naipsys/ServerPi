<?php
	include('../../config.php');
	mkdir($ADRESS . '/usb/');
	exec('sudo /bin/mount ' . exec('sudo fdisk -l | grep /dev/sd | tail -n 1 | cut -d " " -f 1') . ' ' . $ADRESS . '/usb -o umask=000');
	header('Location: '. $URL);
	exit;
?>

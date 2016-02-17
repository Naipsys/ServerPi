<?php
	include('../../config.php');	
	exec('sudo /bin/umount ' . exec('sudo fdisk -l | grep /dev/sd | tail -n 1 | cut -d " " -f 1'));
	rmdir($_SERVER['DOCUMENT_ROOT'] . '/usb/');	
	header('Location: '. $URL);
	exit;
?>
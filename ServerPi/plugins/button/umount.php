<?php
	$ADRESS = 'http://192.168.1.150';
	exec('sudo /bin/umount ' . exec('sudo fdisk -l | grep /dev/sd | tail -n 1 | cut -d " " -f 1'));
	rmdir($_SERVER['DOCUMENT_ROOT'] . '/usb/');	
	header('Location: '. $ADRESS);
	exit;
?>
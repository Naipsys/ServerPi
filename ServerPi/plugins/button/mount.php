<?php
	$ADRESS = 'http://192.168.1.150';
	mkdir($_SERVER['DOCUMENT_ROOT'] . '/usb/');
	exec('sudo /bin/mount ' . exec('sudo fdisk -l | grep /dev/sd | tail -n 1 | cut -d " " -f 1') . ' ' . $_SERVER['DOCUMENT_ROOT'] . '/usb');
	header('Location: '. $ADRESS);
	exit;
?>
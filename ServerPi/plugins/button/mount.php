<?php
	include('../../config.php');
	mkdir($ADRESS . '/usb/');
	exec('sudo /bin/mount ' . exec('sudo fdisk -l | grep /dev/sd | tail -n 1 | cut -d " " -f 1') . ' ' . $_SERVER['DOCUMENT_ROOT'] . '/usb -o umask=000');
	header('Location: '. $URL);
	exit;
?>
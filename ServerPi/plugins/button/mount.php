<?php
	mkdir($_SERVER['DOCUMENT_ROOT'] . '/usb/');
	$cmd = 'sudo mount ' . urldecode($_GET['name']) . ' ' . $_SERVER['DOCUMENT_ROOT'] . '/usb/';
	echo $cmd;
	echo exec($cmd);
	header('Location : http://192.168.1.150/index.php');
?>
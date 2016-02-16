<?php
	shell_exec('sudo /sbin/umount ' . urldecode($_GET['name']));
	rmdir($_SERVER['DOCUMENT_ROOT'] . '/usb/');	
	header('Location : http://192.168.1.150/index.php');
?>
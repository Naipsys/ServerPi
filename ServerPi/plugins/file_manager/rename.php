<?php
	include('../../config.php');
	$path = $_POST['path'];
	$new_name = $_POST['new_name'];
	if (rename($path, dirname($path) . '/' . $new_name)) {
		$adress = $URL .'/index.php?dir='. urlencode(substr(dirname($adress), strlen($ADRESS) + 1) .'/') .'&notif='. urlencode('The rename operation works successfully.');
		header('Location: '. $adress);
		exit;
	}
?>

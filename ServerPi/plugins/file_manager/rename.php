<?php
	$path = $_POST['path'];
	$new_name = $_POST['new_name'];
	if (rename($path, dirname($path) . '/' . $new_name) {
		$adress = $URL .'/index.php?dir='. substr(dirname($path), strlen($ADRESS) + 1) .'/';
		header('Location: '. $adress);
		exit;
	}
?>

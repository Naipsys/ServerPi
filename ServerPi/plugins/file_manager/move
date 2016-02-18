<?php
	include('../../config.php');
	$path = $_POST['path'];
	$new_path = $_POST['new_path'];
	$dir_file_name = ($path, dirname($path);
	if (rename($path, $ADRESS . $new_path . $dir_file_name)) {
		$adress = $URL .'/index.php?dir='. substr(dirname($path), strlen($ADRESS) + 1) .'/';
		header('Location: '. $adress);
		exit;
	}
?>

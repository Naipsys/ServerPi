<?php
	include('../../config.php');
	$path = $_POST['path'];
	$new_path = $_POST['new_path'];
	$dir_file_name = substr($path, strlen(dirname($path)) + 1);
	if (rename($path, $ADRESS . $new_path . $dir_file_name)) {
		$adress = $URL .'/index.php?dir='. substr(dirname($path), strlen($ADRESS) + 1) .'/';
		header('Location: '. $adress);
		exit;
	}
	else {
		echo $ADRESS . '|' . $new_path . '|' . $dir_file_name;
	}
?>

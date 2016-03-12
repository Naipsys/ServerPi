<?php
	include('../../config.php');
	# Include all function
	include('includes/function.php');
	
	$path = $_POST['path'];
	$new_path = $_POST['new_path'];
	$dir_file_name = substr($path, strlen(dirname($path))+1);
	if (isset($_POST['move'])) {
		rename($path, dontEraseMe($ADRESS . $new_path . $dir_file_name));
	}
	else {
		if (is_file($path)) {
			copy($path, dontEraseMe($ADRESS . $new_path . $dir_file_name));
		}
		else {
			recurse_copy($path, dontEraseMe($ADRESS . $new_path . $dir_file_name));
		}
	}
	$adress = $URL .'/index.php?dir='. substr(dirname($path), strlen($ADRESS) + 1) .'/';
	header('Location: '. $adress);
	exit;
?>

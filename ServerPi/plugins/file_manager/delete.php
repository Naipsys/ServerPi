<?php
	include('../../config.php');
	# Include all function
	include('includes/function.php');

	$adress = $_POST['path'];
	if (is_file($adress)) {
		if (unlink($adress)) {
		$adress = $URL .'/index.php?dir='. urlencode(substr(dirname($adress), strlen($ADRESS) + 1) .'/') .'&notif='. urlencode('The file have been deleted successfully.');
		header('Location: ' . $adress); 
		exit;
		}
		else { 
			$adress = $URL .'/index.php?dir='. urlencode(substr(dirname($adress), strlen($ADRESS) + 1) .'/') .'&notif='. urlencode('Error d1.');
			header('Location: '. $adress);
			exit; 
		}
	}
	else {
		rrmdir($adress);
		$adress = $URL .'/index.php?dir='. urlencode(substr(dirname($adress), strlen($ADRESS) + 1) .'/') .'&notif='. urlencode('The directory have been deleted successfully.');
		header('Location: '. $adress);
		exit;
	}
?>

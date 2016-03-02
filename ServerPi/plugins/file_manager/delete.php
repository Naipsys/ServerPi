<?php
	include('../../config.php');
	// function found here : http://php.net/manual/en/function.rmdir.php#98622
	function rrmdir($dir) { 
		if (is_dir($dir)) { 
			$objects = scandir($dir); 
			foreach ($objects as $object) { 
				if ($object != "." && $object != "..") { 
		 			if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
				} 
			} 
			reset($objects); 
			rmdir($dir); 
   		} 
	} 

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

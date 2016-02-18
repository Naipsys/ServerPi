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
		$adress = $URL .'/index.php?dir='. substr(dirname($adress), strlen($ADRESS) + 1) .'/';
		header('Location: ' . $adress); 
		exit;
		}
		else { echo 'Error : 100. Path : ' .$adress; }
	}
	else {
		rrmdir($adress);
		$adress = $URL .'/index.php?dir='. substr(dirname($adress), strlen($ADRESS) + 1) .'/';
		header('Location: '. $adress);
		exit;
	}
?>
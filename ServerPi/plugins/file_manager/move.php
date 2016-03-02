<?php
	// fuction found here : http://php.net/manual/fr/function.copy.php#91010
	function recurse_copy($src,$dst) { 
	    $dir = opendir($src); 
	    @mkdir($dst); 
	    while(false !== ( $file = readdir($dir)) ) { 
	        if (( $file != '.' ) && ( $file != '..' )) { 
	            if ( is_dir($src . '/' . $file) ) { 
	                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
	            } 
	            else { 
	                copy($src . '/' . $file,$dst . '/' . $file); 
	            } 
	        } 
	    } 
	    closedir($dir); 
	} 

	function dontEraseMe($path_to_secure) {
		$nb = 1;
		$new_path_secure = $path_to_secure;
		while (file_exists($new_path_secure)) {
			$new_path_secure = $path_to_secure .'.'. $nb;
			$nb++;
		}
		return $new_path_secure;
	}

	include('../../config.php');
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

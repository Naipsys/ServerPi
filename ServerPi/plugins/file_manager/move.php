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

	include('../../config.php');
	$path = $_POST['path'];
	$new_path = $_POST['new_path'];
	$dir_file_name = substr($path, strlen(dirname($path))+1);
	if (isset($_POST['move'])) {
		rename($path, $ADRESS . $new_path . $dir_file_name);
		echo 'rename<br>'. $ADRESS . $new_path . $dir_file_name . '<br>' . $path;
	}
	else {
		if (is_file($path)) {
			copy($path, $ADRESS . $new_path . $dir_file_name);
		}
		else {
			recurse_copy($path);
		}
	}
	$adress = $URL .'/index.php?dir='. substr(dirname($path), strlen($ADRESS) + 1) .'/';
	header('Location: '. $adress);
	exit;
?>
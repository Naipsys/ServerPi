<?php 
	function dontEraseMe($path_to_secure) {
		$nb = 1;
		$new_path_secure = $path_to_secure;
		while (file_exists($new_path_secure)) {
			$new_path_secure = $path_to_secure .'.'. $nb;
			$nb++;
		}
		return $new_path_secure;
	}

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

	// function found here : http://stackoverflow.com/questions/5501451/php-x86-how-to-get-filesize-of-2-gb-file-without-external-program/5504829#5504829
	function filesize64($file) {
		static $iswin;
		if (!isset($iswin)) {
			$iswin = (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN');
		}

		static $exec_works;
		if (!isset($exec_works)) {
			$exec_works = (function_exists('exec') && !ini_get('safe_mode') && @exec('echo EXEC') == 'EXEC');
		}

		// try a shell command
		if ($exec_works) {
			$cmd = ($iswin) ? "for %F in (\"$file\") do @echo %~zF" : "stat -c%s \"$file\"";
			@exec($cmd, $output);
			if (is_array($output) && ctype_digit($size = trim(implode("\n", $output)))) {
				return $size;
			}
		}
		return filesize($file);
	}

	// filesize_char : give a readable size of a file.
	function filesize_char($file) {
		$size = filesize64($file);
		if ($size > pow(2,40)) {
			return round(filesize64($file)/pow(2,40),2) . 'TB';
		}
		elseif ($size > pow(2,30)) {
			return round(filesize64($file)/pow(2,30),2) . 'GB';
		}
		elseif ($size > pow(2,20)) {
			return round(filesize64($file)/pow(2,20),2) . 'MB';
		}
		elseif ($size > pow(2,10)) {
			return round(filesize64($file)/pow(2,10),2) . 'kB';
		}
		else {
			return round(filesize64($file),2) . 'B';
	}
}
?>
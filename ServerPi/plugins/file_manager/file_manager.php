<?php
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
	
	$accordion_nb = 1;
	$dir = "./" . $_GET["dir"];
	// Test if the directory exist.
	if (is_dir($dir)) {
		echo '<div id="file_manager_box"><table>';
		if ($_GET["dir"] == '' || $_GET["dir"] == "./" || $_GET["dir"] == "/") { 
			echo '<tr class="legend"><th>Name - /</th><th>Size</th><th width=10></th></tr>';
		}
		elseif (dirname($_GET["dir"]) == '.') { 
			echo '<tr class="legend"><th>Name - /'. $_GET["dir"] .'</th><th>Size</th><th width=10></th></tr>';
			echo '<tr class="odd"><td><a href="?dir=">..</a></td><td WIDTH=81>-</td><td width=10></td></tr>';
			$accordion_nb++;
		} 
		else { 
			echo '<tr class="legend"><th>Name - /'. $_GET["dir"] .'</th><th>Size</th><th width=10></th></tr>';
			echo '<tr class="odd"><td><a href="?dir='. dirname($_GET["dir"]) .'/">..</a></td><td WIDTH=81>-</td><td width=10></td></tr>'; 
			$accordion_nb++;
		}
		if ($dir_opened = opendir($dir)) {
			while (($file = readdir($dir_opened)) !== false) {
				if( $file != '.' && $file != '..' && $file != 'index.php' && $file != 'ServerPi') {
					if(filetype($dir . $file) == "dir") {
						// echo '<tr><td><a href="?dir='. $_GET["dir"] . $file .'/">' . $file . '/</a></td><td WIDTH=81>-</td><td width=10><a title="Remove this dir" href="ServerPi/plugins/file_manager/remove.php?adress='. urlencode(dirname(dirname(dirname(__DIR__))) . '/' . $_GET["dir"] . $file) .'/" onclick="return(confirm(\'Are you sure to delete this directory ?\'));">×</a></td></tr>';
						if ($accordion_nb%2 == 1) {
							echo '<tr class="odd"><td><a href="?dir='. $_GET["dir"] . $file .'/">' . $file . '/</a></td><td WIDTH=81>-</td><td width=10><a href="#'. $accordion_nb .'accordion">&#x2807;</a></td></tr>';
						}
						else {
							echo '<tr class="even"><td><a href="?dir='. $_GET["dir"] . $file .'/">' . $file . '/</a></td><td WIDTH=81>-</td><td width=10><a href="#'. $accordion_nb .'accordion">&#x2807;</a></td></tr>';
						}
						
						echo '<tr id="'. $accordion_nb .'accordion" class="accordion"><td colspan=3 width=800>
								<form class="rename" action="ServerPi/plugins/file_manager/rename.php" method="post">
								<input type="text" name="new_name">
								<input type="submit" name="submit" value="Rename">
								</form>
								<form class="move" action="ServerPi/plugins/file_manager/rename.php" method="post">
								<input type="text" name="path">
								<input type="submit" name="submit" value="Move">
								</form>
								<div class="delete">
								<a href="ServerPi/plugins/file_manager/delete.php">Delete</a>
								</div>
							</td></tr>';
						$accordion_nb++;
					}
					else {
						$size = filesize_char($ADRESS . '/' . $_GET["dir"] . $file);
						//echo '<tr><td><a href="' .$_GET["dir"]. $file . '">' . $file . '</a></td><td WIDTH=81>'. $size . '</td><td width=10><a title="Remove this file" href="ServerPi/plugins/file_manager/remove.php?adress='. urlencode(dirname(dirname(dirname(__DIR__))) . '/' . $_GET["dir"] . $file) . '" onclick="return(confirm(\'Are you sure to delete this file ?\'));">×</a></td></tr>';
						if ($accordion_nb%2 == 1) {
							echo '<tr class="odd"><td><a href="' .$_GET["dir"]. $file . '">' . $file . '</a></td><td WIDTH=81>'. $size . '</td><td width=10><a href="#'. $accordion_nb .'accordion">&#x2807;</a></td></tr>';
						}
						else {
							echo '<tr class="even"><td><a href="' .$_GET["dir"]. $file . '">' . $file . '</a></td><td WIDTH=81>'. $size . '</td><td width=10><a href="#'. $accordion_nb .'accordion">&#x2807;</a></td></tr>';
						}
						echo '<tr id="'. $accordion_nb .'accordion" class="accordion"><td colspan=3 width=800>
								<form class="rename" action="ServerPi/plugins/file_manager/rename.php" method="post">
								<input type="text" name="new_name">
								<input type="submit" name="submit" value="Rename">
								</form>
								<form class="move" action="ServerPi/plugins/file_manager/rename.php" method="post">
								<input type="text" name="path">
								<input type="submit" name="submit" value="Move">
								</form>
								<div class="delete">
								<a href="ServerPi/plugins/file_manager/delete.php">Delete</a>
								</div>
							</td></tr>';
						$accordion_nb++;
					}
				}
			}
			closedir($dir_opened);
			echo '</table></div>';
		}
	}
	else {
		echo '<div id="file_manager_box"><table><tr><th>Dossier introuvable</th></tr></table></div>';
	}
?>

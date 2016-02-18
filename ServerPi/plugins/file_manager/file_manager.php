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
	$decode = urldecode($_GET["dir"]);
	$dir = "./". $decode;
	// Test if the directory exist.
	if (is_dir($dir)) {
		echo '<div id="file_manager_box"><table><col width=709><col width=81><col width=10><tbody>';
		if ($decode == '' || $decode == "./" || $decode == "/") { 
			echo '<tr class="legend"><th>Name - /</th><th>Size</th><th></th></tr>';
			$decode = "";
		}
		elseif (dirname($decode) == '.') { 
			echo '<tr class="legend"><th>Name - /'. $decode .'</th><th>Size</th><th></th></tr>';
			echo '<tr class="odd"><td><a href="?dir=">..</a></td><td>-</td><td></td></tr>';
			$accordion_nb++;
		} 
		else { 
			echo '<tr class="legend"><th>Name - /'. $decode .'</th><th>Size</th><th></th></tr>';
			echo '<tr class="odd"><td><a href="?dir='. urlencode(dirname($decode).'/') .'">..</a></td><td>-</td><td width=10></td></tr>'; 
			$accordion_nb++;
		}
		if ($dir_opened = opendir($dir)) {
			while (($file = readdir($dir_opened)) !== false) {
				if( $file != '.' && $file != '..' && $file != 'index.php' && $file != 'ServerPi') {
					if(filetype($dir . $file) == "dir") {
						// echo '<tr><td><a href="?dir='. $_GET["dir"] . $file .'/">' . $file . '/</a></td><td WIDTH=81>-</td><td width=10><a title="Remove this dir" href="ServerPi/plugins/file_manager/remove.php?adress='. urlencode(dirname(dirname(dirname(__DIR__))) . '/' . $_GET["dir"] . $file) .'/" onclick="return(confirm(\'Are you sure to delete this directory ?\'));">×</a></td></tr>';
						if ($accordion_nb%2 == 1) {
							echo '<tr class="odd"><td><a href="?dir='. urlencode($decode . $file .'/') .'">' . $file . '/</a></td><td>-</td><td><a href="#'. $accordion_nb .'a">&#x2807;</a></td></tr>';
						}
						else {
							echo '<tr class="even"><td><a href="?dir='. urlencode($decode . $file .'/') .'">' . $file . '/</a></td><td>-</td><td><a href="#'. $accordion_nb .'a">&#x2807;</a></td></tr>';
						}
						echo '<tr id="'. $accordion_nb .'a" class="accordion"><td width=800>
								<form class="rename" action="ServerPi/plugins/file_manager/rename.php" method="post">
								<input type="text" name="new_name">
								<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode . $file .'/">
								<input type="submit" name="submit" value="Rename">
								</form>
								<form class="move" action="ServerPi/plugins/file_manager/move.php" method="post">
								<input type="text" name="new_path">
								<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode . $file .'/">
								<input type="submit" name="submit" value="Move">
								</form>
								<form class="delete" action="ServerPi/plugins/file_manager/delete.php" method="post">
								<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode . $file .'/">
								<input type="submit" name="submit" value="Delete">
								</form>
								</td>
							</tr>';
						$accordion_nb++;
					}
					else {
						$size = filesize_char($ADRESS . '/' . $decode . $file);
						//echo '<tr><td><a href="' .$_GET["dir"]. $file . '">' . $file . '</a></td><td WIDTH=81>'. $size . '</td><td width=10><a title="Remove this file" href="ServerPi/plugins/file_manager/remove.php?adress='. urlencode(dirname(dirname(dirname(__DIR__))) . '/' . $_GET["dir"] . $file) . '" onclick="return(confirm(\'Are you sure to delete this file ?\'));">×</a></td></tr>';
						if ($accordion_nb%2 == 1) {
							echo '<tr class="odd"><td><a href="'. $decode . $file . '">' . $file . '</a></td><td>'. $size . '</td><td><a href="#'. $accordion_nb .'a">&#x2807;</a></td></tr>';
						}
						else {
							echo '<tr class="even"><td><a href="'. $decode . $file . '">' . $file . '</a></td><td>'. $size . '</td><td><a href="#'. $accordion_nb .'a">&#x2807;</a></td></tr>';
						}
						echo '<tr id="'. $accordion_nb .'a" class="accordion"><td width=800>
								<form class="rename" action="ServerPi/plugins/file_manager/rename.php" method="post">
								<input type="text" name="new_name">
								<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode . $file .'">
								<input type="submit" name="submit" value="Rename">
								</form>
								<form class="move" action="ServerPi/plugins/file_manager/move.php" method="post">
								<input type="text" name="new_path">
								<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode . $file .'">
								<input type="submit" name="submit" value="Move">
								</form>
								<form class="delete" action="ServerPi/plugins/file_manager/delete.php" method="post">
								<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode . $file .'">
								<input type="submit" name="submit" value="Delete">
								</form>
								</td>
							</tr>';
						$accordion_nb++;
					}
				}
			}
			closedir($dir_opened);
			echo '</tbody></table></div>';
		}
	}
	else {
		echo '<div id="file_manager_box"><table><tr><th>Dossier introuvable</th></tr></table></div>';
	}
?>

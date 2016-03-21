<?php

	# Language select
	include('languages/'. $LANGUAGE .'.php');
	# Include all function
	include('includes/function.php');

	$accordion_nb = 1;
	$decode = urldecode($_GET["dir"]);
	$dir = "./". $decode;
	// Test if the directory exist.
	if (is_dir($dir)) {
		echo '<div id="file_manager_box"><table><col width=709><col width=81><col width=10><tbody>';
		if ($decode == '' || $decode == "./" || $decode == "/") { 
			echo '<tr class="legend"><th>'. $LANGUAGE_FILE_MANAGER['name'] .' - /</th><th>'. $LANGUAGE_FILE_MANAGER['size'] .'</th><th></th></tr>';
			$decode = "";
			echo '<tr><td colspan="3" class="new_tr"><form class="new" action="ServerPi/plugins/file_manager/new.php" method="post">
						<input type="submit" name="file" value="'. $LANGUAGE_FILE_MANAGER['new_file'] .'">
						<input type="submit" name="dir" value="'. $LANGUAGE_FILE_MANAGER['new_dir'] .'">
						<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode .'">
					</form></td></tr>';
		}
		elseif (dirname($decode) == '.') { 
			echo '<tr class="legend"><th>'. $LANGUAGE_FILE_MANAGER['name'] .' - /'. $decode .'</th><th>'. $LANGUAGE_FILE_MANAGER['size'] .'</th><th></th></tr>';
			echo '<tr><td colspan="3" class="new_tr"><form class="new" action="ServerPi/plugins/file_manager/new.php" method="post">
						<input type="submit" name="file" value="'. $LANGUAGE_FILE_MANAGER['new_file'] .'">
						<input type="submit" name="dir" value="'. $LANGUAGE_FILE_MANAGER['new_dir'] .'">
						<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode .'">
					</form></td></tr>';
			echo '<tr class="odd"><td><a href="?dir=">..</a></td><td>-</td><td></td></tr>';
			$accordion_nb++;
		} 
		else { 
			echo '<tr class="legend"><th>'. $LANGUAGE_FILE_MANAGER['name'] .' - /'. $decode .'</th><th>'. $LANGUAGE_FILE_MANAGER['size'] .'</th><th></th></tr>';
			echo '<tr><td colspan="3" class="new_tr"><form class="new" action="ServerPi/plugins/file_manager/new.php" method="post">
						<input type="submit" name="file" value="'. $LANGUAGE_FILE_MANAGER['new_file'] .'">
						<input type="submit" name="dir" value="'. $LANGUAGE_FILE_MANAGER['new_dir'] .'">
						<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode .'">
					</form></td></tr>';
			echo '<tr class="odd"><td><a href="?dir='. urlencode(dirname($decode).'/') .'">..</a></td><td>-</td><td width=10></td></tr>'; 
			$accordion_nb++;
		}
		if ($dir_opened = opendir($dir)) {
			while (($file = readdir($dir_opened)) !== false) {
				if( $file != '.' && $file != '..' && $file != 'index.php' && $file != 'ServerPi') {
					if(filetype($dir . $file) == "dir") {
						if ($accordion_nb%2 == 1) {
							echo '<tr class="odd"><td><a href="?dir='. urlencode($decode . $file .'/') .'">' . $file . '/</a></td><td>-</td><td><a href="#'. $accordion_nb .'a">&#x2807;</a></td></tr>';
						}
						else {
							echo '<tr class="even"><td><a href="?dir='. urlencode($decode . $file .'/') .'">' . $file . '/</a></td><td>-</td><td><a href="#'. $accordion_nb .'a">&#x2807;</a></td></tr>';
						}
						echo 	'<tr id="'. $accordion_nb .'a" class="accordion">
									<td class="container" colspan="3">
										<form class="rename" action="ServerPi/plugins/file_manager/rename.php" method="post" onsubmit="return(confirm(\'Are you sure to rename this directory?\'));">
											<input type="text" name="new_name" placeholder="New name">
											<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode . $file .'/">
											<input type="submit" name="submit" value="'. $LANGUAGE_FILE_MANAGER['rename'] .'">
										</form>
										<form class="move" action="ServerPi/plugins/file_manager/move.php" method="post" onsubmit="return(confirm(\'Are you sure to move/copy this directory?\'));">
											<input type="text" name="new_path" placeholder="Ex: /dir/">
											<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode . $file .'/">
											<input type="submit" name="move" value="'. $LANGUAGE_FILE_MANAGER['move'] .'"><input type="submit" name="copy" value="'. $LANGUAGE_FILE_MANAGER['copy'] .'">
										</form>
										<form class="delete" action="ServerPi/plugins/file_manager/delete.php" method="post" onsubmit="return(confirm(\'Are you sure to delete this directory?\'));" >
											<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode . $file .'/">
											<input type="submit" name="submit" value="'. $LANGUAGE_FILE_MANAGER['delete'] .'">
										</form>
										<form class="close" action="#">
											<input type="hidden" name="dir" value="'. urlencode($decode) .'">
											<input type="submit" name="submit" value="'. $LANGUAGE_FILE_MANAGER['close'] .'">
										</form>
									</td>
								</tr>';
						$accordion_nb++;
					}
					else {
						$size = filesize_char($ADRESS . '/' . $decode . $file);
						if ($accordion_nb%2 == 1) {
							echo '<tr class="odd"><td><a href="'. $decode . $file . '">' . $file . '</a></td><td>'. $size . '</td><td><a href="#'. $accordion_nb .'a">&#x2807;</a></td></tr>';
						}
						else {
							echo '<tr class="even"><td><a href="'. $decode . $file . '">' . $file . '</a></td><td>'. $size . '</td><td><a href="#'. $accordion_nb .'a">&#x2807;</a></td></tr>';
						}
						echo 	'<tr id="'. $accordion_nb .'a" class="accordion">
									<td class="container" colspan="3">
										<form class="rename" action="ServerPi/plugins/file_manager/rename.php" method="post" onsubmit="return(confirm(\'Are you sure to rename this file?\'));">
											<input type="text" name="new_name" placeholder="'. $LANGUAGE_FILE_MANAGER['new_name'] .'">
											<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode . $file .'">
											<input type="submit" name="submit" value="'. $LANGUAGE_FILE_MANAGER['rename'] .'">
										</form>
											<form class="move" action="ServerPi/plugins/file_manager/move.php" method="post" onsubmit="return(confirm(\'Are you sure to move/copy this file?\'));">
											<input type="text" name="new_path" placeholder="Ex: /dir/">
											<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode . $file .'">
											<input type="submit" name="move" value="'. $LANGUAGE_FILE_MANAGER['move'] .'"><input type="submit" name="copy" value="'. $LANGUAGE_FILE_MANAGER['copy'] .'">
										</form>
											<form class="delete" action="ServerPi/plugins/file_manager/delete.php" method="post" onsubmit="return(confirm(\'Are you sure to delete this file?\'));">
											<input type="hidden" name="path" value="'. $ADRESS . '/' . $decode . $file .'">
											<input type="submit" name="submit" value="'. $LANGUAGE_FILE_MANAGER['delete'] .'">
										</form>
										<form class="close" action="#">
											<input type="hidden" name="dir" value="'. urlencode($decode) .'">
											<input type="submit" name="submit" value="'. $LANGUAGE_FILE_MANAGER['close'] .'">
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
		echo '<div id="file_manager_box"><table><tr><th>'. $LANGUAGE_FILE_MANAGER['error_directory'] .'</th></tr></table></div>';
	}
?>

<?php 

	include('../../config.php');
	# Include all function
	include('includes/function.php');

	if (isset($_POST['dir'])) {
		mkdir(dontEraseMe($_POST['path'] . 'directory'));	
		$adress = $URL .'/index.php?dir='. urlencode(substr($_POST['path'], strlen($ADRESS) + 1) .'/') .'&notif='. urlencode('New directory created !');
		header('Location: '. $adress);
		exit;
	}
	else {
		touch(dontEraseMe($_POST['path'] . 'file'));
		$adress = $URL .'/index.php?dir='. urlencode(substr($_POST['path'], strlen($ADRESS) + 1) .'/') .'&notif='. urlencode('New file created !');
		header('Location: '. $adress);
		exit;
	}

?>
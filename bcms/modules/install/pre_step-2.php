<?php
	
	$zip = new ZipArchive;
	if ($zip->open('install.zip') === TRUE) {
		$zip->extractTo('.');
		$zip->close();
		$message='ok';
	} else {
		$message='failed';
	}

$message="Install BCMSD Step 2.";
?>
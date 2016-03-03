<?php
	$pagTitle = "Recibir Mensaje";
	include 'header.php';	
	include 'reciveMessage.php';
	foreach ($messages as $m) {
	    	echo "<hr/>$m";
	}
	include 'footer.php';
?>
<?php
	$pagTitle = "Recibir Mensaje";
	include 'header.php';	
	include 'ReciveMessage.php';
	foreach ($messages as $me) {
	    	echo "<hr/>$me";
	}
	include 'footer.php';
?>
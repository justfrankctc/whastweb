<?php 
	require_once __DIR__.'/../src/whatsprot.class.php';
	require_once __DIR__.'/../src//events/MyEvents.php';
	
	$username = '5215585296369';
	$password = "xJyTr/9j6DVAqaH40L5UowkoLro=";
	$nickname = 'TOTAL PLAY';
	$target = "5215525611806";
	$messages = array();
	
	$debug = false;

    set_time_limit(10);
	require_once __DIR__.'/../src/whatsprot.class.php';
	require_once __DIR__.'/../src//events/MyEvents.php';
	
	//Change the time zone if you are in a different country
	date_default_timezone_set('America/Mexico_City');

	// Nos conectamos a la red de WhatsApps			
	$w = new WhatsProt($username, $nickname, $debug);
	$w->connect(); 
	$w->loginWithPassword($password); 
		
	// Enviamos nuestra configuración al servidor
	$w->sendGetServerProperties(); // Obtenemos las propiedades delservidor
	$w->sendClientConfig(); // Enviamos nuestra configuración al servidor
	
	// Sincronizamos el contacto
	$sync = [$target];
	$w->sendSync($sync); 

	// inicializamos el apuntador	
	$i=0;
	
	$w->pollMessage();
	
	$msgs = $w->getMessages();
	// $pn->process($w);	
	
	foreach ($msgs as $m) {
		$i++;	    	
		$from_number = $m->getAttribute("from");
		$from_nickname = $m->getAttribute("notify");
		$msg = $m->NodeString();
		$messages[$i]=$msg;   
	}

	foreach ($messages as $me) {
		echo "<hr/>$me";
	}  
    $w->disconnect();
?>
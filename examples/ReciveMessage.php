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
	
	// Se configura la hora local
	date_default_timezone_set('America/Mexico_City');

	// Nos conectamos a la red de WhatsApp
	$w = new WhatsProt($username, $nickname, $debug);
	$w->connect(); 
	$w->loginWithPassword($password); 
	
	// Obtenemos las propiedades del servidor
	// Enviamos nuestra configuración al servidor
	$w->sendGetServerProperties();
	$w->sendClientConfig(); 
	$i = 0;
	foreach ($msgs as $m) {
	    // echo $m->NodeString("");	    	
	    $from_number = $m->getAttribute("from");
		   $from_nickname = $m->getAttribute("notify");
		   $msg = $m->NodeString('Mensaje $i');
		$messages[$i] = $msg;    
	}
	include_once "https://c.cs50.visual.force.com/apex/waRecibeMensaje?core.apexpages.request.devconsole=1?&messages=$messages";
?>		
<?php 
	$username = '5215585296369';
	$password = "xJyTr/9j6DVAqaH40L5UowkoLro=";
	$nickname = 'TOTAL PLAY';
	$target = "5215525611806";
	
	$debug = false;
    set_time_limit(10);
	require_once __DIR__.'/../src/whatsprot.class.php';
	require_once __DIR__.'/../src//events/MyEvents.php';
	
	//Change the time zone if you are in a different country
	date_default_timezone_set('America/Mexico_City');

	// echo "<div class='dataOutput'>Logging in as '$nickname' ($username)</div>";
	function onGetMessage( $mynumber, $from, $id, $type, $time, $name, $body ){
    echo "Message from $name:\n$body\n\n";
    }

	// Nos conectamos a la red de WhatsApp
	try {
		
		$w = new WhatsProt($username, $nickname, $debug);
		$w->connect(); 
		$w->loginWithPassword($password); 
		// echo "<br/><div class='dataOutput'>Connected to WhatsApp</div>";
	} catch (Exception $e) {
		// echo "<br/><div class='alert'>LoginWithPassword fail: $e</div>";
	}

	// Obtenemos las propiedades del servidor
	// Enviamos nuestra configuración al servidor
	try {
		$w->sendGetServerProperties();
		$w->sendClientConfig(); 
		// echo "<br/><div class='dataOutput'>Server config successful</div>";
	} catch (Exception $e) {
		// echo "<br/><div class='alert'>Server config fail: $e</div>";
	}

	// Sincronizamos el contacto
	try {
		$sync = [$target];
		$w->sendSync($sync); 
		// echo "<br/><div class='dataOutput'>target synced/div>";
	} catch (Exception $e) {
		// echo "<br/><div class='alert'>target sync fail: $e</div>";
	}

	try {
		$w->pollMessage();
		$msgs = $w->getMessages();
		// $pn->process($w);	
		foreach ($msgs as $m) {
	    	// echo $m->NodeString("");	    	
	    	$from_number = $m->getAttribute("from");
		    $from_nickname = $m->getAttribute("notify");
		    $msg = $m->NodeString();
		    // $msg = $msg->getData();
		    // if ($m->getAttribute("type") == "text") {
		    // 	$body = $m->getChild("children");
		    // 	// $msg = $body->getData();


		    // } else {
		    //     $msg = $m->getChild("media")->getAttribute("url");
		    // }
		    echo "New Message from $from_number($from_nickname): <br/> $msg";
	    	echo "<hr/>";
	    }  
    } catch (Exception $e) {
			// echo "<br/><div class='dataOutput'>Reading fail: $e</div>";
	}	
?>		
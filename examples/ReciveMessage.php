<?php 
	$username = '5215585296369';
	$password = '';
	$nickname = 'TOTAL PLAY';
	$target = "5215525611806";
	
	$debug = false;
    set_time_limit(10);
	require_once __DIR__.'/../src/whatsprot.class.php';
	require_once __DIR__.'/../src//events/MyEvents.php';
	
	//Change the time zone if you are in a different country
	date_default_timezone_set('America/Mexico_City');

	echo "<div class='dataOutput'>Logging in as '$nickname' ($username)</div>";

	// Nos conectamos a la red de WhatsApp
	try {
		
		$w = new WhatsProt($username, $nickname, $debug);

		$w->eventManager()->bind('onPresenceAvailable', 'onPresenceAvailable');
		$w->eventManager()->bind('onPresenceUnavailable', 'onPresenceUnavailable');

		$w->connect(); 
		$w->loginWithPassword($password); 
		echo "<br/><div class='dataOutput'>Connected to WhatsApp</div>";
	} catch (Exception $e) {
		echo "<br/><div class='alert'>LoginWithPassword fail: $e</div>";
	}

	// Obtenemos las propiedades del servidor
	// Enviamos nuestra configuración al servidor
	try {
		$w->sendGetServerProperties();
		$w->sendClientConfig(); 
		echo "<br/><div class='dataOutput'>Server config successful</div>";
	} catch (Exception $e) {
		echo "<br/><div class='alert'>Server config fail: $e</div>";
	}

	// Sincronizamos el contacto
	try {
		$sync = [$target];
		$w->sendSync($sync); 
		echo "<br/><div class='dataOutput'>target synced/div>";
	} catch (Exception $e) {
		echo "<br/><div class='alert'>target sync fail: $e</div>";
	}


	// Volvemos a poner en cola mensajes
	// Nos suscribimos a la presencia del usuario
	try {
		$w->pollMessage(); 
		$w->sendPresenceSubscription($target); 
		echo "<br/><div class='dataOutput'>polled Message</div>";
	} catch (Exception $e) {
		echo "<br/><div class='alert'>poll Message fail: $e</div>";
		
	try {
			$pn = new ProcessNode($w, $target);
			$w->setNewMessageBind($pn);
			echo "<br/><div class='dataOutput'>Reading Message</div>";	
			$pn->process($w);	
		} catch (Exception $e) {
			echo "<br/><div class='dataOutput'>Reading fail: $e</div>";
		}	

	class ProcessNode
	{
	    protected $wp = false;
	    protected $target = false;

	    public function __construct($wp, $target)
	    {
	        $this->wp = $wp;
	        $this->target = $target;
	    }

	    public function process($node)
	    {
	        $text = $node->getChild('body');
	        $text = $text->getData();
	        $notify = $node->getAttribute('notify');

	        echo "\n- ".$notify.': '.$text.'    '.date('H:i')."\n";
	    }
	}

?>		
<?php
set_time_limit(10);
    require_once __DIR__.'/../src/whatsprot.class.php';
    require_once __DIR__.'/../src//events/MyEvents.php';

//Change the time zone if you are in a different country
date_default_timezone_set('America/Mexico_City');

////////////////CONFIGURATION///////////////////////
////////////////////////////////////////////////////
$username = "5215585296369";
$password = "xJyTr/9j6DVAqaH40L5UowkoLro=";
$nickname = 'Total Play';
$debug = false;
$target = "5215525611806";

function onPresenceAvailable($username, $from)
{
    $dFrom = str_replace(['@s.whatsapp.net', '@g.us'], '', $from);
    echo "<$dFrom is online>\n\n";
}

function onPresenceUnavailable($username, $from, $last)
{
    $dFrom = str_replace(['@s.whatsapp.net', '@g.us'], '', $from);
    echo "<$dFrom is offline>\n\n";
}

echo "<br/><div class='dataOutput'>[] Logging in as '$nickname' ($username)</div>\n";
$w = new WhatsProt($username, $nickname, $debug);

$w->eventManager()->bind('onPresenceAvailable', 'onPresenceAvailable');
$w->eventManager()->bind('onPresenceUnavailable', 'onPresenceUnavailable');

$w->connect(); // Nos conectamos a la red de WhatsApp
$w->loginWithPassword($password); // Iniciamos sesion con nuestra contraseña
echo "[*]Conectado a WhatsApp\n\n";
$w->sendGetServerProperties(); // Obtenemos las propiedades del servidor
$w->sendClientConfig(); // Enviamos nuestra configuración al servidor
$sync = [$target];
$w->sendSync($sync); // Sincronizamos el contacto
$w->pollMessage(); // Volvemos a poner en cola mensajes
$w->sendPresenceSubscription($target); // Nos suscribimos a la presencia del usuario

$pn = new ProcessNode($w, $target);
$w->setNewMessageBind($pn);

// while (1) {
    $w->pollMessage();
    $msgs = $w->getMessages();
    foreach ($msgs as $m) {
        // process inbound messages
        // echo $m->NodeString("")."<br/>";
        echo "<hr/>";
        var_dump($m);
    }    
// }

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
<?php 
require_once __DIR__.'/../src/whatsprot.class.php';
require_once __DIR__.'/../src//events/MyEvents.php';

    $message = $_POST['message'];
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$target = $_POST['target'];
	$nickname = 'CAT Total Play';
    $debug = true;

//Change to your time zone
date_default_timezone_set('America/Mexico_City');

//This function only needed to show how eventmanager works.
function onGetProfilePicture($from, $target, $type, $data)
{
    if ($type == 'preview') {
        $filename = 'preview_'.$target.'.jpg';
    } else {
        $filename = $target.'.jpg';
    }

    $filename = Constants::PICTURES_FOLDER.'/'.$filename;

    file_put_contents($filename, $data);

    echo '- Profile picture saved in '.Constants::PICTURES_FOLDER.'/'.$filename."\n";
}

function onPresenceAvailable($username, $from)
{
    $dFrom = str_replace(['@s.whatsapp.net', '@g.us'], '', $from);
    echo "<$dFrom is online>\n\n";
}

function onPresenceUnavailable($username, $from, $last)
{
    $dFrom = str_replace(['@s.whatsapp.net', '@g.us'], '', $from);
    echo "<$dFrom is offline> Last seen: $last seconds\n\n";
}

//Create the whatsapp object and setup a connection.
$w = new WhatsProt($username, $nickname, $debug);
$w->connect();

// Now loginWithPassword function sends Nickname and (Available) Presence

$w->loginWithPassword($password);


//Retrieve large profile picture. Output is in /src/php/pictures/ (you need to bind a function
//to the event onProfilePicture so the script knows what to do.
$w->eventManager()->bind('onGetProfilePicture', 'onGetProfilePicture');
$w->sendGetProfilePicture($target, true);

//Print when the user goes online/offline (you need to bind a function to the event onPressence
//so the script knows what to do)
$w->eventManager()->bind('onPresenceAvailable', 'onPresenceAvailable');
$w->eventManager()->bind('onPresenceUnavailable', 'onPresenceUnavailable');

//update your profile picture
$w->sendSetProfilePicture('preguntas-frecuentes.jpg');

//send simple message
// if ($message != '' || $message != null) {
//  $w->sendMessage($target, $message);
//  $messageSent = $message;
//  $message = null;    
// }
//
try{
    $w->sendMessage($target, $message);
    // echo "<div class='dataOutput'>Mensaje enviado exitosamente!</div>";
    // echo "<div class='dataOutput'>Usuario: $username<br/> Password: $pass<br/>Contacto: $contact</div>";
    $messageSent = $message;
    include_once 'bConversation.php';
} catch (Exception $e) {
    $e = $e->getMessage();
    echo "<div class='alert'>Algo salió mal:  $e</div>";
    // echo $e->getMessage()."\n";
    // exit(0);
    include_once 'bConversation.php';
}


// $pn = new ProcessNode($w, $target);
// $w->setNewMessageBind($pn);

// //echo "\n\nYou can also write and send messages to $target (interactive conversation)\n\n> ";

// while ($w->pollMessage()) {
//     $msgs = $w->getMessages();
//     $i = 0;
//     foreach ($msgs as $m) {
//      $respown = $m;
//      $arrayMessages[$i] = $respown;
//  //echo "Mensaje de $contact <br> $message";
//     }
// }

// class ProcessNode
// {
//     protected $wp = false;
//     protected $target = false;

//     public function __construct($wp, $target)
//     {
//         $this->wp = $wp;
//         $this->target = $target;
//     }

    /**
     * @param ProtocolNode $node
     */
    // public function process($node)
    // {
    //     // Example of process function, you have to guess a number (psss it's 5)
    //     // If you guess it right you get a gift
    //     if ($node->getAttribute('type') == 'text') {
    //         $text = $node->getChild('body');
    //         $text = $text->getData();
    //         if ($text && ($text == '5' || trim($text) == '5')) {
    //             $this->wp->sendMessageImage($this->target, 'https://s3.amazonaws.com/f.cl.ly/items/2F3U0A1K2o051q1q1e1G/baby-nailed-it.jpg');
    //             $this->wp->sendMessage($this->target, 'Congratulations you guessed the right number!');
    //         } elseif (ctype_digit($text)) {
    //             if ((int) $text != '5') {
    //                 $this->wp->sendMessage($this->target, "I'm sorry, try again!");
    //             }
    //         }
    //         $text = $node->getChild('body');
    //         $text = $text->getData();
    //         $notify = $node->getAttribute('notify');

    //         echo "\n- ".$notify.': '.$text.'    '.date('H:i')."\n";
    //     }
    // }
// }

?>
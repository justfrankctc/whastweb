<?php
    $message = $_GET['message'];
    // $message = "This is a test!";
    $username = "5215585296369";
    $password = "xJyTr/9j6DVAqaH40L5UowkoLro=";
    $contact = $_GET['target'];
    $target = "521$contact";
    // $target = "5215525611806";
    $nickname = 'Total Play';
    $debug = false;


    set_time_limit(10);
    require_once __DIR__.'/../src/whatsprot.class.php';
    require_once __DIR__.'/../src//events/MyEvents.php';

    //Change to your time zone
    date_default_timezone_set('America/Mexico_City');

    //This function only needed to show how eventmanager works.
    function onGetProfilePicture($from, $target, $type, $data){
        if ($type == 'preview') {
            $filename = 'preview_'.$target.'.jpg';
        } else {
            $filename = $target.'.jpg';
        }

        $filename = Constants::PICTURES_FOLDER.'/'.$filename;

        file_put_contents($filename, $data);

        echo '- Profile picture saved in '.Constants::PICTURES_FOLDER.'/'.$filename."\n";
    }

    function onPresenceAvailable($username, $from){
        $dFrom = str_replace(['@s.whatsapp.net', '@g.us'], '', $from);
        echo "<$dFrom is online>\n\n";
    }

    function onPresenceUnavailable($username, $from, $last){
        $dFrom = str_replace(['@s.whatsapp.net', '@g.us'], '', $from);
        echo "<$dFrom is offline> Last seen: $last seconds\n\n";
    }

    // echo "<br/><div class='dataOutput'>[] Logging in as '$nickname' ($username)</div>\n";
    //Create the whatsapp object and setup a connection.
    try {
        //Create the whatsapp object and setup a connection.
        $w = new WhatsProt($username, $nickname, $debug);
        $w->connect();
        
        // Now loginWithPassword function sends Nickname and (Available) Presence
        $w->loginWithPassword($password);

        // Retrieve large profile picture. Output is in /src/php/pictures/ (you need to bind a function
        // to the event onProfilePicture so the script knows what to do.
        $w->eventManager()->bind('onGetProfilePicture', 'onGetProfilePicture');
        $w->sendGetProfilePicture($target, true);

        //Print when the user goes online/offline (you need to bind a function to the event onPressence
        //so the script knows what to do)
        $w->eventManager()->bind('onPresenceAvailable', 'onPresenceAvailable');
        $w->eventManager()->bind('onPresenceUnavailable', 'onPresenceUnavailable');

        // echo "<br/><div class='dataOutput'>Connected to WhatsApp</div>";
        
    } catch (Exception $e) {
        echo "<br/><div class='alert'>LoginWithPassword fail: $e</div>";
    }

    //update your profile picture
    // $w->sendSetProfilePicture('demo/venom.jpg');
    // try {
    //         //update your profile picture
    //         $w->sendSetProfilePicture('preguntas-frecuentes.jpg');
    //         echo "<br/><div class='dataOutput'>Profile picture update</div>";
    //     } catch (Exception $e) {
    //         echo "<br/><div class='alert'>Update profile picture fail: $e</div>";
    //     }

    //send picture
    // $w->sendMessageImage($target, 'demo/x3.jpg');

    //send video
    //$w->sendMessageVideo($target, 'http://techslides.com/demos/sample-videos/small.mp4');

    //send Audio
    //$w->sendMessageAudio($target, 'http://www.kozco.com/tech/piano2.wav');

    //send Location
    //$w->sendMessageLocation($target, '4.948568', '52.352957');

    // Implemented out queue messages and auto msgid
    // $w->sendMessage($target, $message);
    try {
        //send message
        $w->sendMessage($target, $message);
        $messageSent = $message;
        // echo "<br/><div class='dataOutput'>Message sent successfully!</div>";
        // echo "<br/><div class=''>Target: $target</div>";
        // echo "<br/><div class=''>Message: $message</div>";
    } catch (Exception $e) {
        echo "<br/><div class='alert'>Send message fail: $e</div>";
    }
    // $w->sendMessage($target, 'Sent from WhatsApi at '.date('H:i'));

    while ($w->pollMessage());

    /*
     * You can create a ProcessNode class (or whatever name you want) that has a process($node) function
     * and pass it through setNewMessageBind, that way everytime the class receives a text message it will run
     * the process function to it.
     */
    $pn = new ProcessNode($w, $target);
    $w->setNewMessageBind($pn);

    // echo "\n\nYou can also write and send messages to $target (interactive conversation)\n\n> ";

    // while (1) {
    //     $w->pollMessage();
    //     $msgs = $w->getMessages();
    //     foreach ($msgs as $m) {
    //         // process inbound messages
    //         //print($m->NodeString("") . "\n");
    //     }
    //     $line = fgets_u(STDIN);
    //     if ($line != '') {
    //         if (strrchr($line, ' ')) {
    //             $command = trim(strstr($line, ' ', true));
    //         } else {
    //             $command = $line;
    //         }
    //         //available commands in the interactive conversation [/lastseen, /query]
    //         switch ($command) {
    //             case '/query':
    //                 $dst = trim(strstr($line, ' ', false));
    //                 echo "[] Interactive conversation with $target:\n";
    //                 break;
    //             case '/lastseen':
    //                 echo '[] last seen: ';
    //                 $w->sendPresenceSubscription($target);
    //                 break;
    //             default:
    //                 $w->sendMessage($target, $line);
    //                 break;
    //         }
    //     }
    // }

    /**
     * Demo class to show how you can process inbound messages.
     */
    class ProcessNode
    {
        protected $wp = false;
        protected $target = false;

        public function __construct($wp, $target)
        {
            $this->wp = $wp;
            $this->target = $target;
        }

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
    }
?>
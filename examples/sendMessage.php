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
        // echo "<$dFrom is online>\n\n";
    }

    function onPresenceUnavailable($username, $from, $last){
        $dFrom = str_replace(['@s.whatsapp.net', '@g.us'], '', $from);
        // echo "<$dFrom is offline> Last seen: $last seconds\n\n";
    }

    // echo "<br/><div class='dataOutput'>[] Logging in as '$nickname' ($username)</div>\n";
    try {
        //Create the whatsapp object and setup a connection.
        $w = new WhatsProt($username, $nickname, $debug);
        $w->connect();
        
        // Now loginWithPassword function sends Nickname and (Available) Presence
        $w->loginWithPassword($password);

        
        //Print when the user goes online/offline (you need to bind a function to the event onPressence
        //so the script knows what to do)
        $w->eventManager()->bind('onPresenceAvailable', 'onPresenceAvailable');
        $w->eventManager()->bind('onPresenceUnavailable', 'onPresenceUnavailable');

        // echo "<br/><div class='dataOutput'>Connected to WhatsApp</div>";
        
    } catch (Exception $e) {
        // echo "<br/><div class='alert'>LoginWithPassword fail: $e</div>";
    }

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
        // echo "<br/><div class='alert'>Send message fail: $e</div>";
    }
    // $w->sendMessage($target, 'Sent from WhatsApi at '.date('H:i'));

    try {
        
        while ($w->pollMessage());
       
        echo "<div class='outputInfo success'> El mensaje ha sido enviado </div>";
        $w->disconnect();
    } catch (Exception $e) {
        echo "<div class='outputInfo alert'> $e </div>";            
    }


   
?>
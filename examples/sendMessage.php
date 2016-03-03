<?php
    require_once __DIR__.'/../src/whatsprot.class.php';
    require_once __DIR__.'/../src//events/MyEvents.php';

    $message = $_GET['message'];
    $username = "5215585296369";
    $password = "xJyTr/9j6DVAqaH40L5UowkoLro=";
    $contact = $_GET['target'];
    $target = "521$contact";
    $nickname = 'Total Play';
    $debug = false;

    set_time_limit(10);
   
    //Change to your time zone
    date_default_timezone_set('America/Mexico_City');

    function onPresenceAvailable($username, $from){
        $dFrom = str_replace(['@s.whatsapp.net', '@g.us'], '', $from);
        // echo "<$dFrom is online>\n\n";
    }

    function onPresenceUnavailable($username, $from, $last){
        $dFrom = str_replace(['@s.whatsapp.net', '@g.us'], '', $from);
        // echo "<$dFrom is offline> Last seen: $last seconds\n\n";
    }

       
    // Create the whatsapp object and setup a connection.
    $w = new WhatsProt($username, $nickname, $debug);
    $w->connect();        

    // Now loginWithPassword function sends Nickname and (Available) Presence
    $w->loginWithPassword($password);

    // Retrieve large profile picture. Output is in /src/php/pictures/ (you need to bind a function
    // to the event onProfilePicture so the script knows what to do.
    $w->eventManager()->bind('onGetProfilePicture', 'onGetProfilePicture');

    //Print when the user goes online/offline (you need to bind a function to the event onPressence
    //so the script knows what to do)
    $w->eventManager()->bind('onPresenceAvailable', 'onPresenceAvailable');
    $w->eventManager()->bind('onPresenceUnavailable', 'onPresenceUnavailable');

        // echo "<br/><div class='dataOutput'>Connected to WhatsApp</div>";
        
    } catch (Exception $e) {
        // echo "<br/><div class='alert'>LoginWithPassword fail: $e</div>";
    }

    //send message
    $w->sendMessage($target, $message);

    while ($w->pollMessage());

    $w->disconnect();
?>
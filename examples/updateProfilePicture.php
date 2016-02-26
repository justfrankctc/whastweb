<?php
	$username = "5215585296369";
    $password = "xJyTr/9j6DVAqaH40L5UowkoLro=";
    $nickname = 'Total Play';
    $picture = 'TOTALPLAY2.jpg';
    $debug = false; 

    set_time_limit(10);
    require_once __DIR__.'/../src/whatsprot.class.php';
    require_once __DIR__.'/../src//events/MyEvents.php';

    //Change to your time zone
    date_default_timezone_set('America/Mexico_City');

    //This function only needed to show how eventmanager works.
    // function onGetProfilePicture($from, $target, $type, $data){
    //     if ($type == 'preview') {
    //         $filename = 'preview_'.$target.'.jpg';
    //     } else {
    //         $filename = $target.'.jpg';
    //     }

    //     $filename = Constants::PICTURES_FOLDER.'/'.$filename;

    //     file_put_contents($filename, $data);

    //     echo '- Profile picture saved in '.Constants::PICTURES_FOLDER.'/'.$filename."\n";
    // }

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

        // Retrieve large profile picture. Output is in /src/php/pictures/ (you need to bind a function
        // to the event onProfilePicture so the script knows what to do.
        // $w->eventManager()->bind('onGetProfilePicture', 'onGetProfilePicture');
        // $w->sendGetProfilePicture($target, true);

        //Print when the user goes online/offline (you need to bind a function to the event onPressence
        //so the script knows what to do)
        $w->eventManager()->bind('onPresenceAvailable', 'onPresenceAvailable');
        $w->eventManager()->bind('onPresenceUnavailable', 'onPresenceUnavailable');

        // echo "<br/><div class='dataOutput'>Connected to WhatsApp</div>";
        
    } catch (Exception $e) {
        // echo "<br/><div class='alert'>LoginWithPassword fail: $e</div>";
    }
	//update your profile picture
	// $w->sendSetProfilePicture('TOTALPLAY.jpg');
    $w->sendSetProfilePicture($picture);
	// $w->disconnect();
?>
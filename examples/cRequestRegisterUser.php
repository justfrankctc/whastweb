<?php
require_once '../src/Registration.php';
// var_dump($_POST);
$phone = $_POST['phone'];
$username="521$phone";
$debug = false;
$identityExists = file_exists("../src/wadata/id.$username.dat");
$w = new Registration($username, $debug);
if (!$identityExists) {
    // echo "\n\nType sms or voice: ";
    // $option = fgets(STDIN);
    //$option->codeRequest();
    try {
        $w->codeRequest();
         include_once 'bSendToken.php';
    } catch (Exception $e) {
        $e = $e->getMessage();
        // exit(0);
        echo "<div class='alert'>Algo salió mal:  $e</div>";
        include_once 'bRequestRegisterUser.php';
    }
    
} else {
    try {
        $result = $w->checkCredentials();
    } catch (Exception $e) {
        $e = $e->getMessage();
        // exit(0);
        echo "<div class='alert'>Algo salió mal: $e</div>";
        include_once 'bRequestRegisterUser.php';
    }
}
// echo "<div class='dataOutput'>Su nombre de usuario es: $username</div>";
// include_once 'bSendToken.php';
/*
*/                        
?>
   

                
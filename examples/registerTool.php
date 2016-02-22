<?php
require_once '../src/Registration.php';
// var_dump($_POST);
$phone = $_POST['phone'];
$username="521$phone";
$debug = true;
$identityExists = file_exists("../src/wadata/id.$username.dat");
$w = new Registration($username, $debug);
if (!$identityExists) {
    // echo "\n\nType sms or voice: ";
    // $option = fgets(STDIN);
    //$option->codeRequest();
    try {
        $w->codeRequest();
         include_once 'bToken.php';
    } catch (Exception $e) {
        echo $e->getMessage()."\n";
        exit(0);
    }
    
} else {
    try {
        $result = $w->checkCredentials();
    } catch (Exception $e) {
        echo $e->getMessage()."\n";
        exit(0);
    }
}
echo "<div class='dataOutput'>Su nombre de usuario es: $username</div>";
/*
*/                        
?>
   

                
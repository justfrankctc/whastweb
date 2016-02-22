<?php
require_once '../src/Registration.php';
// $username ='5215525611806';
// $code = '332118';
$username = $_POST['user'];
$code = $_POST['code'];
$debug=false;
$w = new Registration($username, $debug);
// var_dump($_POST);
// echo "<div class='dataOutput'>Número usuario es: $username</div>";
// echo "<div class='dataOutput'>su clave es $code</div>";
try {
        $result = $w->codeRegister($code);
        $user=$result->login;
        $pass=$result->pw; 
		// $user = $username;
		// $pass = $code;

        echo "<div class='dataOutput'>Tu usuaro es: $user</div>";
        echo "<div class='dataOutput'>Tu password es: $pass</div>";
        include_once 'bSendToken.php';
    } catch (Exception $e) {
        $e = $e->getMessage();
        echo "<div class='alert'>Algo salió mal:  $e</div>";
        // echo $e->getMessage()."\n";
        // exit(0);
        include_once 'bSendToken.php';
    }
?>

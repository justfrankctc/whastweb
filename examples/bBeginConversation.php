<?php
	$pagTitle = "Iniciar una conversación"; 
	include_once 'header.php';
	$user = "5215585296369";
	$pass = "";
?>
<div class="heading">Introduce el número (10 dígitos) del contacto con el que quieres comunicarte.</div>
<form id="conversation" action="cBeginConversation.php" method="post">
    <input class="hide" type="text" name="user" value="<?php echo $user; ?>"/>
    <input class="hide" type="text" name="pass" value="<?php echo $pass; ?>"/>
    <input class="dataInput" type="text" name="target" placeholder="Contacto"/><br/>
  	<input type="submit" class="btn btn-success dataInput" id="sendNumber" value="Iniciar conversación"/>
  	<br/><a  class="btn btn-waring dataInput" href="index.php">Voler al inicio</a>
</form>
<?php include_once 'footer.php'; ?>
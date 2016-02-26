<?php
	$pagTitle = "Enviar Mensaje";
	include_once 'header.php';
?>
<div class="heading">Introduce el número (10 dígitos) del contacto con el que quieres comunicarte.</div>
<form id="conversation" action="SendMessage.php" method="get">
    <input class="dataInput" type="text" name="target" placeholder="<?php echo $target; ?>"/><br/><br/>
    <input class="messageInput" name="message" placeholder="<?php echo $message; ?>"/><br/><br/>
  	<input type="submit" class="btn btn-success dataInput" value="Send a message"/>
  	<input type="button" class="btn btn-info dataInput" value="Test" onclick="sendDataTest();" />
</form>
<?php include_once 'footer.php'; ?> 
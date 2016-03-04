<?php
	$pagTitle = "Enviar Mensaje";
	include_once 'header.php';
?>
<script>
	function sendDataTest () {
	var test = "sendMessage.php?target=5525611806&message=Hola%2C+Qué+hace%3F"
	window.location.assign(test);
}
</script>
<div class="heading">Introduce el número (10 dígitos) del contacto con el que quieres comunicarte.</div>
<form id="conversation" action="sendMessage.php" method="get">
    <input class="dataInput" type="text" name="target" placeholder="<?php echo $target; ?>"/><br/><br/>
    <input class="messageInput" name="message" placeholder="<?php echo $message; ?>"/><br/><br/>
  	<input type="submit" class="btn btn-success dataInput" value="Send a message"/>
  	<input type="button" class="btn btn-info dataInput" value="Test" onclick="sendDataTest();" />
</form>
<?php include_once 'footer.php'; ?> 
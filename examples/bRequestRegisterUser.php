<?php 
	$pagTitle = "Registrar uruario";
	include_once 'header.php'; 
?>
<form id="registerUser" action="cRequestRegisterUser.php" method="post">  
  <div class="heading">Escribe tu número de celular a 10 dígitos.</div>
  <input class="dataInput" type="text" name="phone" placeholder="Número de teléfono"><br/><br/>
  <input class="dataInput" type="radio" name="autenType" value="sms">   Mensaje </input><br/>
  <input class="dataInput" type="radio" name="autenType" value="voice">
  Llamada</input><br/>
  <input type="submit" class="btn btn-success dataInput" id="sendNumber" value="Registrar"/>
  <!-- <br/><a  class="btn btn-waring dataInput" href="index.php">Voler al inicio</a> -->
</form>
<?php include_once 'footer.php'; ?>
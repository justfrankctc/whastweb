<?php 
	$pagTitle = "Enviar token";
	include_once 'header.php';
?>
<div class="heading">Una clave ha sido enviada a tu celular, introduce la clave de 6 digitos que recibiste.</div>
<form id="sendToken" action="cSendToken.php" method="post">
  <input class="dataInput" type="text" name="user" placeholder="Número"/>
  <!-- <input class="hide" type="text" name="user" value="<?php //echo $username; ?>"/> -->
  <input class="dataInput" type="text" name="code" placeholder="Clave"/><br/>
  <input type="submit" class="btn btn-success dataInput" id="sendCode" value="Enviar"/>
  <!-- <br/><a  class="btn btn-waring dataInput" href="index.php">Voler al inicio</a> -->
</form>
<?php include_once 'footer.php'; ?>        
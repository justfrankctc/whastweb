<?php
	$pagTitle = "Enviar Mensaje";
	include_once 'header.php';
?>
<div class="col-md-12 panel">
	<div class="row">
		<div class="col-md-4 btn-success header">
			<span>Client</span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="converation box">
				<br/>
				<div class="messageItem host"><p class="hostMessage"><?php echo $messageSent;?></p></div>
				<!-- <div class="messageItem client"><p class="clientMessage">client</p></div> -->
			</div>
		</div>	
	</div>
	<div class="row">
		<form name="conversation" action="cConversation.php" method="post">			
			<div class="col-md-8">
				<div class="message box">
					<textarea class="message" name="message" cols="70" rows="3">
					</textarea>
				</div>
			</div>
			<div class="col-md-3">
				<div class="buttonCont">
					<input class="hide" type="text" name="user" value="<?php echo $username ?>" />
					<input class="hide" type="text" name="pass" value="<?php echo $pass ?>" />
					<input class="hide" type="text" name="target" value="<?php echo $target ?>" />
					<input class="btn btn-success send" type="submit" name="sendMessage" value="Enviar" />
				</div>	
			</div>			
		</form>
	</div>
</div>
<?php include_once 'footer.php'; ?> 
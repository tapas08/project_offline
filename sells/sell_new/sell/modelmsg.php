<!---Message Model-->
<div class="modal fade" id="creditModal_1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Message of Bill</h4>
				</div>
				<div class="modal-body">
				<?php
require_once('core/init.php');
	$db = DB::getInstance();
	//$get1 = DB::getInstance()->query("SELECT message FROM messages" );
if ($_POST['submit']){
$insert = $db->update('messages',array('id', '=',4), array(
					'message' => $_POST["message"],
					
				  ));
		}	
		?>
<div class="container">
		<form method="post" id="addForm">
				<div class="row">
	
					<div class="titles"><label class="control-label">Message :</label></div>
					<?php //foreach ($get1->results() as $key => $value){ ?>
			
					<div ><input type="textarea" class="form-control" name="message" ></div>
					<?php //}?>
					</div>
				
				</div>
				<div class="modal-footer">
				
                	<input type="submit" class="btn btn-primary" value="F10 Save" name="submit" >
                	<input type="submit" class="btn btn-primary" value="Esc-Exit"  name="Esc-Exit">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					
				</div>
			</form>
			</div>
		</div>
	</div>
</div>

<!----******---->
<script src="js/jquery.js"></script>
<script>
$('#message1').click(function(){
		$('#creditModal_1').modal();
	});
	

</script>
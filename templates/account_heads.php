<?php 
require_once '../core/init.php';
$db = DB::getInstance();

// Get Account Heads
$heads = $db->query("SELECT * FROM parent_head");
?>

<div class="modal fade modal-heads col-md-12" tabindex="-1" role="dialog" aria-labelledby="NewCompanyForm">
 	<div class="modal-dialog" style="width: 1000px;">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 				<center><h4 class="center">Account Heads</h4></center>
 				<p class="shortcuts"><b>Shortcuts</b>: <span>[N]</span> : Add New Sub Head | <span>[&#x21E7;&#x21E9;]</span> : To Navigate | <span>Numb Pad [8 2]</span> : To Navigate Sub Heads</p>
 			</div>
 			<div class="modal-body">
 				<div class="container-fluid">
 					<div class="col-md-3">
 						<p class="msg"></p><br>
						<input type="button" id="goto_prev" value="prev" style="display:none;">
						<input type="button" id="goto_next" value="next" style="display:none;">
 						<nav class="navbar navbar-default">
 							<ul class="nav nav-stacked nav-pills head-lists">
 								<?php 
 									foreach ($heads->results() as $result => $parent_head):
 										echo "<li><a href=\"#\"><i class=\"fa fa-plus\"> </i> ". $parent_head['name'] ."</a></li>";
 									endforeach;
 								?>
 							</ul>
 						</nav>
 					</div>
 					<div class="col-md-9">
 						<input type="hidden" id="on_subheads" value="false">
 						<table class="table table-condensed">
 							<thead>
 								<td>Sub Heads</td>
 								<td>Opening Balance</td>
 								<td>Closing Balance</td>
 							</thead>
 							<tbody class="sub-heads-details"></tbody>
 						</table>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
</div>


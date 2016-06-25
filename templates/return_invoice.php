<div class="modal fade col-md-12" id="return_invoice" tabindex="-1" role="dialog" aria-labelledby="CustomeSupplierForm">
 	<div class="modal-dialog" style="width: 1000px;">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4>Purchase Return Bills</h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<div class="container-fluid">
	 				<input type="hidden" id="return_bills">
	 				<div class="form-group details-table">
	 				<?php
					require_once 'core/init.php';

					$db = DB::getInstance()->query("SELECT * FROM purchaseReturn");

					if ($db->count() > 0 && !$db->error()){
					?>
						<table class="table table-bordered table-condensed">
							<thead>
								<td>Inv No.</td>
								<td>Date</td>
								<td>Supplier</td>
								<td>Amnt</td>
								<td>Btype</td>
								<td>Adjusted</td>
								<td>Pinvno</td>
								<td>PDate</td>
							</thead>
							<tbody>
					<?php
						foreach($db->results() as $return_bills => $return){
							echo "<tr>";
							echo "<td>".$return['invoiceNo']."</td>";
							echo "<td>".$return['invoiceDate']."</td>";
							echo "<td>".$return['supplier']."</td>";
							echo "<td>".$return['amount']."</td>";
							echo "<td>".$return['bType']."</td>";
							echo "<td>N</td>";
							echo "<td>0</td>";
							echo "<td>0</td>";
						}
					}
						
					?>
							</tbody>
						</table>
					</div>
 				</div>
 				<div class="return_bill_details">
 					<table class="table table-bordered table-condensed">
 						<thead>
 							<td>Product</td>
 							<td>Pack</td>
 							<td>Batch</td>
 							<td>Pr Rate</td>
 							<td>MRP</td>
 							<td>QTY</td>
 							<td>Amnt</td>
 							<td>PinvNo</td>
 							<td>Date</td>
 						</thead>
 						<tbody id="return_products_list">
 						</tbody>
 					</table>
 				</div>
 			</div>
 		</div>
 	</div>
</div>
<!-- New Customer Supplier form -->
<div class="modal fade modal-newCustSupp col-md-12" tabindex="-1" role="dialog" aria-labelledby="CustomeSupplierForm">
 	<div class="modal-dialog" style="width: 1000px;">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 				<center><h4 class="center">Customer/Supplier</h4></center>
 			</div>
 			<div class="modal-body">
 				<div class="container-fluid">
 				<div id="msgCstSupp"></div>
 				<?php include('forms/customer_stockist.php'); ?>
 				<div class="form-group col-md-6">
 					<input type="reset" id="cancel" name="cancel" class="btn btn-primary">
 					<input type="button" id="modifyCustSuppDisabled" name="modifyCustSuppDisabled" value="Modify" class="btn btn-primary" disabled>
 					<input type="button" id="deleteCustSupp" name="deleteCustSupp" value="Delete" class="btn btn-primary" disabled>
					<button id="saveChanges" name="saveChanges" class="btn btn-primary" onclick="saveStockistCustomer();">(F10) Save</button>
					<button id="exitForm" name="exitForm" class="btn btn-primary" data-dismiss="modal">(Esc) Exit</button>
				</div>
 				</div>
 			</div>
 		</div>
 	</div>
</div>

<!-- Stockist Wise Company Modal (new COMPANY) -->
<div class="modal fade modal-newCompany col-md-12" tabindex="-1" role="dialog" aria-labelledby="NewCompanyForm">
 	<div class="modal-dialog" style="width: 1000px;">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 				<center><h4 class="center">New Company</h4></center>
 			</div>
 			<div class="modal-body">
 				<div class="container-fluid">
 					<?php include('forms/stockistcompany.php'); ?>
 				</div>
 			</div>
 		</div>
 	</div>
</div>

<!-- Company Wise Stockist Modal (new STOCKIST) -->
<div class="modal fade modal-newStockist col-md-12" tabindex="-1" role="dialog" aria-labelledby="NewStockistForm">
 	<div class="modal-dialog" style="width: 1000px;">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 				<center><h4 class="center">New Stockist</h4></center>
 			</div>
 			<div class="modal-body">
 				<div class="container-fluid">
 					<?php include('forms/companystockist.php'); ?>
 				</div>
 			</div>
 		</div>
 	</div>
</div>

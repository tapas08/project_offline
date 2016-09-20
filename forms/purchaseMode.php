<form method="post" id="purchaseForm" action="">
	<h2 class="pull-right">
		Item Purchase Mode
	</h2>
	<div class="row">		
		<p class="alert alert-success">Enter product details</p>
		<div class="center" id="center">

			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="productName"><i class="fa fa-tag"></i> Product Name *</label></span>
				<span class="col-xs-4"><input type="text" id="productName" class="form-control" name="productName" placeholder="Product Name" required></span>
			</div>

			<!-- 
					***********************************************************************
							MODAL TO OPEN FORM FOR NEW MARKETED BY ENTRY
					***********************************************************************
			 -->

			 <div class="modal fade modal-newMarktBy" tabindex="-1" role="dialog" aria-labelledby="NewMarktByModal">
			 	<div class="modal-dialog">
			 		<div class="modal-content">
			 			<div class="modal-header">
			 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			 					<span aria-hidden="true">&times;</span>
			 				</button>
			 				<h4>Comany Wise Stockist</h4>
			 			</div>
			 			<div class="modal-body">
			 				<form action="" class="col-md-12">
			 					<div class="container-fluid">
				 					<div class="form-group col-md-12">
				 						<label for="company_name" class="control-label col-md-4">Company Name :</label>
				 						<span class="col-md-6"><input type="text" class="form-control" name="company_name" list="company_list" id="company_name" oninput="getList('company_name', 'company_list');"></span>
				 						<datalist id="company_list"></datalist>
				 						<span class="col-md-2"><input type="text" class="form-control" name="shortName" id="shortName" oninput="getList('company_name', 'company_list');"></span>
				 					</div>
				 					<div class="form-group col-md-12">
				 						<label for="stockist_name" class="control-label col-md-4">Stockist Name</label>
				 						<span class="col-md-6"><input type="text" class="form-control" id="stockist_name" list="stockist_list" name="stockist_name" oninput="getList('stockist_name', 'stockist_list');"></span>
				 						<datalist id="stockist_list"></datalist>
				 						<a href="#"  class="btn btn-primary" data-toggle="modal" data-target=".modal-newCustSupp">Add</a>
				 					</div>
				 					<div class="form-group col-md-12">
				 						<label for="stockist_priority" class="control-label col-md-4">Stockist Priority</label>
				 						<span class="col-md-4"><input type="text" class="form-control" id="stockist_priority" id="stockist_priority"></span>
				 					</div>
				 				</div>
			 				</form>

			 				<table class="table table-bordered">
			 					<thead>
			 						<td>Stockist Name</td>
			 						<td>PO_Priority</td>
			 					</thead>
			 					<tbody id="stockist_list_table">
			 						
			 					</tbody>
			 				</table>
			 			</div>
			 		</div>
			 	</div>
			 </div>

			 <!-- 
					
					******************* END ********************

			  -->
			

			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="marketedBy"><i class="fa fa-briefcase"></i> Marketed By *</label></span>
				<span class="col-xs-4"><input type="text" id="productMarketedBy" class="form-control" name="productMarketedBy" list="marketedByList" aria-describedby="addMarketedBy" placeholder="Product Marketed By" oninput="getList('productMarketedBy', 'marketedByList');" required></span>
				<datalist id="marketedByList"></datalist>
				<button type="button" class="btn btn-info" id="addNewMrkBy" data-toggle="modal" data-target=".modal-newMarktBy">Add New</button>
			</div>
		
			
			<!-- 
					***********************************************************************
							MODAL TO OPEN FORM FOR NEW MANUFACTURED BY ENTRY
					***********************************************************************
			 -->

			 <div class="modal fade modal-newManuBy" tabindex="-1" role="dialog" aria-labelledby="NewManuByModal">
			 	<div class="modal-dialog">
			 		<div class="modal-content">
			 			<div class="modal-header">
			 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			 					<span aria-hidden="true">&times;</span>
			 				</button>
			 				<h4>Comany Wise Stockist</h4>
			 			</div>
			 			<div class="modal-body">
			 				<form action="" class="col-md-12">
			 					<div class="container-fluid">
				 					<div class="form-group col-md-12">
				 						<label for="company_name" class="control-label col-md-4">Company Name :</label>
				 						<span class="col-md-6"><input type="text" class="form-control" name="company_name" id="company_name"></span>
				 					</div>
				 					<div class="form-group col-md-12">
				 						<label for="stockist_name" class="control-label col-md-4">Stockist Name</label>
				 						<span class="col-md-6"><input type="text" class="form-control" id="stockist_name" name="stockist_name"></span>
				 					</div>
				 					<div class="form-group col-md-12">
				 						<label for="stockist_priority" class="control-label col-md-4">Stockist Priority</label>
				 						<span class="col-md-4"><input type="text" class="form-control" id="stockist_priority" id="stockist_priority"></span>
				 					</div>
				 				</div>
			 				</form>

			 				<table class="table table-bordered">
			 					<thead>
			 						<td>Stockist Name</td>
			 						<td>PO_Priority</td>
			 					</thead>
			 					<tbody>
			 						
			 					</tbody>
			 				</table>
			 			</div>
			 		</div>
			 	</div>
			 </div>

			 <!-- 
					
					******************* END ********************

			  -->


			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="productManftr"><i class="fa fa-gears"></i> Manufacturer *</label></span>
				<span class="col-xs-4"><input type="text" id="productManftr" class="form-control" name="productManftr" placeholder="Product Manufacturer" required></span>
				<!-- <button type="button" class="btn btn-info" id="addNewMnftr" data-toggle="modal" data-target=".modal-newManuBy">Add New</button> -->
			</div>
		
			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label id="productPackSize"><i class="fa fa-plus-square"></i> Pack Size *</label></span>
				<span class="col-xs-4"><input type="text" id="productPackSize" class="form-control" name="productPackSize" aria-describedby="sizing-addon6" placeholder="Product Quantity (ex: 10S or 500ML)" required></span>
			</div>

			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="productQuantity"><i class="fa fa-plus-square"></i> Purchase Size *</label></span>
				<span class="col-xs-4"><input type="number" id="productQuantity" class="form-control" name="productQuantity" aria-describedby="sizing-addon6" placeholder="Pack Size" required></span>
			</div>

			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="productMainCategory"><i class="fa fa-sitemap"></i> Main Category *</label></span>
				<span class="col-xs-4">
					<input type="text" list="mainCategory" id="productMainCategory" name="productMainCategory" class="form-control" value="SCHEDULE" required>
					<datalist id="mainCategory">
						<option class="form-control">SCHEDULE</option>
						<option class="form-control">NON SCHEDULE</option>
					</datalist>
				</span>
				<!-- <button type="button" class="btn btn-info" id="addNewCat">Add New</button> -->
			</div>

			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="productSubCategory"><i class="fa fa-sitemap"></i> Sub Category *</label></span>
				<span class="col-xs-4">
					<input type="text" class="form-control" name="productSubCategory" id="productSubCategory" list="subCategory" value="GE" required>
					<datalist id="subCategory">
						<option class="form-control">GE</option>
						<option class="form-control">SCHEDULE-H</option>
						<option class="form-control">SCHEDULE-H1</option>						
						<option class="form-control">NARCOTIC</option>						
					</datalist>
				</span>
				<!-- <button type="button" class="btn btn-info" id="addNewSubCat">Add New</button> -->
			</div>

			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="productType"><i class="fa fa-sitemap"></i> Product Type *</label></span>
				<span class="col-xs-4">
					<select id="productType" name="productType" class="form-control" required>
						<?php
							$productTypes = $db->query("SELECT * FROM product_type")->results();
							foreach ($productTypes as $key => $value) {
						?>

						<option value="<?php echo $value['abbreviation']; ?>"><?php echo "{$value['abbreviation']} - {$value['type']}"; ?></option>

						<?php
							}
						?>
					</select>
				</span>
				<button type="button" class="btn btn-info" id="addNewProdType" data-toggle="modal" data-target=".modal-newProductType">Add New</button>
			</div>

			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="productGroup"><i class="fa fa-sitemap"></i> Product Group *</label></span>
				<span class="col-xs-4">
					<select id="productGroup" name="productGroup" class="form-control" onchange="getVat();" required>
						<?php 
							$vat = $db->query("SELECT * FROM vat_category ORDER BY id DESC");

							if (!$vat->error()){

								foreach ($vat->results() as $key => $value) {
									$productGroup[$value['vat_type']] = $value['vat_value'];
									echo "<option>{$value['vat_type']}</option>";
								}

							}
						?>
					</select>
				</span>
			</div>

			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="productRate"><i class="fa fa-calendar-plus-o"></i> Purchase Rate</label></span>
				<span class="col-xs-4"><input type="number" step="any" id="productRate" class="form-control" name="productRate"></span>
			</div>

			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="productMRP"><i class="fa fa-calendar-plus-o"></i> M.R.P.</label></span>
				<span class="col-xs-4"><input type="number" step="any" id="productMRP" class="form-control" name="productMRP"></span>
			</div>

			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="productTax"><i class="fa fa-calendar-times-o"></i> Tax</label></span>
				<span class="col-xs-1"><input type="number" step="any" class="form-control" name="productTax" id="productTax"></span>
				<span class="col-xs-2"><label for="productVat"><i class="fa fa-calendar-times-o"></i> VAT(%)</label></span>
				<span class="col-xs-1"><input type="number" step="any" class="form-control" name="productVat" id="productVat" value="getVat();" ></span>
			</div>

			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="productShelf"><i class="fa fa-calendar-times-o"></i> Rack/Shelf</label></span>
				<span class="col-xs-4"><input type="text" class="form-control" name="productShelf" id="productShelf"></span>
			</div>

			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="productReorderLvl"><i class="fa fa-calendar-times-o"></i> Reorder Level</label></span>
				<span class="col-xs-4"><input type="text" class="form-control" name="productReorderLvl" id="productReorderLvl" placeholder="In Tablet Size"></span>
			</div>

			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="productOrderQuantity"><i class="fa fa-calendar-times-o"></i> Order Quantity</label></span>
				<span class="col-xs-4"><input type="number" class="form-control" name="productOrderQuantity" id="productOrderQuantity" placeholder="In Strip Size"></span>
			</div>

			<div class="input-group col-xs-12 input-divs">
				<span class="col-xs-2"><label for="productContent"><i class="fa fa-calendar-times-o"></i> Drug Content</label></span>
				<span class="col-xs-4"><textarea class="form-control" name="productContent" id="productContent" rows="1" oninput="get_drug_content();"></textarea></span>
				<button type="button" class="btn btn-info" id="addNewCont" data-toggle="modal" data-target=".modal-newDrugContent">New Drug Content</button>
			</div>

			<br>
			<div class="input-group col-xs-12">
				<input type="submit" name="submitUpdate" id="submitUpdate" value="Save" class="btn btn-success col-md-2"><span>&nbsp;</span>
				<input type="reset" name="reset" id="reset" value="Cancel" class="btn btn-success col-md-2"><span>&nbsp;</span>
				<a href="?modifyPurchase=true" name="modifyPurchase" id="modifyPurchase" class="btn btn-success col-md-2" onclick="loadForm('modifyPurchase');">Modify</a><span>&nbsp;</span>
				<a href="?deletePurchase=true" name="deletePurchase" id="deletePurchase" class="btn btn-success col-md-2" onclick="loadForm('deletePurchase');">Delete</a>
			</div>
		</div>
	</div>
</form>
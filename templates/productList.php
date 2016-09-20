<!-- Modal to show detailed list of product -->
<div class="modal fade modal-details col-md-12" tabindex="-1" role="dialog" aria-labelledby="NewCompanyForm">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-body">
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 				<div class="container-fluid">
 					<div class="col-md-12">
 						<div class="col-md-6 form-group">
 							<input type="text" id="modal_input" name="modal_input" class="form-control" oninput="list_modal_details();" autofocus>
 						</div>
 					</div>
 					<br />
 					<div class="details">
 						<p id="product_extra_details">
 							<!-- Supplier name | Invoice Number | Date -->
 							<span class="col-md-11 purchase-details"></span>
 							<span class="col-md-1 pull-right">
 								<input type="button" class="btn btn-primary" id="new_product" value="ADD">
 							</span>
 						</p>
 					</div>
 					<br />
 					<input type="button" id="goto_prev" value="prev" style="display:none;">
					<input type="button" id="goto_next" value="next" style="display:none;">
 					<div class="col-md-12 details-table product-list">
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
</div>
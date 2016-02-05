<form action="" id="stockist_wise_company">
	<div class="form-group col-xs-8">
		<label for="stockist_name" class="col-xs-2 control-label">Stockist Name</label>
		<div class="col-xs-8">
			<input type="text" name="stockist_name" id="stockist_name" list="stockist_list" class="form-control" oninput="getList('stockist_name', 'stockist_list');">
			<datalist></datalist>
		</div>
	</div>
	<div class="form-group col-xs-8">
		<label for="company_name" class="col-xs-2 control-label">Company Name</label>
		<div class="col-xs-8">
			<input type="text" name="company_name" id="company_name" class="form-control">
		</div>
		<div class="col-xs-2">
			<input type="text" name="abr" id="abr" class="form-control">
		</div>
	</div>
	<div class="col-xs-8">
		<input type="reset" name="clear" id="clear" value="Clear" class="btn btn-primary">
		<input type="button" name="save" id="save" value="Save" class="btn btn-primary" onclick="save();">
		<input type="button" name="exit" id="exit" class="btn btn-warning" data-dismiss="modal" value="Exit">
	</div>
	<div class="col-xs-12" id="entry_msg"></div>
	<div class="col-xs-12" id="result_set"></div>
</form>
<form action="">
	<div class="form-group col-md-12">
		<span class="col-md-3"><label for="ProductType">Product Type</label></span>
		<span class="col-md-9"><input type="text" id="ProductType" name="ProductType" class="form-control" list="type_list" oninput="getList('ProductType', 'type_list')"></span>
		<datalist id="type_list"></datalist>
	</div>
	<div class="form-group col-md-12">
		<span class="col-md-3"><label for="code">Short Code</label></span>
		<span class="col-md-3"><input type="text" id="code" name="code" class="form-control"></span>
	</div>
</form>
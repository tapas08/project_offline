<form action="">
	<div class="form-group col-md-12">
		<span class="col-md-3">
			<label for="drug_content">Drug Content</label>
		</span>
		<span class="col-md-9">
			<input type="text" id="drug_content" name="drug_content" class="form-control" list="content_list" onInput="getList('drug_content', 'content_list');">
		</span>
		<datalist id="content_list"></datalist>
	</div>
	<div class="form-group col-md-12">
		<span class="col-md-3">
			<label for="sub_category">Sub Category</label>
		</span>
		<span class="col-md-6">
			<select name="sub_category" id="sub_category" class="form-control">
				<option>GE</option>
				<option>SCHEDULE-H</option>
				<option>SCHEDULE-H1</option>						
				<option>NARCOTIC</option>	
			</select>
		</span>
	</div>
</form>
<form method="post" id="addForm" action="">
	<h2 class="pull-right">
		Event Remainder
	</h2>
		
		<div class="row">		
			<p class="alert alert-success" id="Message">Event Reminder Entry / Telephone diary</p>
			<div class="center" id="center">

				<div class="input-group col-lg-12 input-divs">
					<span class="col-lg-2"><label for="HeadName"><!--<i class="fa fa-tag"></i> -->Head Name </label></span>
					<span class="col-lg-4"><input type="text" id="HeadName" class="form-control" name="Headname" placeholder="Head Name" list="nameList" oninput="getDrug();" required></span>
					<datalist id="Headname"></datalist>

				</div>
				
				<div class="input-group col-lg-12 input-divs">
					<span class="col-lg-2"><label for="Addr"><!--<i class="fa fa-briefcase"></i>--> Address</label></span>
					<span class="col-lg-4"><textarea type="text" id="Addr" class="form-control" name="Addr" aria-describedby="Addr" placeholder="Address" required></textarea></span>
					<!--<button type="button" class="btn btn-info" id="addNewMrkBy" data-toggle="modal" data-target=".modal-newMarktBy">Add New</button>-->
				</div>
				
				
				<div class="input-group col-lg-12 input-divs">
					<span class="col-lg-2"><label for="ph_no"><!--<i class="fa fa-gears"></i>--> Phone number</label></span>
					<span class="col-lg-4"><input type="text" id="ph_no" class="form-control" name="ph_no" placeholder="Phone number" required></span>
					<!-- <button type="button" class="btn btn-info" id="addNewMnftr" data-toggle="modal" data-target=".modal-newManuBy">Add New</button> -->
				</div>
			
				<div class="input-group col-lg-12 input-divs">
					<span class="col-lg-2"><label for="productPackSize"><!--<i class="fa fa-plus-square"></i>--> Mobile number</label></span>
					<span class="col-lg-4"><input type="text" id="mo_no" class="form-control" name="mo_no" placeholder="mobile number" required></span>
				</div>

				<div class="input-group col-lg-12 input-divs">
					<span class="col-lg-2"><label for="remind_date"><!--<i class="fa fa-plus-square"></i>--> Remind date</label></span>
					<span class="col-lg-4"><input type="text" id="remind_date" class="form-control" name="remind_date" placeholder="Remind Date" required></span>
				</div>
				
				<div class="input-group col-lg-12 input-divs">
					<span class="col-lg-2"><label for="productQuantity"><!--<i class="fa fa-plus-square"></i>--> Event to Remind</label></span>
					<span class="col-lg-4"><input type="text" id="productManftr" class="form-control" name="EventToRemind" placeholder="EventToRemind" required></span>
				</div>
				
				<div class="input-group col-lg-12 input-divs">
					<span class="col-lg-2"><label for="productQuantity"><!--<i class="fa fa-plus-square"></i>--> Criteria/condition</label></span>
					<span class="col-lg-4"><textarea type="text" id="Addr" class="form-control" name="Criteria" aria-describedby="Addr" placeholder="criteria" required></textarea></span>
				</div>
				
				<div class="input-group col-lg-12 input-divs">
					<span class="col-lg-2"><label for="productQuantity"><!--<i class="fa fa-plus-square"></i>--> Before Days</label></span>
					<span class="col-lg-4"><input type="number" id="productQuantity" class="form-control" name="BeforeDays" aria-describedby="sizing-addon6" placeholder="BeforeDays" required></span>
				</div>
				
				<div class="input-group col-lg-12 input-divs">
					<span class="col-lg-2"><label for="productQuantity"><!--<i class="fa fa-plus-square"></i>--> Description</label></span>
					<span class="col-lg-4"><textarea type="text" id="Addr" class="form-control" name="description" aria-describedby="Addr" placeholder="Description" required></textarea></span>
				</div>
				
				
				</div>
					<div class="input-group col-md-7">
					
						<div class="col-md-7">
					    
						<input type="reset" name="reset" id="reset" value="Cancel" class="btn btn-success"><span>&nbsp;</span>
						
					
					
					    <input type="submit" name="submitUpdate" id="submitUpdate" value="Register"  class="btn btn-success"><span>&nbsp;</span>
						
						<input type="submit" name="submitUpdate" id="remainder" value="Remainder" class="btn btn-success"><span>&nbsp;</span>
						
						<a href="modifyevent.php" name="modifyevent" id="modifyevent" class="btn btn-success" onclick="loadForm('modifyevent');">Modify</a><span>&nbsp;</span>
				        
						<!--<a href="?deleteevent=true" name="deleteevent" id="deleteevent" class="btn btn-success" onclick="loadForm('deleteevent');">Delete</a><span>&nbsp;</span>-->
						
						</div>
					
				    
					</div>
					
					
			
			
			</form>
		
			<!-----table-----> 			
			<div class="table-align"  >	
				
				<table border="5px" cellspacing="2px" cellpadding="5px" width="1300px" class="border" >
					<tr class="bg">
					<th width="40px">Head Name</th>
					<th width="40px">Address</th>
					<th width="40px">Phone no</th>
					<th width="40px">Event</th>
					<th width="50px">Remind Date</th>
					<th width="40px">Description</th>
					</tr>
				</br>
				
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
			
				</table>
			</div>

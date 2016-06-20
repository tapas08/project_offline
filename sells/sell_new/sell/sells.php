<?php
	require_once('core/init.php');
	$message = [];
	$details = [];
	$session_id = session_id();
	$db = DB::getInstance();
	$bill_data = array();
	if (Input::exists()){
	
	foreach($_POST['selector'] as $demo){
		//print_r($demo);
	$bill = explode(",",$demo);
	$pr[] = $bill[0];
	//print_r($pr);
	$sch_bill = $bill[2];
	 if($sch_bill > 0)
	 {
		$getbill = DB::getInstance()->query("select * from patients where bill_no='".$sch_bill."' ");
		foreach ($getbill->results() as $data => $bill1){
				$bill_content = json_decode($getbill->first()['bill'], true);
				$i = 0;
				$keys = array_keys($bill_content);
			   foreach ($bill_content as $bill){
				   if( $keys[$i]==$pr[$i])
				   {
					    echo "match";
				   }	
			   }
			   $i++;
				
				
		}		
	 }
	}
	}
?>
<!--doctype html-->
<html>
<head>
	<meta charset="UTF-8">
	<title>SELL</title>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/invoice.css">
	<link rel="stylesheet" href="css/style.css">
	
	<link href="css/bootstrap-lightbox.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap-lightbox.min.css" rel="stylesheet" type="text/css" />

	<script src="script/jquery-min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
	<script src="script/jquery.mtz.monthpicker.js"></script>
	<script src="script/navigate.js"></script>
</head>
<body>
		
	<?php include('templates/header.php'); ?>

	<section class="container">
		<div class="col-md-12 top-menu">
			
			<?php
				if (count($message) > 0){
					foreach ($message as $msg){
						echo "<p class='alert alert-warning'>{$msg}</p>";
					}
				}
			?>

			<div class="col-md-6">
				<h2>SELL\PRODUCT</h2>
				<input type="data" id="datePicker" name="datePicker" style="visibility:hidden;">
			</div>
			<div class="col-md-6">
				<input type="reset" form="invoiceForm" id="reset" name="reset" class="btn btn-primary" value="Cancel">
				
				<input type="button"  name="impBill" class="btn btn-primary"  value="Imp Bill">
				<input type="button" id="pendingDM" name="pendingDM" class="btn btn-primary" onclick="checkPendingDM();" value="Pending DM">
				<input type="button" form="message" id="message1" name="message1"  class="btn btn-primary" value="Message">
				
		
				<a href="#" id="exit" name="exit" class="btn btn-primary">Exit</a>
			</div>
		</div>
		<br>
		
			
	
		<form action="main_bill.php" class="form" id="invoiceForm" method="POST">
			<div class="row ">
			<div class="form-group col-md-3">
					<span class="col-md-2"><label for="" class="control-label">Bill NO</label></span>
					<?php
							$billNo = DB::getInstance()->query("SELECT * FROM patients")->count();
						?>
					<span class="col-md-9"><input type="number" class="form-control3" id="billNo" name="billNo" value="<?php echo $billNo+1 ?>"></span>
			</div>
			<div class="form-group col-md-3">
					<span class="col-md-2"><label for="billDate" class="control-label">Date</label></span>
					<span class="col-md-9"><input value="<?php echo date('Y-m-d'); ?>" type="date" id="billDate" class="form-control2"  name="billDate"  /></span>
					
			</div>
			<!--<div class="form-group col-md-3">
					<span class="col-md-2"><label for="stock" class="control-label">Stock</label></span>
					<span class="col-md-8">
					<span class="col-md-5">
					
					<input type="text" class="form-control3" id="qty" name="qty" value=""></span>
					<span class="col-md-7">
					<input type="number" class="form-control3" id="stock_1" name="stock_1">
					</span></span>
			</div>-->
			
			
			</div>

			<div class="container-fluid" id="productEntry">
	
					<table class="table table-bordered">
					<thead>
						<td>Product Name</td>
						<td>Qty</td>
						<td>Amount</td>
						<td>MRP </td>
						<td>Batch No</td>
						<td>Pack</td>
						<td>Expire Date</td>
						<td>MFG </td>
						<td>Tax</td>
						<td>Prsize </td>
						<td>Rack </td>
						<td>CST </td>
					</thead>
					<tbody id="billContent">
						<tr>
							<td>
								<input type="text" name="productName_1" id="productName_1" class="form-control2"  list="drugList_1" oninput="detailsModal('productName_1');" autofocus >
									<datalist id="drugList_1"></datalist>
								</input>
							</td>
							<td><input type="number" name="quantity_1" id="quantity_1" oninput="calculate(1);" class="form-control3"></td>
							<td><input type="number" step="any" name="productRate_1" id="productRate_1" oninput="calculate(1);"  class="form-control3"></td>
							<td><input type="number" step="any" name="MRP_1" id="MRP_1" class="form-control3"></td>
							<td><input type="text" name="batchNo_1" id="batchNo_1" class="form-control3"></td>
							<td><input type="number" name="packSize_1" id="packSize_1" class="form-control3"></td>
							<td><input type="text" name="expiryDate_1" id="expiryDate_1" class="form-control3 month"></td>
							<td><input type="text"  name="manufacturer_1" id="manufacturer_1" class="form-control3"></td>
							<td><input type="text" name="Tax_1" id="Tax_1" oninput="calculate(1);" class="form-control3"></td>
							<td><input type="number" name="purchaseSize_1" id="purchaseSize_1" oninput="calculate(1);" class="form-control3"></td>
							<td><input type="text" name="shelf_1" id="shelf_1"  class="form-control3"></td>
						   <td><input type="text"  name="cost_1" id="cost_1"  class="form-control3 each_cost"  ></td>
						</tr>
					</tbody>
				</table>

			</div>
			<input type="button" id="addField" name="addField" class="btn btn-primary" value="Next Entry">
			<input type="hidden" form="invoiceForm" id="counter" name="counter" value=2>
			
			<br>
			<div class="container-fluid" id="otherEntries">
			
				<div class="col-md-5">
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="totalAmnt">Patient's Name </label>
						</span>
					
						<span class="col-md-7">
							<input type="text" name="patient_name" id="patient_name" list="patientList_1" oninput="getList1('patient_name', 'patientList_1', false, true);" class="form-control"   placeholder="Patient Name" autofocus>
							<datalist id="patientList_1"></datalist>
						</span>
						
					</div>
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="totalDiscount">PAT. Address </label>
						</span>
						<span class="col-md-7">
							<input type="text"  name="patient_address" id="patient_address" list="stockist_list" class="form-control" placeholder="Patient Address" autofocus>
						</span>
					</div>
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="creditNote">Phone/cell No </label>
						</span>
						<span class="col-md-7">
							<input type="text"  name="phone_no" id="phone_no" list="stockist_list" class="form-control" placeholder="Patient Phone/Cell" autofocus>
						</span>
					</div>
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="debitNote">Patient City :</label>
						</span>
						<span class="col-md-7">
							<input type="text"  name="patient_city" id="patient_city" list="stockist_list" class="form-control" placeholder="Patient City" autofocus>
						</span>
					</div>
					
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="vatOnBill">Doctor's Name</label>
						</span>
						<span class="col-md-7">
						<input type="text"  name="doctor_name" id="doctor_name" list="doctorList_1"oninput="getList_d('doctor_name', 'doctorList_1', true, true);" list="stockist_list" class="form-control" placeholder="Doctor Name" autofocus>	
						<datalist id="doctorList_1"></datalist>

						</span>
					</div>
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="netAmnt">Doctor City </label>
						</span>
						<span class="col-md-7">
						<input type="text"  name="doctor_city" id="doctor_city" list="stockist_list"						class="form-control" placeholder="Doctor City" autofocus>	
						</span>
					</div>
					<div class="col-md-12">
					<span class="col-md-4">
							<label for="netAmnt">Cash/Credit</label>
						</span>
					<span class="col-md-8"><select name="cash_or_credit" class="form-control">
																<option>C-cash</option>
																<option>C-credit</option>
																
																</select></span>
					</div>
					
				</div>
					<div class="col-md-1">
						<H3  style="color:#587942;">Balance</H3> 
						<h3 id="bal" style="color:#587942;">&nbsp;&nbsp;&nbsp;&nbsp;0.0</h3>
						
						</div>
				<div class="col-md-6" style="float:left;padding-left:250px;">
				

					 <div class="col-md-12">
						<span class="col-md-4">
							<div class="container-fluid" style="padding-left:50px;">
							<div id="drugContentMsg"></div>
							
							<img src="images/guest.jpeg" id="sales_img" width="80px" height="80px" align="left" style="border-radius:200px;">
						
							</div><br />
						</span>
					</div>
					<div class="col-md-12" >
						<span class="col-md-4">
							<label  for="net" class="control-label" >Total Amount :</label>
						</span>
						<span class="col-md-7">
							<input type="text" step="any" value=0.0 id="total" name="total"  class="form-control3" >
						</span>
						
	
					</div></br>
					
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="totalDiscount">Paid Amount :</label>
						</span>
						<span class="col-md-7">
							<input type="number" placeholder="0.0" step="any" id="paid_amt" name="paid_amt" oninput="calculate(1);"  class="form-control3">
						</span>
					</div></br>
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="totalDiscount">Discount :</label>
						</span>
							<span class="col-md-7">
							<span class="col-md-6">
							<input type="number"  step="any" id="discount" oninput="calculate(1);" name="discount" class="form-control3" placeholder="%">
							</span>
							<span class="col-md-4">
							<input type="number" value=0.0 step="any" id="totalDiscount" oninput="calculate(1);" name="totalDiscount" class="form-control3">
							</span>
							</span>
					</div></br>
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="totalDiscount">Balance Amount :</label>
						</span>
						<span class="col-md-7">
							<input type="number" value=0.0 step="any" id="bal_amt" name="bal_amt" oninput="calculate(1);"  class="form-control3">
						</span></br>
						</div></br>
					<div class="col-md-12" >
						<span class="col-md-4">
							<label  for="net" class="control-label" >Net Amount :</label>
						</span>
						<span class="col-md-7">
							<input type="text" step="any" value=0.0 id="totalAmt" name="totalAmt"  class="form-control3" >
						</span>
						<span><input type="submit" name="submit" value="Submit"  class="btn btn-primary"  style="margin:5px;border-radius:5px;" /></span>
	
					</div></br>
					
					
				</div>

						

		</form>
    </div>
	</section>
	
	<div class="modal fade" id="creditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Sell Customer</h4>
				</div>
				<div class="modal-body">
				<form Action="$POST">
				<table class="table table-bordered">
					<thead>
						<td>Sr No</td>
						<td>Patient</td>
						<td>Product Name</td>
						<td>Quantity</td>
						<td>Bill No </td>
						<td>Amount</td>
						</thead>
					<tbody>
					<?php 
					$bills = array();
					$query = $db->query("SELECT * FROM patients");
		             $results = $query->results();
		             //print_r($results);exit;
					 $srno=1; foreach ($results as $record) {
						$d = date(("Y-m-d"),strtotime($record['date']));
						//echo $record['created'];
						$tday = date("Y-m-d");
						$dt =array();
						if($tday == $d)	{
							
							$bills = json_decode($record['bill'], true); 
						//print_r($bills);
						$qty = 0;
						foreach($bills as $bill_data => $record1){
							//print_r($record1);
							array_push($dt,$bill_data);
							//$dt[] = $bill_data;
							//print_r($dt);
							$qty  = $qty + $record1['quantity'];
						}
						$temp = implode(',',$dt);
					?>
						<tr>
							<td>
								<?php echo $srno; ?>
							</td>
							<td ><?php echo $record['patient_name']?></td>
							<td ><?php  echo $temp;?></td>
							<td ><?php echo $qty;//$record1['quantity'];?></td>
							<td><?php echo $record['bill_no']?></td>
							<td><?php echo $record['total_amt']?></td>
							
							
						</tr>
						<?php // }  
						} $srno++; } ?>
					</tbody>
				</table>

			
  
		
		</form>

		
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<!--<button type="button" class="btn btn-primary">Save changes</button>-->
				</div>
			</div>
		</div>
	</div>
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
if (Input::exists() && Input::get('submit') != null ){
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
				
			<div class="row" style="padding-left:230px;">
            	<div id="btn">
                	
                	               	</div>
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
	<div class="modal fade" id="billsDates" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<h4>Please Select Date of the bill</h4>
					<input type="date" id="bill_date" class="form-control" name="bill_date" autofocus>
				</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
				<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="importBills();">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="pendingBillsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h2>PharmaSoft</h2>
				</div>
				<div class="modal-body">
					<h3>There are no pending DM's of this supplier!</h3>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
				</div>
			</div>
		</div>
	</div>
<!-- Modal to show detailed list of product -->
<div class="modal fade modal-details col-md-12" tabindex="-1" role="dialog" aria-labelledby="NewCompanyForm">
 	<div class="modal-dialog">
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
 					<p>Supplier name | Invoice Number | Date</p>
 					<br />
 					<input type="button" id="goto_prev" value="prev" style="display:none;">
					<input type="button" id="goto_next" value="next" style="display:none;">
 					<div class="col-md-12 details-table">
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
</div>

	<script src="script/generateFields.js"></script>
	<script src="script/searchpatient.js"></script>
	<script src="script/searchdoctor.js"></script>
	<script src="script/bootstrap.min.js"></script>
	<script src="script/detailsModal.js"></script>
	<script src="script/s_common.js"></script>
	<script>

		var counter = 2;
		var netAmnt =0, total=0;

		//Script running every 100ms to get all the input fields
		//with class "month". 
		//This is making it to dynamically write to month input field
		//in mm-yy format
		//Validation of month will be done in php when the form is
		//submitted.

		setInterval(function (){
			var month = document.getElementsByClassName('month');
			for (var i = 0; i < month.length; i++) {
			    month[i].addEventListener('keyup', function (e) {
			        var reg = /[0-9]/;
			        if (this.value.length == 2 && reg.test(this.value)) this.value = this.value + "-"; //Add colon if string length > 2 and string is a number 
			        if (this.value.length > 5) this.value = this.value.substr(0, this.value.length - 1); //Delete the last digit if string length > 5
			    });
			};
			
		}, 100);
		

		$('#addField').click( function(){
			var inputFiled = {

				'1': [{
					'tag': 'input',
					'type': 'text',
					'id': 'productName',
					'name': 'productName',
					'list': 'drugList_'+counter,
					'class': 'form-control2',
					'oninput': "detailsModal('productName_"+counter+"');"
				}],
				'2': [{
					'tag': 'input',
					'type': 'number',
					'id': 'quantity',
					'name': 'quantity',
					'class': 'form-control3',
					'oninput': 'calculate('+counter+');'
				}],
				'3': [{
					'tag': 'input',
					'type': 'number',
					'step': 'any',
					'id': 'productRate',
					'name': 'productRate',
					'class': 'form-control3',
					'oninput': 'calculate('+counter+');'
				}],
				'4': [{
					'tag': 'input',
					'type': 'number',
					'step': 'any',
					'id': 'MRP',
					'name': 'MRP',
					'class': 'form-control3'
				}],
				'5': [{
					'tag': 'input',
					'type': 'text',
					'id': 'batchNo',
					'name': 'batchNo',
					'class': 'form-control3',
					'oninput': 'calculate('+counter+');'
				}],
				'6': [{
					'tag': 'input',
					'type': 'number',
					'id': 'packSize',
					'name': 'packSize',
					'class': 'form-control3',
					'oninput': 'calculate('+counter+');'
				}],
				
				'7': [{
					'tag': 'input',
					'type': 'text',
					'id': 'expiryDate',
					'name': 'expiryDate',
					'class': 'form-control3 month'
				}],
				'8': [{
					'tag': 'input',
					'type': 'text',
					'id': 'manufacturer',
					'name': 'manufacturer',
					'class': 'form-control3',
					'oninput': 'calculate('+counter+');'
				}],
				'9': [{
					'tag': 'input',
					'type': 'Tax',
					'id': 'Tax',
					'name': 'Tax',
					'class': 'form-control3',
					'oninput': 'calculate('+counter+');'
				}],
				'10': [{
					'tag': 'input',
					'type': 'number',
					'id': 'purchaseSize',
					'name': 'purchaseSize',
					'class': 'form-control3',
					'oninput': 'calculate('+counter+');'
				}],
				'11': [{
					'tag': 'input',
					'type': 'text',
					
					'id': 'shelf',
					'name': 'shelf',
					'class': 'form-control3',
					
				}],
				'12': [{
					'tag': 'input',
					'type': 'text',
					'step': 'any',
					'id': 'cost',
					'name': 'cost',
					'class': 'form-control3',
					'oninput': 'calculate('+counter+');'
				}],
				
				
			};
			generateFields('invoiceForm', inputFiled, counter);

			getTotal(counter);

			$('#productName_'+counter).focus();

			counter++;
			$('#counter').val(counter);

			//changeDiscount();

		});


		//Check the Net Amount on invoice and Net Amount on purchase entry
		function checkAndSave(){
			var netAmount = parseFloat($('#netAmnt').val());
			var amountToCheck = parseFloat($('#net').val());

			console.log(counter);

			//if both values are same proceed to calculate the total and save
			if (netAmount == amountToCheck){
				$('#hidden').val(counter);
				getTotal(counter);
				alert('Saving Invoice!');
			}else{
				alert('Amounts do not match!');	
			}
			
		}

		//function that will update discount value in every row of inputs

		function changeDiscount(){
			for(var i=1; i < counter; i++){
				$('#discount_'+i).val(parseFloat($('#overallDisc').val()).toFixed(2));
				console.log(i);
			}
		}
     function getData(id){
			var drug = $('#productName'+id).val();
		
			console.log("getdata!!!");
			console.log(id);
			$.ajax({
				type: 'post',
				url: 'functions/s_function.php',
				dataType: 'json',
				data: {
					drug: drug,
					access: 'insertData'
				},
				success: function(data){
					console.log(data);
					//$('#quantity'+id).val(data.quantity);
					
					
			
					$('#MRP'+id).val(data.MRP);
					$('#batchNo'+id).val(data.batchNo);
					$('#packSize'+id).val(data.purchaseSize);
					$('#expiryDate'+id).val(data.expiryDate);
					
					$('#Tax'+id).val(data.Tax);
					$('#shelf'+id).val(data.shelf);
					$('#purchaseSize'+id).val(data.productQuantity);
					$('#manufacturer'+id).val(data.manufacturer);
					$('#stock'+id).val(data.stock);
				},
				error: function(data){
					console.log(data);
				}
			});
			console.log("getdataend");
		}
		
		
		function getData1(id){
			var drug = $('#patient_name').val();
		
			console.log("getdata!!!");
			console.log(id);
			$.ajax({
				type: 'post',
				url: 'functions/patient_funtion.php',
				dataType: 'json',
				data: {
					drug: drug,
					access: 'insertData'
				},
				success: function(data){
					console.log(data);
					$('#patient_address').val(data.customer_address);
					$('#phone_no').val(data.phone_no);
					$('#patient_city').val(data.city);
					$('#bal').html(data.bal_amt);
					
				},
				error: function(data){
					console.log(data);
				}
			});
			console.log("getdataend");
		}

		function getData_d(id){
			var drug = $('#doctor_name').val();
		
			console.log("getdata!!!");
			console.log(id);
			$.ajax({
				type: 'post',
				url: 'functions/doctor_funtion.php',
				dataType: 'json',
				data: {
					drug: drug,
					access: 'insertData'
				},
				success: function(data){
					console.log(data);
					$('#doctor_name').val(data.doctor_name);
					$('#doctor_city').val(data.city);
					
				},
				error: function(data){
					console.log(data);
				}
			});
			console.log("getdataend");
		}


		function calculate(count){
			
			var quantity = $('#quantity_'+count+'').val();
			var productRate = 0.0;
			var itemcost = 0.0;
			var productAmount = 0.0;
			var temp = [];
			var discount = parseFloat($('#discount').val());
			itemcost = parseFloat(parseFloat($('#quantity_'+count+'').val()) / parseFloat($('#packSize_'+count+'').val()) * parseFloat($('#MRP_'+count+'').val()));
			temp = itemcost;
			//alert(itemcost);
			$('#productRate_'+count).val(itemcost);
			//calculating discount
			/*var discount = (parseFloat($('#discount_'+count).val()) / 100) 
							* (parseFloat($('#productQuantity_'+count).val()) * parseFloat($('#purchaseRate_'+count).val()));
			//console.log("DISCOUNT -> "+discount);
*/
			if (discount == NaN){
				discount = 0.0;
			}
			var ArrMedicineCost = [];
			var AllMedicineCost=0;
			/* var totalCost = 0;
			for (var i = 1; i < count; i++){
				totalCost += parseFloat($("#cost_"+i).val());
				console.log("total cost "+totalCost);
			} */
			
			getTotal(counter);

		}

		function getTotal(counter){
	
			//Insert the discount value to the newly created row
			var bal = parseFloat($('#bal').html());
			console.log("bal "+bal);
			
			var discount = parseFloat($('#discount').val());
			var paidamt = parseFloat($('#paid_amt').val());
			//alert(paidamt);
			//$('#discount_'+counter).val(totalDiscount.toFixed(2));
			
			//Once the fields are generated, add the
			//total amount of current item and the net amount of 
			//all the items till now!
			//calculate total amount of VAT upon purchased item
			//and total amount of Discount

			//set this variable to 0 each time the script runs
			//so that it won't add up the previous one over and over
			
			var totalVat = 0, totalDiscount = 0;

			 var netAmnt = 0;TAmt=0.0; bal_amt=0;

			for(var i = 1; i < counter; i++){
				
				//Calculate total amount
				netAmnt += parseFloat($('#productRate_'+i).val());
				console.log(netAmnt);
				TAmt =( TAmt + netAmnt );
				$('#total').val(netAmnt.toFixed(2));
				//This calculate all the vat values from each fields
				//and return a fresh value!
					
				 
				//totalVat += parseFloat($('#VAT_'+i).val());
				//calculate totalDiscount
				
				if (discount != 0){
				totalDiscount = parseFloat((discount / 100)* netAmnt);
				
					TAmt = netAmnt- totalDiscount;
					if(bal!=0)
					{
					var tot = parseFloat(TAmt + bal) ;
					$('#totalAmt').val(tot.toFixed(2));
					}else{
					$('#totalAmt').val(TAmt.toFixed(2));	
					}
				    //var T_Amt = Math.round(TAmt);
				//console.log(Total +"  "+T_Amt);
				}
				else{
					$('#totalAmt').val(netAmnt.toFixed(2));
					
				}
				// calculate bal amount
				bal_amt = parseFloat(TAmt - paidamt);
				//alert(bal_amt);
			//$('#totalAmt').val(Math.round(TAmt.toFixed(2)));
				//console.log(totalVat+"  "+totalDiscount);
			//$('#totalAmt').val(TAmt.toFixed(2));
				 
			}
					
			$('#totalDiscount').val(totalDiscount.toFixed(2));
			$('#vatOnBill').val(totalVat.toFixed(2));
			$('#bal_amt').val(bal_amt.toFixed(2));
			
			
		}

		//Function to check if there are any due on the supplier
		//if yes display a modal with credit details
		function checkCredit(){
			var supplier = $('#stockist_name').val();
			if(supplier !== ''){
				$('#creditModal').modal();
			}
		}

		function checkPendingDM(){

			if ($('#stockist_name').val() !== ''){

				$.ajax({
					type: 'post',
					url: 'functions/otherFunctions.php',
					data: {option: 'DM', supplier: $('#stockist_name').val()},
					success: function(data){
						if (data == 0){
							alert("There are no pending DM's");
						}else{
							$('#pendingBillsModal div div .modal-body').html(data);
						}
					}
				});
			}else{
				alert("Please provide supplier name!");
			}
		}
/*
		function importBills(){
			//import previous saved bills
			
			var count = 1;
			var supplierName = $('#stockist_name').val();
			
			if (supplierName != ''){
				
				$('#billsDates').modal();
				
				if ($('#bill_date').val() !== ''){
					$.ajax({
						type: 'post',
						url: 'functions/otherFunctions.php',
						//dataType: 'JSON',
						data: {supplier: supplierName, date: $('#bill_date').val(), option: 'importBills'},
						success: function(data){
							if (data == 0){
								$('#pendingBillsModal').modal();
							}else{
								$('tbody').html(data);
								counter = <?php echo $GLOBALS['counter']; ?>;
								console.log(counter);
							}
						}
					});
				}
			}else{
				//alert("Enter supplier name");
			}

		}*/
	

	$('#sales_img').click(function(){
		$('#creditModal').modal();
	});
$('#message1').click(function(){
		$('#creditModal_1').modal();
	});
	
	///bill search//
	
$('#billNo').keydown(function(e){
	//alert('ello');
	if (e.which == 13){
		convert_to_bill(0, $('#billNo').val());
}
});

function convert_to_bill(bill_no, purEntry){
	console.log(purEntry);
	$.ajax({
		url: 'functions/otherFunctions.php',
		type: 'post',
		dataType: 'JSON',
		data: {
			billNo: bill_no,
			purEntry: purEntry > 0 ? purEntry : -1,
			option: 'convert_to_INV'
		},
		success: function(data){
			console.log(data);
			$('#billContent').html(data.bill);
			$('#billNo').val(data.bill_no);
			$('#billDate').val(data.billDate);
			$('#patient_name').val(data.patient_name);
			$('#phone_no').val(data.phone_no);
			$('#patient_address').val(data.patient_address);
			$('#patient_city').val(data.patient_city);
			$('#doctor_name').val(data.doctor_name);
			$('#doctor_city').val(data.doctor_city);
			$('#paid_amt').val(data.paid_amt);
			$('#discount').val(data.discount);
			$('#bal_amt').val(data.bal_amt);
			$('#totalAmt').val(data.totalAmt);
			calculate(data.count);
		}
	});
}

	</script>

</body>
</html>
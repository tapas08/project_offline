<?php

require_once('core/init.php');

$itemData = [];

$db = DB::getInstance(false);

$selectAll = $db->query("SELECT * FROM bills");

$count = $selectAll->count();
$queryResults = $selectAll->results();


?>

<!DOCTYPE <html>
<head>
	<title>Add product</title>
	<script src="script/jquery-min.js"></script>
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
	    	<div class="navbar-header">
		      	<a class="navbar-brand" href="#">
		       		Medical Shop
		      	</a>
		    </div>
		    <div class="navbar-header">
			    <ul class="nav navbar-nav">
					<li><a href="bills.php"><i class="fa fa-file-excel-o"></i> show bills</a></li>
					<li><a href="details.php"><i class="fa fa-user-md"></i> Shops Details</a></li>
				</ul>
			</div>
			<div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true" aria-labeledby="myModal-label" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" data-dismiss="modal" class="close" aria-hidden="true">&times;</button>
						<h2 class="">Data synchronized successfully!</h2>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
			<div class="navbar-header pull-right">
				<button class="btn btn-info" onclick="updateDB();" id="updateBtn" data-target="#myModal">
					<i id="spiner" class="fa fa-cog"></i> Sync Data
				</button>
			</div>
	  	</div>
	</nav>
	<article>
		<div class="col-lg-3">
			<label for="billDate">Date</label>
			<input type="date" value="<?php echo date('Y-m-d'); ?>" id="billDate" class="form-control" disabled>
		</div>
		<div class="col-lg-3">
			<label for="billNo">Bill Number</label>
			<input type="number" class="form-control" id="billNo" value="<?php echo (int)$count+1; ?>" disabled>
		</div>
		<div class="col-lg-3">
			<label for="store">Store</label>
			<input type="text" class="form-control" id="store" placeholder="Select store location" list="store-loc">
			<datalist id="store-loc">
				<option value="Nagpur"></option>
				<option value="Amravati"></option>
				<option value="Wardha"></option>
				<option value="Pune"></option>
			</datalist>
		</div>
		<div class="col-lg-3">
			<label for="customer_name">Name</label>
			<input type="text" class="form-control" id="customer_name" placeholder="Customer Name">
		</div>
	</article>

	<article>
		<form id="inventoryForm" method="post">
			<div class="row">
				<div id="itemDiv" class="purchase  col-lg-3"><h2>Item</h2></div>
				<div id="quantityDivDiv" class="purchase  col-lg-3"><h2>Quantity</h2></div>
				<div id="rateDiv" class="purchase  col-lg-3"><h2>Rate</h2></div>
				<div id="totalDiv" class="purchase  col-lg-3"><h2>Total</h2></div>
			</div>
			<div class="row">
				<div id="itemDiv" class="purchase col-lg-3">
					<select id="drugs_list_1" class="form-control" onchange="getRate('drugs_list_1', 'rate_1');">
						<option>Select drug</option>
					<?php 
						$query = $db->query("SELECT * FROM users");
						$results = $query->results();
						
						foreach ($results as $record) {
							$itemData[$record['item']] = $record['rate'];
					?>
						<option><?php echo $record['item']; ?></option>
					<?php
						}
					 ?>
				 	</select>
				</div>
				<div id="quantityDiv" class="purchase col-lg-3">
					<input type="number" class="form-control" id="quantity_1" min=1 value=0 onchange="getTotal('drugs_list_1','quantity_1', 'total_1');" oninput="getTotal('drugs_list_1', 'quantity_1', 'total_1');">
				</div>
				<div id="rateDiv" class="purchase col-lg-3">
					<output id="rate_1" class="form-control">0</output>
				</div>
				<div id="totalDiv" class="purchase col-lg-3">
					<output id="total_1" class="form-control">0</output>
				</div>
			</div>
			
		</form>
		<div id="dummy"></div>
		<div class="panel panel-primary">
			<div class="panel-body">
				<span class="pull-left">Total Amount</span>
				<span class="pull-right" id="grandTotal">0</span>
			</div>
		</div>
		<button id="submit" onclick="submit();" class="btn btn-success">SUBMIT</button>
		<a href="#" id="addMore" class="btn btn-default disabled" onclick="addMoreFields();">Add More...</a>

		<!-- Modal that will generate bill -->
		<div class="modal fade" id="myBill" tabindex="-1" aria-hidden="true" aria-labeledby="myModal-label" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" data-dismiss="modal" class="close" aria-hidden="true">&times;</button>
						<h3 id="bill_header">
							Medical Shop
						</h3>
						<h4 id="bill_details">
							<span class="active" id="showBillNum">Bill No. - </span> | 
							<span class="active" id="showBillDate">Date - </span>
						</h4>
					</div>
					<div id="bill_content" class="modal-body">
						<table class="table">
							<thead>
								<tr>
									<th>Item</th>
									<th>Quantity</th>
									<th>Rate</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody id="billContents">

							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<div class="well" id="totalAmnt">
							Grand Total - 0
						</div>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Confirm</button>
					</div>
				</div>
			</div>
		</div>

		<button id="generateBill" onclick="generateBill()" class="btn btn-warning" data-target="#myBill" data-toggle="modal" disabled>Generate Bill</button>
	</article>
	<div>
		<input type="hidden" id="drugsList" list="dynamicOptions">
		<datalist id="dynamicOptions">
			<?php 
				$query = $db->query("SELECT * FROM users");
				$results = $query->results();
				
				foreach ($results as $record) {
					$itemData[$record['item']] = $record['rate'];
			?>
				<option value="<?php echo $record['item']; ?>"></option>
			<?php
				}
			 ?>
		</datalist>
	</div>
	<script src="script/bootstrap.min.js"></script>
	<script type="text/javascript" src="script/create.js"></script>
	<script type="text/javascript">
		var itemData = <?php echo json_encode($itemData) ?>;
		var x = 2;
		var list = {};
		var rate;
		var grandTotal = 0, tempTotal;
		function getRate(value_id, display_id){
			delete rate;
			var item = document.getElementById(value_id).value;
			document.getElementById(display_id).innerHTML = itemData[item];
			rate = itemData[item];
		}

		function getTotal(drugs_list, value_id, display_id){
			var name = document.getElementById(drugs_list).value;
			var quantity = document.getElementById(value_id).value;
			var item = document.getElementById(display_id).value;
			var total = quantity * parseInt(rate);
			document.getElementById(display_id).innerHTML = total;
			//console.log(drugs_list);
			list[drugs_list] = {'name': name, 'quantity': quantity, 'total': total};
			//console.log(list);
			tempTotal = total;
			$('#addMore').removeClass("disabled");
			document.getElementById('generateBill').removeAttribute("disabled");
		}


		function submit(){
			var customer_name = document.getElementById("customer_name").value;
			var billdate = document.getElementById("billDate").value;
			var location = document.getElementById("store").value;
			var billNo = document.getElementById("billNo").value;
			$.ajax({
				type: "post",
				url: "update.php",
				data: {dataArray : list, name : customer_name, date : billdate, store : location, number : billNo},
				success: function(data){
					window.location.reload();
					//console.log(data);
				}
			});
			localStorage.updateValues = JSON.stringify(list);
		}

		function updateDB(){
			//$('#spinner').addClass("fa-spin");
			document.getElementById("updateBtn").innerHTML = "<i class='fa fa-cog fa-spin'></i> Syncing Data";
			//if(localStorage.updateValues){
				var updatedList = JSON.parse(localStorage.updateValues);
				//console.log(updatedList);
				$.ajax({

					type: "post",
					url: "sync.php",
					data: {update: updatedList},
					success: function(data){
						if(data == "false"){
							localStorage.clear();
							$('#myModal').modal('show');
							document.getElementById("updateBtn").innerHTML = "<i class='fa fa-cog'></i> Sync Data";
						}else{
							console.log(data);
						}
					}

				});
			// }else{
			// 	console.log("NOthing to post!");
			// }
		}

		function getList(){
			console.log(itemData);
			var ip = document.getElementById("drugsList").value;
			var temp, item;
			if(ip != ''){
				$.each(itemData, function(key, value){
					if(key.search(ip) > -1){console.log(key+" "+ip);
						var listOption = document.createElement("option");
						var optionText = document.createAttribute("value");
						optionText.value = key;
						listOption.setAttributeNode(optionText);
						document.getElementById("dynamicOptions").appendChild(listOption);
						temp = ip;
					}
				});
				return false;
			}
			
		}

		function generateBill(){
			document.getElementById("showBillNum").innerHTML = "Bill No. - "+document.getElementById("billNo").value;
			document.getElementById("showBillDate").innerHTML = "Date - "+document.getElementById("billDate").value;
			var amnt = 0;
			$.each(list, function(key, value){
				var tr = document.createElement("tr");
				var td_item = document.createElement("td");
				var name = document.createTextNode(value['name']);
				td_item.appendChild(name);
				tr.appendChild(td_item);

				var td_quantity = document.createElement("td");
				var quantity = document.createTextNode(value['quantity']);
				td_quantity.appendChild(quantity);
				tr.appendChild(td_quantity);

				var td_rate = document.createElement("td");
				var rate = document.createTextNode(itemData[value['name']]);
				td_rate.appendChild(rate);
				tr.appendChild(td_rate);

				var td_total = document.createElement("td");
				var total = document.createTextNode(value['total']);
				td_total.appendChild(total);
				tr.appendChild(td_total);

				amnt = parseInt(amnt) + parseInt(value['total']);
				console.log(amnt);

				document.getElementById("billContents").appendChild(tr);
				document.getElementById("totalAmnt").innerHTML = "Grand Total - "+amnt;
			})

		}

	</script>
</body>
</html>
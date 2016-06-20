<?php

require_once('includes/config.php');
$bills =new bills;
$result_bill = $bills->select($bills->table);

?>

<!DOCTYPE html>
<head>
	<title>Sell</title>
	<script src="script/jquery-min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/theme.css"> -->
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/style2.css"> -->
	<script src="script/jquery.mtz.monthpicker.js"></script>
	<script>
			// $('document').ready(function(){
			// 	//alert('hi');
			// 	$('#resultdata').load('show_search_bill.php');
				
			// 	$('#searchby').keyup(function(){
			// 		var sdata=$("#searchby").val();
			// 		//alert(sdata);
			// 		$('#resultdata').load('show_search_bill.php?getsearchdata='+sdata);
			// 		//alert(datas);
			// 	});
				
			// });
	</script>
	<style>
		.form-control{
			width: 100%;
		}

		label{
			margin-left: 5px;
		}

		#bill_content_details{
			height: 400px;
			overflow: auto;
		}

	</style>
</head>
<body>
	<div class="row">
		<?php include('templates/eventheader.php'); ?>
	</div>

	<div class="conatainer col-md-12">

        <form method="post" id="addForm" action="" autocomplete="off">

			<div class="row">
				<div class="col-md-2">
					<h2 class="text-warning text-center" style="margin-top: 0px">Bill searching</h2>	
				</div>
				<div class="col-md-10">
					<h4 class="text-info" id="Message">SEARCHING A BILL FOR SALE RETURN / MODIFICATION</h4>
				</div>
			</div>
			
			<div class="container">		
				<div class="row col-md-12">
					<div class="col-md-6">
						<div class="form-group col-md-4">
							<span class="col-md-4"><label for="year" class="control-label">Year</label></span>
							<span class="col-md-8">
								<select name="year" id="year" class="form-control">
									<option>2015-16</option>
									<option>2014-15</option>
									<option>2013-14</option>
									<option>2012-13</option>
									<option>2011-12</option>
									<option>2010-11</option>
								</select>
							</span>
						</div>
						
						<div class="form-group col-md-4">
							<span class="col-md-4"><label for="billType" class="control-label">BillType</label></span>
							<div class="col-md-4">
								<select name="billType" id="billType" class="form-control">
									<option value="C">C</option>
									<option value="E">E</option>
									<option value="G">G</option>
								</select>
							</div>
						</div>
						
						<div class="form-group col-md-4">
							<span class="col-md-4"><label for="bill_no" class="control-label">By Bill no</label></span>
							<span class="col-md-8">
								<input type="text" id="bill_no" class="form-control" name="bill_no" placeholder="Bill number"  oninput="searchByBill();">
							</span>
						</div>
						
						<div class="form-group col-md-6">
							<span class="col-md-4"><label for="sdate" class="control-label">From date</label></span>
							<span class="col-md-8">
								<input type="date" id="sdate" class="form-control" name="sdate" value="2015-04-01" required>
							</span>
						</div>
						
						<div class="form-group col-md-6">
							<span class="col-md-4"><label for="edate" class="control-label">To date</label></span>
							<span class="col-md-8">
								<input type="date" id="edate" class="form-control" name="edate" value="<?php echo date('Y-m-d') ?>" required>
							</span>
						</div>

						<div class="form-group col-md-6">
							<span class="col-md-4"><label for="searchByName"><!--<i class="fa fa-plus-square"></i>-->By name</label></span>
							<span class="col-md-8">
								<input type="text" id="Name" class="form-control" name="Name" placeholder="name"  oninput="searchByName();" />
							</span>
						</div>
						
						<div class="form-group col-md-6">
							<span class="col-md-4"><label for="searchByProduct">By product</label></span>
							<span class="col-md-8"><input type="text" id="Product" class="form-control" name="Product" placeholder="product name" oninput="searchByProduct();"></span>
						</div>

						<div class="form-group col-md-6">
							<input type="reset" name="reset" value="Cancel" class="btn btn-success">
							<input type="submit" name="submit"  value="Exit" class="btn btn-success">
						</div>
					</div>
					<div class="col-md-offset-1 col-md-5" style="padding-left:0px;height:300px; overflow:auto;">
						<input type="button" id="goto_prev" style="visibility:hidden;" value="prev">
						<input type="button" id="goto_next" style="visibility:hidden;" value="next">
						<table class="table table-bordered table-condensed" id="bill_list">
							<thead class="text-center">
								<td>#</td>
								<td>Bill No</td>
								<td>Date</td>
								<td>Amount</td>
								<td>Patient</td>
							</thead>
							<tbody id="bill_table"></tbody>
						</table>
					</div>
				</div>
			</div>
		</form>
	
		<div class="container" id="bill_content_details">
		<form action="sells.php" method="post">
			<table class="table table-bordered table-condensed">
				<thead class="bg">
						<td>Sr.no</td>
						<td>Bill No</td>
						<td>Product Name</td>
						<td>Batch No.</td>
						<td>Pr Rate</td>
						<td>Qty</td>
						<td>Amnt</td>
				</thead>
				<tbody id="bill_details">
				</tbody>
				
			</table>
			<div class="form-group col-md-6">
				<input type="submit" name="submit"  value="submit" class="btn btn-success">
			</div>
			</form>
		</div>
	</div>


		<script src="js/searchBills.js"></script>
		<script type="text/javascript">
			$('document').ready(function(){
			//$('#resultdata').load('sell.php');
				//alert('Page Ready');
				//$('.textbox').hide();
				//$('.save').hide();
				
				
				$('#searchby').change(function(){
					
					var datas =$(this).val();
					//alert(datas);
				
					$.ajax({
					url: 'show_search_bill.php',
					type: 'get',
					cache: false,
					data: {datas : datas},
					success: function(res) {
					$('#resultdata').append(res);}
	      
	   				});
				});
			});
		</script>	
				
</body>
</html>	
<?php
require_once('core/init.php');

$db = DB::getInstance();
$productGroup = [];
$message = [];

if (Input::exists() && Input::get('submitUpdate') != null){
	$insert = $db->insert('items', array(
			'manufacturer'	=> Input::get('productManftr'),
			'marketedBy'	=> Input::get('productMarketedBy'),
			'productName'	=> Input::get('productName'),
			'packSize'		=> Input::get('productPackSize'),
			'productRate' 	=> Input::get('productRate'),
			'MRP' 			=> Input::get('productMRP'),
			'Tax' 			=> Input::get('productTax'),
			'shelf' 		=> Input::get('productShelf'),
			'mainCategory' 	=> Input::get('productMainCategory'),
			'subCategory' 	=> Input::get('productSubCategory'),
			'productType' 	=> Input::get('productType'),
			'productGroup' 	=> Input::get('productGroup'),
			'orderQuantity' => Input::get('productOrderQuantity'),
			'quantity' 		=> Input::get('productQuantity'),
			'VAT' 			=> Input::get('productVat'),
			'reorderLvl' 	=> Input::get('productReorderLvl'),
			'drugContent' 	=> Input::get('productContent')
		));

	print_r($_POST);

	if ($insert){
		$message[] = "New Product Saved";
	}else{
		$message[] = "SOmething went wrong!!!";
	}
}

?>

<!DOCTYPE <html>
<head>
	<title>Update Inventory</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>
<body>

<?php include('templates/header.php'); ?>

<section class="container" id="formArea">
	<div>
	
		<?php
		if (count($message) > 0){
			foreach($message as $msg){
				echo "<p class='alert alert-info'>$msg</p>";
			}
		}
		?>

	</div>
	<?php 
		if (Input::get('modifyPurchase') != null){
			include('forms/modifyPurchase.php');
		}else if (Input::get('deletePurchase') != null){
			include('forms/deletePurchase.php');
		}else{
			include('forms/purchaseMode.php'); 
		}

	?>
</section>	

<div class="modal fade modal-newCustSupp col-md-12" tabindex="-1" role="dialog" aria-labelledby="CustomeSupplierForm">
 	<div class="modal-dialog" style="width: 1000px;">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 				<h4 class="center">Customer/Supplier</h4>
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

<div class="modal fade modal-newProductType" tabindex="-1" role="dialog" aria-labelledby="NewProductTypeForm">
 	<div class="modal-dialog">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 				<h4 class="center">Product Type</h4>
 			</div>
 			<div class="modal-body">
 				<div class="container-fluid">
 				<div id="productTypeMsg"></div>
 				<?php include('forms/productType.php'); ?>
 				<div class="modal-footer col-md-12">
 					<input type="reset" id="cancel" name="cancel" class="btn btn-primary">
 					<input type="button" id="deleteType" name="deleteType" value="Delete" class="btn btn-primary" onclick="deleteType();">
					<button id="saveType" name="saveType" class="btn btn-primary" onclick="saveType();">(F10) Save <b>/</b> Update</button>
					<button id="exitForm" name="exitForm" class="btn btn-primary" data-dismiss="modal">(Esc) Exit</button>
				</div>
 				</div>
 			</div>
 		</div>
 	</div>
</div>

<div class="modal fade modal-newDrugContent" tabindex="-1" role="dialog" aria-labelledby="NewDrugContent">
 	<div class="modal-dialog">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 				<h4 class="center">Drug Content</h4>
 			</div>
 			<div class="modal-body">
 				<div class="container-fluid">
 				<div id="drugContentMsg"></div>
 				<?php include('forms/drugContent.php'); ?>
 				<div class="modal-footer col-md-12">
 					<input type="reset" id="cancel" name="cancel" class="btn btn-primary">
 					<input type="button" id="deleteType" name="deleteType" value="Delete" class="btn btn-primary" onclick="deleteDrugContent();">
					<button id="saveType" name="saveType" class="btn btn-primary" onclick="saveDrugContent();">(F10) Save <b>/</b> Update</button>
					<button id="exitForm" name="exitForm" class="btn btn-primary" data-dismiss="modal">(Esc) Exit</button>
				</div>
 				</div>
 			</div>
 		</div>
 	</div>
</div>

<script type="text/javascript" src="script/jquery-min.js"></script>
<script type="text/javascript" src="script/bootstrap.min.js"></script>
<script type="text/javascript" src="script/purchase.js"></script>
<script>
	var vatArray = <?php echo json_encode($productGroup); ?>;
	document.getElementById('productVat').value = vatArray[document.getElementById('productGroup').value];
</script>
<script type="text/javascript" src="script/common.js"></script>
<script src="script/save.js"></script>
</body>
</html>
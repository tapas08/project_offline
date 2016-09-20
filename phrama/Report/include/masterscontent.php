<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<div id="block_bg" class="block">
                
		<div class=" row block-content collapse in">
               	<div class="row">
					<div class="header"><i class="icon-suitcase">&nbsp; MASTERS</i></div>
				</div>
                <div class="content span12">
    	        	<div class=" span4 pre-scrollable">
						<ul class="nav nav-stacked">
							<li><a href="#" onclick="generateMasterReport('customers');">CUSTOMERS LIST</a></li>
							<li><a href="#" onclick="generateMasterReport('company_name', 'item');">MFG WISE ITEM LIST</a></li>
							<li><a href="#" onclick="generateMasterReport('stockist_name');">SUPPLIERS LIST</a></li>
							<li><a href="#" onclick="generateMasterReport('company_name');">MANUFACTURER LIST</a></li>
							<li><a href="#">PRODUCT CATEGORY</a></li>
							<li><a href="#">ITEM SUMMERY</a></li>
							<li><a href="#">CATEGORY WISE ITEM LIST</a></li>
							<li><a href="#">NEW ITEM BETWEEN DATE</a></li>
						</ul>
					</div>
                    <?php include('include/form.php'); ?>
               </div>
			</div>
		
</div>
</body>
</html>
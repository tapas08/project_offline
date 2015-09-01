<!DOCTYPE html>
<html>
<head>
	<title>Work Offline</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="script/jquery-min.js"></script>
</head>
<body>

	<nav>
		<header><h1>This and That Store</h1></header>
		<ul>
			<li><a href="#">Sell</a></li>
			<li><a href="inventory.php">Update Inventory</a></li>
		</ul>
	</nav>

	<article>
		<section class="left">
			<form id="sellForm" method="POST">
				<div id="element1" class="formElements">
					<label for="product1">Item1</label>
					<select id="drugOption1" onchange="getValue('drugOption1');">
						<option>SELECT</option>
						<option>Drug 1</option>
						<option>Drug 2</option>
						<option>Drug 3</option>
						<option>Drug 4</option>
						<option>Drug 5</option>
						<option>Drug 6</option>
					</select>
					<input type="number" min=1 value=0 id=1 onchange="getQuantity('1')" oninput="getQuantity('1')" disabled>
				</div>
				<a href="#" id="addMore" onclick="addMore();">Add More...</a>
			</form>
		</section>
		<section class="right" id="right">
			<fieldset>
				<legend>Items Purchased</legend>
				<div id="listOfDrugs">
					<ol id="selectedList">
						
					</ol>
					<button type="submit" id="billButton" hidden>Submit</button>
				</div>
			</fieldset>
		</section>
	</article>

	<script type="text/javascript" src="script/process.js"></script>
	<script>
	var flag;

    setInterval(function() {
    	//console.log(itemsPurchased);

	  $.ajax({
	    url: "process.php",
	    success: function(data){
	   		// console.log(data);
	  				data == "true" ? 
	  						(flag = 1) : (flag = 0);
	  			},
	  })

	  if(flag == 1){
	  	console.log("database connected!");
	  }else{
	  	console.log("Database disconnected!");
	  }
	  //console.log(flag);

	}, 1*1000);

    document.getElementById("billButton").onclick = function(){
    	console.log(flag);
    	if (flag == 1){
    		$.ajax({
    			type: "post",
    			url: "update.php",
    			data: {dataArray : itemsPurchased},
    			success: function(data){
    				console.log(data);
    			}
    		});
    	}else{
    		makeWay(itemsPurchased);
    	}
    }

	function makeWay(a){
		console.log("Here aare we!");
		if (a != temp){
			$.ajax({

				type: "post",
				url: "makeWay.php",
				data: {dataArray : a},
				success: function(result){
					console.log(result);
				}

			});
		}

		var temp = a;

	}
		
	</script>

</body>
</html>

<form Action="$POST">

	
					<table class="table table-bordered">
					<thead>
						<td>Sr No</td>
						
						
						<td>Patient</td>
	
						<td>Bill No </td>
						<td>Amount</td>
						
					</thead>
					<tbody>
					<?php 
					require_once('../core/init.php');
	                $db = DB::getInstance();
		            $query = $db->query("SELECT * FROM patients");
		             $results = $query->results();
		             //print_r($results);exit;			

					
					$srno=1; foreach ($results as $record) {
						$d = date(("Y-m-d"),strtotime($record['created']));
						//echo $record['created'];
						$tday = date("Y-m-d");
						if($tday == $d)	{
					?>
						<tr>
							<td>
								<?php echo $srno; ?>
									
									<?php 
									/*	$query = $db->query("SELECT * FROM purchase");
										$results = $query->results();
							
										foreach ($results as $record) {
										$itemData[$record['productName']] = $record['productName'];*/
									?>
									<!--<option value="<?php// echo $record['productName']; ?>"><?php // echo $record['productName']; ?></option>-->
									<?php
									//	}
									?>

									<!--</datalist>-->
								
							</td>
							<td ><?php echo $record['patient_name']?></td>
							<td></td>
							<td></td>
							
							
						</tr>
						<?php } $srno++; } ?>
					</tbody>
				</table>

			
  
				</form>

		
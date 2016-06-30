<?php

require_once '../core/init.php';

switch (Input::get('access')) {
	
	case 'searchBill':
		searchBill();
		break;
	case 'searchBillp':
		searchBillp();
		break;
	
	case 'get_bill_details':
		get_bill_details();
		break;
	default:
		break;
}

function searchBill(){
	if (Input::exists()){
		$db =  DB::getInstance();

		$getBills = $db->get("patients", array(Input::get('search_by'), '=', Input::get('search_term')));

		if ($getBills && $getBills->count() > 0){
			$x = 1;
			foreach ($getBills->results() as $row => $bill){
				echo "<tr>";
				echo "<td>$x</td>";
				echo "<td>" . $bill['bill_no'] . "</td>";
				echo "<td>" . $bill['date'] . "</td>";
				echo "<td>" . $bill['total_amt'] . "</td>";
				echo "<td>" . $bill['patient_name'] . "</td>";
				echo "</tr>";
				$x++;
			}
		}else{
			echo "No Bills!";
		}
	}
}


function searchBillp(){
	
	$db =  DB::getInstance();
	 $drug = Input::get('prod');
	

	$from = date("Y-m-d",strtotime(Input::get('from')));
	$to   = date("Y-m-d",strtotime(Input::get('to')));
	//$getbill = $db->get("patients", array('date', '=',"$from" ));
	//$getbill = DB::getInstance()->query("SELECT * from patients WHERE  date = ?",array($from));
	
	//print_r($getbill);

		//if ($getbill->count() > 0){
			
			while(strtotime($from) <= strtotime($to))
			{
				$getbill = $db->get("patients", array('date', '=',$from ));
				//echo $getbill->count();
				if ($getbill->count() > 0){
					//echo $getbill->count()." -> $from <br>";
					foreach ($getbill->results() as $row => $bills){
					$bill_content = json_decode($bills['bill'], true);
					
					$i = 0;
					$key = array_keys($bill_content);
					$x = 1;
					//print_r($key);
					foreach ($bill_content as $bill){
						
					if($drug == $key[$i])
					{
					//print_r($keys);
					

					
					echo "<tr>";
					echo "<td>$x</td>";
					echo "<td>" . $bills['bill_no'] . "</td>";
					echo "<td>" . $bills['date'] . "</td>";
					echo "<td>" . $bills['total_amt'] . "</td>";
					echo "<td>" . $bills['patient_name'] . "</td>";
					echo "</tr>";
					
					}
					
					
					$i++;
					}
				$x++;
					
				
				}
			}
		$from = date("Y-m-d", strtotime('+1 day',strtotime($from)));
		//echo $from;
			
	}
	// }else{
	// 		echo "No Bills!";
	// 	}
		
		}

function get_bill_details(){
	if (Input::exists()){
		$db = DB::getInstance();

		$bill_details = $db->get("patients", array("bill_no", "=", (int)Input::get('bill_no')));

		if ($bill_details && $bill_details->count()){
			$x = 1;
			foreach ($bill_details->results() as $data => $bill1){
				$bill_content = json_decode($bill_details->first()['bill'], true);
				print_r($bill_content);
				$i = 0;
				$keys = array_keys($bill_content);
				//print_r($keys);
				foreach ($bill_content as $bill){
					echo "<tr>";
					echo "<td>$x<input type='checkbox' name='selector[]' value='".$keys[$i].",".$bill1['patient_name'].",".$bill1['bill_no']."' ></td>";
					echo "<td>". $bill1['bill_no'] ."</td>";
					echo "<td>". $keys[$i] ."</td>";
					echo "<td>". $bill['batchNo'] ."</td>";
					echo "<td>". $bill['productRate'] ."</td>";
					echo "<td>". $bill['quantity'] ."</td>";
					echo "<td>". $bill['total_amt'] ."</td>";
					echo "</tr>";
					$i++;
					$x++;
				}
			}

		}

	}
}


<?php

require_once '../core/init.php';

switch (Input::get('access')) {
	case 'searchBill':
		searchBill();
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
/*
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
*/
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


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
function get_bill_details(){
	if (Input::exists()){
		$db = DB::getInstance();

		$bill_details = $db->get("patients", array("bill_no", "=", (int)Input::get('bill_no')));

		if ($bill_details && $bill_details->count()){
			$x = 1;
			foreach ($bill_details->results() as $data => $bill1){
				/*$bill_content = json_decode($bill_details->first()['bill'], true);
				//print_r($bill_content);
				$i = 0;
				$keys = array_keys($bill_content);
				//print_r($keys);
				foreach ($bill_content as $bill){ */
					echo "<tr>";
					echo "<td>$x</td>";
					echo "<td><input type='text' step='any' name='billNo' id='billNo'  class='form-control3' value='".$bill1['bill_no']."'></td>";
					echo "<td><input type='text' step='any' name='patient_name' id='patient_name'  class='form-control2' value='".$bill1['patient_name']."'></td>";
					echo "<td><input type='text' step='any' name='total' id='total'  class='form-control3'  value='".$bill1['total']."'></td>";
					echo "<td><input type='text' step='any' name='discount' id='discount'  class='form-control3' value='".$bill1['discount']."'></td>";
					echo "<td><input type='text' step='any' name='totalDiscount' id='totalDiscount'  class='form-control3' value='".$bill1['totalDiscount']."'></td>";
					echo "<td><input type='text' step='any' name='paid_amt' id='paid_amt' oninput='calculate();' class='form-control3' value='".$bill1['paid_amt']."'></td>";
					echo "<td><input type='text' step='any' name='bal_amt' id='bal_amt' oninput='calculate();' class='form-control3' value='".$bill1['bal_amt']."'></td>";
					echo "<td><input type='text' step='any' name='totalAmt' id='totalAmt'  class='form-control3' value='".$bill1['total_amt']."'></td>";

					echo "</tr>";
					$i++;
					$x++;
				
			}

		}

	}
}


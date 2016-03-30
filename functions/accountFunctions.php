<?php  
require_once '../core/init.php';

switch (Input::get('access')) {
	case 'getInvoice':
		getInvoice();
		break;

	case 'getList':
		getList();
		break;

	case 'makePayment':
		makePayment();
		break;
	
	default:
		# code...
		break;
}

function getInvoice(){
	if (Input::exists()){
		$x = 1;
		$db = DB::getInstance();
		$data = [];
		$total = 0.0;
		$data['row'] = '';

		$from = date('Y-m-d', strtotime(Input::get('from')));
		$to = date('Y-m-d', strtotime(Input::get('to')));

		//echo Input::get('supplier_name')."<br>";

		while ($from != $to):
			//echo $from;
			$getInvoice = $db->query("SELECT * FROM purchaseInvoice WHERE 
					supplier = ? AND
					billDate = ?
				", array(
						Input::get('supplier_name'),
						$from
					));

			if (!$getInvoice->error()){
				//print_r($getInvoice->results());
				if ($getInvoice->count() > 0){
					foreach ($getInvoice->results() as $invoiceDetails => $invoice){
						$data['row'].="<tr>";
						$data['row'].="<td>$x</td>";
						$data['row'].="<td>".$invoice['billDate']."</td>";
						$data['row'].="<td>".$invoice['invoiceNumber']."</td>";
						$data['row'].="<td>".DB::getInstance()->get('purchaseBills', array('date', '=', $invoice['billDate']))->count()."</td>";
						$data['row'].="<td>".$invoice['netAmount']."</td>";
						$data['row'].="<td>N/A</td>"; // TODO
						$data['row'].="<td>N/A</td>"; // TODO
						$data['row'].="<td>".$invoice['discount']."</td>";
						$data['row'].="<td>N/A</td>"; // TODO
						$data['row'].="<td>N/A</td>"; // TODO
						$data['row'].="</tr>";

						$total += $invoice['netAmount'];
					}
				}
			}
			$from = date('Y-m-d', strtotime('+1 day', strtotime($from)));
			$x++;
		endwhile;
		$data['total'] = $total;

		echo json_encode($data);
	}
}

function getList(){
	if (Input::exists()){
		$db = DB::getInstance();

		$searchTerm = Input::get('supplier_name');
		$searchTerm = "%$searchTerm%";

		$get = $db->query("SELECT * FROM stockist_name WHERE `name` = ?", array($searchTerm));
		print_r($get);

		if (!$get->error() && $get->count() > 0){
			foreach ($get->results() as $key => $value) {
				echo "<option value='",$value['abbreviation'],"'>{$value['abbreviation']}  {$value['name']}</option>";
			}
		}
	}
}

function makePayment(){
	if (Input::exists()){
		$db = DB::getInstance();

		$bank = Input::get('bank');
		$supplier_name = Input::get('supplier_name');
		$check_no = Input::get('check_no');
		$check_date = Input::get('check_date');
		$paid = Input::get('amount_paid');
		$balance = Input::get('balance');

		$pay = $db->insert('payment', array(
				'bank' => $bank,
				'supplier' => $supplier_name,
				'check_no' => $check_no,
				'check_date' => $check_date,
				'paid' => $paid,
				'balance' => $balance,
				'payment_date' => date('d-m-Y')
			));

		if ($pay){
			echo "<p class='text-success'>Transaction Completed</p>";
		}else{
			echo "<p class='text-danger'>Transaction Failed! Please try again.</p>"
		}
	}
}
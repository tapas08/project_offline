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

	case 'paid_ledger':
		paidLedger();
		break;

	case 'getHeadList':
		getHeadList();
		break;

	case 'getPayments':
		getPayments();
		break;

	case 'updatePayment':
		updatePayment();
		break;

	case 'getMFGNames':
		getMFGNames();
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
						if ($invoice['balance'] != 0):
							$data['row'].="<tr>";
							$data['row'].="<td><input type=\"checkbox\" id='inv_$x' name='inv_$x' value='".$invoice['invoiceNumber']."/". $invoice['balance'] ."'></td>";
							$data['row'].="<td>$x</td>";
							$data['row'].="<td>".$invoice['billDate']."</td>";
							$data['row'].="<td>".$invoice['invoiceNumber']."</td>";
							$data['row'].="<td>".DB::getInstance()->get('purchaseBills', array('date', '=', $invoice['billDate']))->count()."</td>";
							$data['row'].="<td>".$invoice['netAmount']."</td>";
							$data['row'].="<td>". ($invoice['netAmount'] - $invoice['balance']) ."</td>";
							$data['row'].="<td>". $invoice['balance'] ."</td>";
							$data['row'].="<td>".$invoice['discount']."</td>";
							$data['row'].="<td>N/A</td>"; // TODO
							$data['row'].="<td>N/A</td>"; // TODO
							$data['row'].="</tr>";

							$total += $invoice['netAmount'];
							$x++;
						endif;
					}
				}
			}
			$from = date('Y-m-d', strtotime('+1 day', strtotime($from)));
		endwhile;
		$data['total'] = $total;

		echo json_encode($data);
	}
}

function getList(){
	if (Input::exists()){
		$db = DB::getInstance();

		$name = strtoupper(Input::get('supplier_name'));
		$name = "%$name%";

		$list = $db->query("SELECT * FROM stockist_name WHERE name LIKE ?", array($name));

		if ($list->count()){
			foreach ($list->results() as $key => $stockist){
				echo "<option>". $stockist['name'] ."</option>";
			}
		}

	}
}

function getHeadList(){
	if (Input::exists()){
		$db = DB::getInstance();
		$searchTerm = strtoupper(Input::get('head_name'));
		$searchTerm = "%$searchTerm%";

		// Search Parent Heads
		$parent_heads = $db->query("SELECT * FROM parent_head WHERE name LIKE ?", array($searchTerm));

		if ($parent_heads->count()){
			// print_r($parent_heads->results());
			foreach ($parent_heads->results() as $parent_head => $head) {
				echo "<option value='".$head['name']."'>".$head['head_id']." --- ".$head['name']."</option>";
			}
		}

		// Search Child Heads

		$child_heads =  $db->query("SELECT * FROM child_heads WHERE name LIKE ?", array($searchTerm));

		if (!$child_heads->error() && $child_heads->count() > 0){
			foreach ($child_heads->results() as $key => $value) {
				echo "<option value='",$value['name'],"'>{$value['child_id']}  {$value['name']}</option>";
			}
		}
	}
}

function makePayment(){
	if (Input::exists()){
		$db = DB::getInstance();

		$receipt_no = $db->query("SELECT * FROM supplier_payment")->count() + 1;
		$voucher_number = $db->query("SELECT * FROM payment")->count() + 1;

		$paid_via = Input::get('bank');
		$supplier_name = Input::get('supplier_name');
		$check_no = Input::get('check_no');
		$check_date = Input::get('check_date');
		$paid = Input::get('amount_paid');
		$balance = Input::get('balance');
		$invoice_numbers = Input::get('invoiceNumber');
		
		// Calculate balance
		$balance = (int)Input::get('total_amount') - $paid;

		$pay = $db->insert('supplier_payment', array(
				'supplier' => rtrim($supplier_name),
				'paid_via' => $paid_via,
				'check_no' => $check_no,
				'check_date' => date('Y-m-d', strtotime($check_date)),
				'paid_to' => json_encode($invoice_numbers),
				'amount_paid' => $paid,
				'amount_balance' => $balance,
				'payment_date' => date('Y-m-d'),
				'v_no' => $voucher_number
			));

		$particular = $paid_via . " Check No." . $check_no . " " . $check_date . " PP No: " .$receipt_no;

		//$head_ids = explode("/", getHeadId($supplier_name, 'child', true));

		$supplier_id = DB::getInstance()->get('stockist_name', array('name', '=', $supplier_name))->first()['id'];

		$payment = $db->insert('payment', array(
				'paid_to' 	 => $supplier_name,
				'head_id' 	 => "PR$supplier_id",
				'amount'  	 => $paid,
				'particular' => $particular,
				'receipt_no' => $receipt_no,
				'v_type'	 => 'PR',
				'date'		 => date('Y-m-d')
			));

		if ($pay && $payment){
			echo "<p class='text-success'>Transaction Completed</p>";

			// Update each entry in purchaseInvoice with paid status
			foreach ($invoice_numbers as $key => $value){
				$db->update('purchaseInvoice', array('invoiceNumber', '=', $value), array(
							'balance' => '0'
						));
			}

		}else{
			echo "<p class='text-danger'>Transaction Failed! Please try again.</p>";
		}
	}
}

function paidLedger(){
	if (Input::exists()){
		$db = DB::getInstance();
		$data = [];

		$data['list'] = '';
		$data['amount'] = 0;
		
		// Get details of head
		$head_info = DB::getInstance()->get('child_heads', array('name', '=', Input::get('head_name')));

		$parent_head = DB::getInstance()->get('parent_head', $head_info->count() ? 
			array('head_id', '=', $head_info->first()['parent_id']) : 
				array('name', '=', Input::get('head_name')));

		$ledgers = DB::getInstance()->query("SELECT * FROM payment WHERE paid_to = ? ORDER BY id DESC LIMIT 7", array($head_info->count() ? $head_info->first()['name'] : $parent_head->first()['name']));

		if ($ledgers->count()){
			$x = 1;
			foreach ($ledgers->results() as $payment_details => $detail){
				$data['list'] .= "<tr>";
				$data['list'] .= "<td>". $x ."</td>";
				$data['list'] .= "<td>". $detail['date'] ."</td>";
				$data['list'] .= "<td> 0 </td>"; /* Credit */
				$data['list'] .= "<td>". $detail['amount'] ."</td>";
				$data['list'] .= "<td>". $parent_head->first()['name'] ."</td>";
				$data['list'] .= "<td>". $detail['particular'] ."</td>";
				$data['list'] .= "<td>". $detail['receipt_no'] ."</td>";
				$data['list'] .= "<td>". $detail['v_type'] ."</td>";
				$data['list'] .= "</tr>";
				$data['amount'] = $detail['amount'];
				$x++;
			}
		}
		echo json_encode($data);
	}
}

function saveLedger(){
	if (Input::exists()){
		$db = DB::getInstance();

		
	}
}

function getPayments(){
	if (Input::exists()){
		$db = DB::getInstance();
		$data = [];
		$payment = $db->query("SELECT * FROM supplier_payment WHERE supplier = ? ORDER BY id DESC", array(Input::get('supplier_name')));
		if ($payment->count()){
			$data['amount'] = $payment->first()['amount_paid'];
			$data['v_no'] = $payment->first()['id'];
			$data['paid_via'] = $payment->first()['paid_via'];
			$data['check_no'] = $payment->first()['check_no'];
			$data['check_date'] = $payment->first()['check_date'];
			$data['date'] = $payment->first()['payment_date'];
			$x = 1;
			$data['row'] = '';
			foreach (json_decode($payment->first()['paid_to'], true) as $paid_to => $inv_no){
				// Get details of each invoice

				$invoiceDetails = $db->get("purchaseInvoice", array('invoiceNumber', '=', $inv_no));

				if ($invoiceDetails->count()){
					// Print out details in a row
					$data['row'].="<tr>";
					$data['row'].="<td><input type=\"checkbox\" id='inv_$x' name='inv_$x' value='".$invoiceDetails->first()['invoiceNumber']."/". $invoiceDetails->first()['netAmount'] ."'></td>";
					$data['row'].="<td>$x</td>";
					$data['row'].="<td>".$invoiceDetails->first()['billDate']."</td>";
					$data['row'].="<td>".$invoiceDetails->first()['invoiceNumber']."</td>";
					$data['row'].="<td>".DB::getInstance()->get('purchaseBills', array('date', '=', $invoiceDetails->first()['billDate']))->count()."</td>";
					$data['row'].="<td>".$invoiceDetails->first()['netAmount']."</td>";
					$data['row'].="<td>". ($invoiceDetails->first()['netAmount'] - $invoiceDetails->first()['balance']) ."</td>";
					$data['row'].="<td>". $invoiceDetails->first()['balance'] ."</td>";
					$data['row'].="<td>".$invoiceDetails->first()['discount']."</td>";
					$data['row'].="<td>N/A</td>"; // TODO
					$data['row'].="<td>N/A</td>"; // TODO
					$data['row'].="</tr>";
				}
				$x++;
			}
		}
		echo json_encode($data);
	}
}

function updatePayment(){
	if (Input::exists()){
		// Update the voucher entry
		// Update the balance
		// Update the amount paid
		// Update purchaseInvoice table and set balance to the previous amount

		$db = DB::getInstance();
		$total = 0;
		$invoiceNumbers = Input::get('invoiceNumber');

		// First get the invoice number and update each entry in purchaseInvoice
		// Set the balance amount to the previous one
		// And keep the sum of all the updated invoices

		$payment_details = $db->get('supplier_payment', array('id', '=', Input::get('v_no')));

		if ($payment_details->count()){
			
			// Getting the unchecked invoice numbers
			$unchecked_invoice_numbers = array_diff(array_values(json_decode($payment_details->first()['paid_to'], true)), Input::get('invoiceNumber'));

			// Once we get the unchecked values, 
			// Update each unchecked invoice in purchaseInvoice table
			foreach ($unchecked_invoice_numbers as $keys => $value){
				$update_invoice = DB::getInstance()->query("UPDATE purchaseInvoice SET balance = netAmount WHERE invoiceNumber = ?", array($value));

				// Calculate each balance amount
				$total += DB::getInstance()->get('purchaseInvoice', array('invoiceNumber', '=', $value))->first()['netAmount'];
			
				if ($update_invoice){
					echo "OK";
				}else{
					return "Error!";
				}
			}
		}

		$update_voucher = $db->update('supplier_payment', array('id', '=', Input::get('v_no')), array(
				'paid_to' => $invoiceNumbers,
				'amount_paid' => Input::get('amount_paid'),
				'amount_balance' => $payment_details->first()['amount_balance'] + $total
			));

		if ($update_voucher){
			echo "Stake sauce";
		}else{
			echo "Shit just got real!";
		}
				
	}
}

function getMFGNames(){
	//echo Input::get('name');
	if (Input::exists()){
		$db = DB::getInstance();
		$searchTerm = "%". strtoupper(Input::get('name')) ."%";
		//echo "SearchTerm = [$searchTerm]";
		$mfg_list = $db->query('SELECT * FROM company_name WHERE name LIKE ?', array($searchTerm));

		if ($mfg_list->count()){
			foreach ($mfg_list->results() as $list => $mfg){
				echo "<option value='". $mfg['name'] ."'>". $mfg['name'] ."</option>";
			}
		}

	}
}

function getHeadId($head, $level, $option = false){
	switch ($level) {
		case 'parent':
			$parent_head = DB::getInstance()->get('parent_head', array("name", '=', $head));
			if ($parent_head->count()){
				return $parent_head->first()['head_id'];
			}
			break;

		case 'child':
			$child_head = DB::getInstance()->get('child_heads', array("name", '=', $head));
			if ($child_heads->count()){
				if ($option){
					return $child_heads->first()['child_id'] ."/". $child_heads->first()['parent_id'];
				}
				
				return $child_heads->first()['child_id'];
			}
			break;

		case 'sub_child':
			# code...
			break;
		
		default:
			# code...
			break;
	}
}
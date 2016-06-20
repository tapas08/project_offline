
<?php 
require_once('core/init.php');
$db = DB::getInstance();
$res = $db->query("SELECT * FROM messages");

?>
<!DOCTYPE html>

<html>
<head>
	<title>Bill</title>
	<script src="script/jquery-min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!--<link rel="stylesheet" type="text/css" href="css/theme.css">--> 
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style2.css">
	

</head>
<script language="javascript">
 function printpage()
  {
   window.print();
  }
</script>

<body>
<div id="container_bill">
	<div class="contain_1">
		<div class="Top_Left">
		<div class="heading">
			<div class="head1">WINSMED'S</div>
			<div class="head2">
				<div class="head_tl">Shree Gurudeo Medicose</div>
					<center><div style="background-color:#587942;height:17px;width:170px;color:white;">
					CHEMIST & DRUGIST</div>

					</center>			
					<div class="head_sbtl">
					Bharusali Multispeciality Hospital,Vakli line,Paratwada
					</div>
			
			</div>
		</div>
			<div class="div_tb">
			<table class="table_1">
			<tr style="background-color:#587942;color:#ffffff;width:480px;border-radius:4px;">
				<td style="text-align:center;">MEMO</td>
				<td style="text-align:center;">BILL NO</td>
				<td style="text-align:center;">DATE</td>
			</tr>
			<tr>
				<td></br></br></td>
				<td><br/></td>
				<td><br/></td>
			</tr>
			</table>
			</div>
		</div>
		<div class="Top_Right">
		<div class="Tp_t">
		<div style="float:left;">D. L. No:&nbsp;20-50145<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		20-50146<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		20C-50147</div>
			<div style="float:right;width:200px;height:60px;">
			<div style="color:#587942">VAT TIN:27771135443 V/C</br></div>
			<div style="color:#587942"><i class="fa fa-phone"></i>07223-220632</div>
		</div></div>
		<div class="Tp_b">
			<div style="color:#587942;font-weight:bold;padding-left:10px;" >Pt's Name</br>Address</br>Dr's Name</br>Address</div>
		</div>
		</div>
		
	</div>
	<div id="table_main">
	<table border="1" cellpadding="0" cellspacing="0" width="1000px" height="250px" >
	    
		<tr class="thead" >
	        
			<td width="10px">Sr. No.</td>
			<td width="100px" > Name Of Drug </td>
			<td width="50px"> Pack. </td>
			<td width="50px"> Mfg </td>
			<td width="30px"> B.No. </td>
			<td width="40px" > Ex. Dt.</td>
			<td width="50px" > Qty.</td>
			<td width="50px" > Amount </td>
		
		</tr>
		
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td ></td>
			<td></td>
			<td ></td>
			<td style="background-color:#C3D9A8;"></td>
			
		
		</tr>
		
		
	</table>
	</div>
	<div class="foot-base">
		<div class="left-footer">
		<ul >
		<li>Paratwada U/o Evolet Enterprises Pvt. Ltd.</li>
		<li>Difference in price if found,will be refunded.</li>
		<li>Subject to Nagpur Jurisdiction.</li>
		<li>"Prices Charged includes all Recoverable Taxes Suffered" E. & O.E.</li>
		<li>Certified that our Rgtn No. under M.S. VAT act 2002 is in force on the date of this sale.</li>
		<ul></div>
		
		<div class="right-footer">
		<?php foreach($res->results() as $data => $msg){ ?>
		<br><?php echo $msg['message']; ?>
		<?php } ?>
		
		</div>
		<div class="foot-base1"></br></br>No.of items</div>
		<div class="foot-base2"></br></br>signature of Q.P</div>
		<div class="foot-base3"></div>

		
	</div>
</div>
</body>
</html>

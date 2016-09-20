<center>
		<footer>
		
		<p>MATOSHREE MEDICOSE Copyright 2016</p>
			
		</footer>
</center>

<script src="../script/jquery-min.js"></script>
<script src="../script/bootstrap.min.js"></script>

<script>
	
	function getMFGNames(){
		$.ajax({
			url: '../functions/accountFunctions.php',
			type: 'post',
			data: {
				name: $('#mfg').val(),
				access: 'getMFGNames'
			},
			success: function(data){
				//console.log(data);
				$('#mfg_list').html(data);
			}
		});
	}

</script>

<script>
	$('.pre-scrollable ul li a').click(function(e){
		e.preventDefault();
		var a = $(this);
		var link = $(a).attr('href');
		console.log("LINK -> "+link);

		switch(link){
			case "../master_reports/item_list.php":
				var mfg = $('#mfg').val();
				if (mfg != ''){
					link+="?mfg="+mfg;
					window.open(link, '_blank', "toolbar=yes,scrollbars=yes,resizable=yes,fullscreen=yes, width=1200");				
					return false;
				}else{
					alert('Please provide Manufacturer Name');
					return false;
				}
				break;

			default:
				console.log(link);
				window.open(link, '_blank', "toolbar=yes,scrollbars=yes,resizable=yes,fullscreen=yes, width=1200");
					break;
		}

	});
</script>


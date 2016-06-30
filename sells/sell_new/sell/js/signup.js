$('document').ready (function()
	{
		alert("Jquery load");
			$('.flash').hide();
			$('#submit').click(function(){
		alert("button");
			var $sname=$("#sname").val();
			var $email=$("#email").val();
			var $sname=$("#password").val();
			
		alert(sname+email+password);
			if(sname=='');
				{
			var ename='please enter name';
			$("#errorsname").text(ename).show();
			$("sname").focus();
			setInterval(function()
			{
				$("#errorsname").fadeout();
			},3000);
			return false;
			}
			else
			{
				$.ajax({
				type:'post'
				url:'signup.php';
				data:'name='+sname+'&email_address='+email+$passward_passward;
				cache:false;
				success:function(data);
			}
	});
}	

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		input{
			box-shadow: inset 1px 2px 1px #000;
		}
	</style>
</head>
<body>
	<div id="msg"></div>
	<input type="text" id="name">
	<input type="password" id="password">
	<input type="submit" value="submit" onclick="submit();">

	<script src="script/jquery-min.js"></script>
	<script>
	function submit(){
		$.ajax({
			url: "get.php",
			type: "post",
			data: {
				username: $('#name').val(),
				password: $('#password').val(),
				option: "sqlInjection"
			},
			success: function(data){
				$('#msg').html(data);
			}
		});
	}
	</script>
</body>
</html>
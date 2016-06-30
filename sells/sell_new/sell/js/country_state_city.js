function selectCity(country_id){
	//alert(country_id);
	if(country_id!="-1"){
		loadData('state',country_id);
		$("#city_dropdown").html("<option value='-1'>Select city</option>");
		//$("#state_dropdown").html("<option value='-1'>Select state</option>");
	}else{
		$("#state_dropdown").html("<option value='-1'>Select state</option>");
		//$("#city_dropdown").html("<option value='-1'>Select city</option>");		
	}
}

function selectState(state_id){
	if(state_id!="-1"){
		loadData('city',state_id);
	}else{
		$("#city_dropdown").html("<option value='-1'>Select city</option>");		
	}
}

function loadData(loadType,loadId){
	//alert(loadType);
	//alert(loadId);
	
	
	var dataString = 'loadType='+ loadType +'&loadId='+ loadId;
	
	//$("#"+loadType+"_loader").show();
    //$("#"+loadType+"_loader").fadeIn(400).html('Please wait... <img src="image/loading.gif" />');
	
	
	$.ajax({
		type: "POST",
		url: "loadData.php",
		data: dataString,
		cache: false,
		
		
		success: function(result){
		//alert(result);
			$("#"+loadType+"_loader").hide();
			$("#"+loadType+"_dropdown").html("<option value='-1'>Select "+loadType+"</option>");  
			$("#"+loadType+"_dropdown").append(result);  
		}
	});
}
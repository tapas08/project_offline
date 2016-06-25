function generateFields(parentId, arrayOfOptions){
	if (arrayOfOptions.length !== 'undefined'){
		var x = counter;
		var tr = $('<tr>').attr({
			"id": "formFields_"+x
		});
		var td, tag;

		var thisID;
		$.each(arrayOfOptions, function(tag, attr){
			//console.log("attr -> "+attr+" <- end");
			td = $('<td>');
			$.each(attr, function(attib, value){
				tag = $('<'+value['tag']+' type='+ value["type"] +'>').attr({
					"name": value['name']+'_'+x,
					"id": value['id']+'_'+x,
					"class": value['class'],
					"oninput": ((value['oninput'] !== 'undefined') ? value['oninput'] : ""),
					"step": ((value['step'] !== 'undefined') ? value['step'] : ""),
					"list": ((value['list'] !== 'undefined')? value['list'] : ""),
				});
				if (value['list']){
					$('<datalist id="drugList_'+x+'">').appendTo(tag);
				}
			});
			
			$(tag).appendTo(td)
			$(td).appendTo(tr);
		});
		$(tr).appendTo('tbody');
	}else{
		console.log("NONE!");
	}
}
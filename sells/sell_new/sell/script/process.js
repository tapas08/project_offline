
var itemsPurchased = {};
var temp;

var x = 2;
function addMore(){

	var addLink = document.getElementById('addMore')

	//create a div element
	var div = document.createElement('div');
	var attrForDiv = document.createAttribute("id");
	attrForDiv.value="element"+x;
	div.setAttributeNode(attrForDiv);

	//create a label element
	var label = document.createElement("label");
	var text = document.createTextNode("Item"+x+" ");
	label.appendChild(text);
	var attrForLabel = document.createAttribute("for");
	attrForLabel.value="product"+x;
	label.setAttributeNode(attrForLabel);

	//create an option element
	var select = document.createElement("select");
	var attrForSelect = document.createAttribute("id");
	var id = "drugOption"+x;
	attrForSelect.value = id;
	select.setAttributeNode(attrForSelect);
	var attrForSelect_onChange = document.createAttribute("onchange");
	var getValue = "getValue('"+id+"')";
	attrForSelect_onChange.value = getValue;
	select.setAttributeNode(attrForSelect_onChange);
	var options = ["SELECT", "Drug 1", "Drug 2", "Drug 3", "Drug 4", "Drug 5", "Drug 6"];
	for(var i = 0; i < options.length; i++){
		var option = document.createElement("option");
		var content = document.createTextNode(options[i]);
		option.appendChild(content);
		select.appendChild(option);
	}

	//create an input element with proper attributes
	var input = document.createElement("input");
	var attrForInput_type = document.createAttribute("type");
	attrForInput_type.value="number";
	input.setAttributeNode(attrForInput_type);
	var attrForInput_min = document.createAttribute("min");
	attrForInput_min.value=1;
	input.setAttributeNode(attrForInput_min);
	var attrForInput_max = document.createAttribute("max");
	attrForInput_max.value=50;
	input.setAttributeNode(attrForInput_max);
	var attrForInput_value = document.createAttribute("value");
	attrForInput_value.value=1;
	input.setAttributeNode(attrForInput_value);
	var attrForInput_id = document.createAttribute("id");
	attrForInput_id.value=x;
	input.setAttributeNode(attrForInput_id);
	var attrForInput_onChange = document.createAttribute("onchange");
	attrForInput_onChange.value="getQuantity('"+x+"')";
	input.setAttributeNode(attrForInput_onChange);
	var attrForInput_onInput = document.createAttribute("oninput");
	attrForInput_onInput.value="getQuantity('"+x+"')";
	input.setAttributeNode(attrForInput_onInput);

	var space = document.createTextNode(" ");

	//appending this to form
	div.appendChild(label);
	div.appendChild(space);
	div.appendChild(select);
	div.appendChild(space);
	div.appendChild(input);
	document.getElementById('sellForm').insertBefore(div, addLink);
	x++;
}


//Function to get the value of the selected item from the dropdown menu
var i = 1;
function getValue(id){
	var li = document.createElement("li");
	var liAttr = document.createAttribute("id");
	liAttr.value = "drug"+i;
	li.setAttributeNode(liAttr);
	var span = document.createElement("span");
	var spanAttr = document.createAttribute("id");
	spanAttr.value = "name"+i;
	span.setAttributeNode(spanAttr);
	var value = document.createTextNode(document.getElementById(id).value);
	span.appendChild(value);
	li.appendChild(span);
	var output = document.createElement("output");
	var outputAttr = document.createAttribute("id");
	outputAttr.value = "output"+i;
	output.setAttributeNode(outputAttr);
	li.appendChild(output);
	document.getElementById("selectedList").appendChild(li);
	document.getElementById(i).removeAttribute("disabled");
	
	//itemsPurchased[value] = parseInt("1");
	//console.log(itemsPurchased);
	i++;
}

function getQuantity(id){
	//console.log(document.getElementById("name"+id).innerHTML);
	document.getElementById("output"+id).value = " ---------- "+parseInt(document.getElementById(id).value);
	itemsPurchased[document.getElementById("name"+id).innerHTML] = parseInt(document.getElementById(id).value);
	document.getElementById("billButton").removeAttribute("hidden");
	//console.log(itemsPurchased[document.getElementById("name"+id).innerHTML]);
}


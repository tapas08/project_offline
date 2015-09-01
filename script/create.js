function addMoreFields(){

	grandTotal += tempTotal

	document.getElementById("grandTotal").innerHTML = grandTotal;

	//A new row is created with div element
	var div = document.createElement("div");
	// create attribute class="row"
	var attrib_div = document.createAttribute("class");
	attrib_div.value = "row";
	div.setAttributeNode(attrib_div);
	document.getElementById("inventoryForm").appendChild(div);

	//inner div to hold options
	var option_div = document.createElement("div");
	//creating an id attribute
	var option_div_id = document.createAttribute("id");
	option_div_id.value = "itemDiv";
	option_div.setAttributeNode(option_div_id);
	//creating an class attribute
	var option_div_class = document.createAttribute("class");
	option_div_class.value = "purchase col-lg-3";
	option_div.setAttributeNode(option_div_class);

	//creating select element
	var select = document.createElement("select");
	var select_id = document.createAttribute("id");
	select_id.value = "drugs_list_"+x;
	select.setAttributeNode(select_id);
	var select_onchange = document.createAttribute("onchange");
	select_onchange.value = "getRate('drugs_list_"+x+"', 'rate_"+x+"')";
	select.setAttributeNode(select_onchange);
	/* class attribute to be added to every form elements */
	var attribClass = document.createAttribute("class");
	attribClass.value = "form-control";
	select.setAttributeNode(attribClass);

	//creating options
	var option = document.createElement("option");
	var value = document.createTextNode("Select drug");
	option.appendChild(value);
	select.appendChild(option);
	//creating dynamically the list of drugs
	$.each(itemData, function(key, value){
		var options = document.createElement("option");
		var text =document.createTextNode(key);
		options.appendChild(text);	
		select.appendChild(options);
	});
	//appended the select element to its resp. div
	option_div.appendChild(select);

	//creating div to hold quantity input field
	var quantity_div = document.createElement("div");
	var quantity_div_id = document.createAttribute("id");
	quantity_div_id.value = "quantityDiv";
	quantity_div.setAttributeNode(quantity_div_id);
	var quantity_div_class = document.createAttribute("class");
	quantity_div_class.value = "purchase  col-lg-3";
	quantity_div.setAttributeNode(quantity_div_class);


	//creating input field for quantity
	var quantity = document.createElement("input");
	//type of the input
	var type = document.createAttribute("type");
	type.value = "number";
	quantity.setAttributeNode(type);
	//creating id of the input element
	var quantity_id = document.createAttribute("id");
	quantity_id.value = "quantity_"+x;
	quantity.setAttributeNode(quantity_id);
	//creating min attrib
	var min = document.createAttribute("min");
	min.value = 1;
	quantity.setAttributeNode(min);
	//creating value attrib
	var value = document.createAttribute("value");
	value.value = 0;
	quantity.setAttributeNode(value);
	//creating onchange and onclick event attribs
	var onchange = document.createAttribute("onchange");
	var oninput = document.createAttribute("oninput");
	onchange.value = oninput.value = "getTotal('drugs_list_"+x+"','quantity_"+x+"', 'total_"+x+"')";
	quantity.setAttributeNode(onchange);
	quantity.setAttributeNode(oninput);
	/* class attribute to be added to every form elements */
	var quantityClass = document.createAttribute("class");
	quantityClass.value = "form-control";
	quantity.setAttributeNode(quantityClass);

	//appending quantity input field to quantity div
	quantity_div.appendChild(quantity);

	//div to hold output field displaying rate
	var output_div = document.createElement("div");
	var output_div_id = document.createAttribute("id");
	output_div_id.value = "rateDiv";
	output_div.setAttributeNode(output_div_id);
	var output_div_class = document.createAttribute("class");
	output_div_class.value = "purchase  col-lg-3";
	output_div.setAttributeNode(output_div_class);

	//creating output field to display rate
	var rate = document.createElement("output");
	var rate_id = document.createAttribute("id");
	rate_id.value = "rate_"+x;
	rate.setAttributeNode(rate_id);
	var out = document.createTextNode(0);
	rate.appendChild(out);
	/* class attribute to be added to every form elements */
	var rateClass = document.createAttribute("class");
	rateClass.value = "form-control";
	rate.setAttributeNode(rateClass);

	//append output field to output_div
	output_div.appendChild(rate);

	//div to hold output field displaying TOTAL
	var div_total = document.createElement("div");
	var div_total_id = document.createAttribute("id");
	div_total_id.value = "totalDiv";
	div_total.setAttributeNode(div_total_id);
	var div_total_class = document.createAttribute("class");
	div_total_class.value = "purchase  col-lg-3";
	div_total.setAttributeNode(div_total_class);

	//creating output field for total
	var total = document.createElement("output");
	var total_id = document.createAttribute("id");
	total_id.value = "total_"+x;
	total.setAttributeNode(total_id);
	var init = document.createTextNode(0);
	total.appendChild(init);
	/* class attribute to be added to every form elements */
	var totalClass = document.createAttribute("class");
	totalClass.value = "form-control";
	total.setAttributeNode(totalClass);

	//appending total field to it resp. div
	div_total.appendChild(total);
	
	div.appendChild(option_div);
	div.appendChild(quantity_div);
	div.appendChild(output_div);
	div.appendChild(div_total);
	

	x++;

}
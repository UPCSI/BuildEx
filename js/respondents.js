function agree(eid,url){ 
	var form = document.createElement("form");
	form.setAttribute("id","agree_form")
	form.setAttribute("method","post");
	form.setAttribute("action",url);
	form.style.display = "hidden";
	document.body.appendChild(form);

	var input = document.createElement("input");
	input.setAttribute("type","hidden");
	input.setAttribute("name","eid");
	input.setAttribute("value","eid");

	document.getElementById("agree_form").appendChild(input);

	form.submit();
}
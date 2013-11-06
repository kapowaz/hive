/*
 * miscellaneous javascript functions for trivial/useful client-side effects
 */
 
var usernamefocus = 0;
var passwordfocus = 0;
var blurbgcolor = "#E9EAEF";
var focusbgcolor = "white";
var mouseoutbgcolor = "#E9EAEF";
var mouseoverbgcolor = "white";

function focusInput(oInput)
{
	var objInput = eval(oInput);
	var objInputfocus = eval(objInput.name + "focus");
	objInputfocus.value = 1;
	alert(objInputfocus.value);
	objInput.style.backgroundColor = focusbgcolor;
	if (objInput.value == objInput.name)
	{
		objInput.value = "";
	}
}

function blurInput(oInput)
{
	var objInput = eval(oInput);
	var objInputfocus = eval(objInput.name + "focus");
	objInputfocus.value = 0;
	objInput.style.backgroundColor = blurbgcolor;
	if (objInput.value == "")
	{
		objInput.value = objInput.name;
	}
}

function mouseoverInput(oInput)
{
	var objInput = eval(oInput);
	if (eval(objInput.name + "focus") != 1)
	{
		objInput.style.backgroundColor = mouseoverbgcolor;
	}
}

function mouseoutInput(oInput)
{
	var objInput = eval(oInput);
	if (eval(objInput.name + "focus") != 1)
	{
		objInput.style.backgroundColor = mouseoutbgcolor;
	}
}

function toggleDisplay(oElement)
{
	if (document.getElementById)
	{
		target = document.getElementById(oElement);
		if (target.style.display == "none")
		{
			target.style.display = "block";
		}
		else
		{
			target.style.display = "none";
		}
	}
}

function toggleTableView(oElement)
{
	if (document.getElementById)
	{
		var target = document.getElementById(oElement);
		var cn = target.childNodes;
		var spanNode = null;
		var tableNode = null;
		
		/*
			in order for this to succesfully hide/show a directory,
			it must contain a span element and a table element
		*/
		
		for (i=0;i<cn.length;i++)
		{
			if (cn[i].nodeName.toLowerCase() == "span") spanNode = cn[i];
			if (cn[i].nodeName.toLowerCase() == "table") tableNode = cn[i];

			// cn[i].style.display == "none" ? cn[i].style.display = "inline" : cn[i].style.display = "none";
			// cn[i].style.display == "none" ? cn[i].style.display = "inline" : cn[i].style.display = "none";
		}
		
		if (spanNode && tableNode)
		{
			(tableNode.style.display.length == 0 || tableNode.style.display == "block") ? tableNode.style.display = "none" : tableNode.style.display = "block";
			(spanNode.style.display.length == 0 || spanNode.style.display == "none") ? spanNode.style.display = "inline" : spanNode.style.display = "none";
			tableNode.style.width = "100%";
		}
		else
		{
			alert("Error! span and table elements were not both found. Unable to perform hiding operations. Please inform the webmaster that something went wrong!");
		}
	}
}

function popup(height,width,image)
{
	var url = "popup.php?image=" + image;
	var windowname = "hivepopup";
	var features = "status=no,resizable=no,height=" + height + ",width=" + width + ",location=no,menubar=no,scrollbars=no,toolbar=no";
	var w = window.open(url,windowname,features);
}
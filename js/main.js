function offDivs()
{
	document.getElementById("home").setAttribute("style","display: none;");
	document.getElementById("log").setAttribute("style","display: none;");
	document.getElementById("sign").setAttribute("style","display: none;");
	document.getElementById("about").setAttribute("style","display: none;");
	document.getElementById("help").setAttribute("style","display: none;");
}

function unselectButtons()
{
	document.getElementById("homeButton").setAttribute("class","customButton");
	document.getElementById("loginButton").setAttribute("class","customButton");
	document.getElementById("signupButton").setAttribute("class","customButton");
	document.getElementById("aboutButton").setAttribute("class","customButton");
	document.getElementById("helpButton").setAttribute("class","customButton");
}

function showSelection(divId,buttonId)
{
	offDivs();
	unselectButtons();
	document.getElementById(divId).setAttribute("style","display: block;");
	document.getElementById(buttonId).setAttribute("class","customButtonSelected");
	if(divId=="sign")
	{
		clrStats();
	}
}


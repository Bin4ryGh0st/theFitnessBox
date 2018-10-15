function leftHover()
{
	document.getElementById("toGoLeft").setAttribute("class","goLeftHover");
	document.getElementById("leftArrow").setAttribute("style","position: absolute; top: 2%;left: 6%;");
	document.getElementById("leftArrow").innerHTML="&#10094;&#10094;";
}

function leftUnhover()
{
	document.getElementById("toGoLeft").setAttribute("class","goLeft");
	document.getElementById("leftArrow").setAttribute("style","position: absolute; top: 2%;left: 25%;");
	document.getElementById("leftArrow").innerHTML="&#10094;";
}


function rightHover()
{
	document.getElementById("toGoRight").setAttribute("class","goRightHover");
	document.getElementById("rightArrow").setAttribute("style","position: absolute; top: 2%;right: 8%;");
	document.getElementById("rightArrow").innerHTML="&#10095;&#10095;";
}


function rightUnhover()
{
	document.getElementById("toGoRight").setAttribute("class","goRight");
	document.getElementById("rightArrow").setAttribute("style","position: absolute; top: 2%;right: 30%;");
	document.getElementById("rightArrow").innerHTML="&#10095;";
}


function previousProfile()
{
	//document.getElementById().setAttribute("style","");
}

function nextProfile()
{
	//document.getElementById().setAttribute("style","");
}

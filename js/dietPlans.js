function writeDietPlan()
{
	document.getElementById('dietPlansDisplay').style='display: none;';
	//alert(1);
	document.getElementById('writeDietPlan').style='display: block;';
	//alert(2);
	document.getElementById('guide').innerHTML='&#10010; See all Diet plans.';
	//alert(3);
	//alert(document.getElementById('newBlog').onclick);
	document.getElementById('newDietPlan').onclick=function onclick(event) {discoverDietPlans();};
	//alert(4);
	//alert(document.getElementById('newBlog').onclick);
}

function discoverDietPlans()
{
	document.getElementById('dietPlansDisplay').style='display: block;';
	document.getElementById('writeDietPlan').style='display: none;';
	document.getElementById('guide').innerHTML='&#9997; Post Your Diet Plan.';
	document.getElementById('newDietPlan').onclick=function onclick(event) {writeDietPlan();};
}

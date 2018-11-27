cart=[];

function outOfStock()
{
	alert('Sorry,Product is unavailable!');
}

function addToCart(item)
{
	//alert(item);
	//alert("Sorry, each item can be purchased one at a time!");
	cart.push(item);
	document.getElementById(item).value = "Remove from Cart";
	document.getElementById(item).onclick = function onclick(event) {removeFromCart(item);};
	console.log(cart);
}

function removeFromCart(item)
{
	if(confirm("Why?"))
	{
		cart.splice(cart.indexOf(item),1);
		document.getElementById(item).value = "Add to Cart";
		document.getElementById(item).onclick = function onclick(event) {addToCart(item);};
	}
	console.log(cart);
}

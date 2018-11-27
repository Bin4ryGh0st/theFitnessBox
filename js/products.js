cart=[];
var totalPrice=0;
function outOfStock()
{
	alert('Sorry,Product is unavailable!');
}

function addToCart(item,price)
{
	//alert(item);
	//alert("Sorry, each item can be purchased one at a time!");
	cart.push(item);
	//alert(parseInt(price));
	totalPrice += parseInt(price); 
	//alert(totalPrice);
	document.getElementById(item).value = "Remove from Cart";
	document.getElementById(item).onclick = function onclick(event) {removeFromCart(item,price);};
	console.log(cart);
}

function removeFromCart(item,price)
{
	if(confirm("Do you want to remove this product from your cart?"))
	{
		//alert(parseInt(price));
		totalPrice -= parseInt(price);
		//alert(totalPrice);
		cart.splice(cart.indexOf(item),1);
		document.getElementById(item).value = "Add to Cart";
		document.getElementById(item).onclick = function onclick(event) {addToCart(item,price);};
	}
	console.log(cart);
}

function checkOut()
{
	if(cart.length)
	{	
		var auth="Items Purchased :\n";
		for(ts in cart)
		{
			//alert(ts);
			auth += document.getElementById(cart[ts]).name;
			//alert(document.getElementById(cart[ts]));
			auth += '\n';
		}
		//alert(auth);
		if(confirm(auth+"Total Price: "+totalPrice.toString()+". \nPress OK to place Order through COD method."))
		{
			document.getElementById('cartValues').value = cart.join('-');
			return true;
		}
	}
	alert("Cart is empty , Please select some items first!");
	return false;
}


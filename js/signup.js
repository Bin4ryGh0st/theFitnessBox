var filter = [0,0,0,0,0];

function block()
{
	document.getElementById("unblockMsg").innerHTML="<sup>*(Each parameter must be correctly filled!)</sup>";
	document.getElementById("unblock").innerHTML="<sup>*</sup>";
	document.getElementById("signupSubmit").disabled=true;
	document.getElementById("signupSubmit").setAttribute("class","customButtonSpecialDisabled");
}

function pass()
{
	document.getElementById("unblockMsg").innerHTML="";
	document.getElementById("unblock").innerHTML="";
	document.getElementById("signupSubmit").disabled=false;
	document.getElementById("signupSubmit").setAttribute("class","customButtonSpecialSignup");
}

function getCurrDate()
{
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	
	if(dd<10) 
	{
	    dd = '0'+dd;
	} 
	
	if(mm<10) 
	{
	    mm = '0'+mm;
	} 
	today = yyyy + "-" + mm + "-" + dd;
	return today;
}

function isNotNull(prey)
{
	if(prey=="" || prey==null)
	{
		return false;
	}
	return true;
}

function isName()
{
	var tempName = document.getElementById("signupName").value;
	if(isNotNull(tempName))
	{	
		var nameRegex = /^[a-zA-Z ]{2,79}$/;
		if(nameRegex.test(tempName))
		{
			document.getElementById("nameErr").innerHTML = "";
			filter[0]=1;
		}
		else
		{
			document.getElementById("nameErr").innerHTML = "<sup>Invalid name!</sup>";
			filter[0]=0;
		}
	}
	else
	{
		document.getElementById("nameErr").innerHTML = "<sup>Name can't be empty!</sup>";
		filter[0]=0;
	}
	verify();
}

function emailExists(email)
{
	console.log(email);
	var xmlhttp= new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() 
	{
    	if (this.readyState == 4 && this.status == 200) 
    	{
    	 	if(this.responseText=="true")
    	 	{
    	 		document.getElementById("emailErr").innerHTML = "<sup>Email already exists!</sup>";
				filter[1]=0;
    	 	}
    	 	else if(this.responseText=="false")
    	 	{
    	 		document.getElementById("emailErr").innerHTML = "";
				filter[1]=1;
    	 	}
    	 	else
    	 	{
    	 		alert(this.responseText);
    	 	}
    	 	verify();
    	}
  	}
  	xmlhttp.open("POST","verEm.php", true);
  	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	xmlhttp.send("email="+email);
}

function isEmail()
{
	var tempEmail = document.getElementById("signupEmail").value;
	if(isNotNull(tempEmail))
	{	
		var emailRegex = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
		if(emailRegex.test(tempEmail))
		{
			emailExists(tempEmail);
		}
		else
		{
			document.getElementById("emailErr").innerHTML = "<sup>Invalid email!</sup>";
			filter[1]=0;
		}
	}
	else
	{
		document.getElementById("emailErr").innerHTML = "<sup>Email can't be empty!</sup>";
		filter[1]=0;
	}
	verify();
}

function isDOB()
{
	var tempDOB = document.getElementById("signupDOB").value;
	if(getCurrDate()>tempDOB)
	{
		if(isNotNull(tempDOB))
		{
			document.getElementById("DOBErr").innerHTML = "";
			filter[2]=1;
		}
		else
		{
			document.getElementById("DOBErr").innerHTML = "<sup>Enter valid date!</sup>";
			filter[2]=0;
		}
	}
	else
	{
		document.getElementById("DOBErr").innerHTML = "<sup>Enter valid date of birth!</sup>";
		filter[2]=0;
	}
	verify();
}

function isBMI()
{
	var tempBMI = document.getElementById("signupBMI").value;
	
	if(isNotNull(tempBMI))
	{
		if(parseInt(tempBMI)>=13 && parseInt(tempBMI)<=55)
		{
			document.getElementById("BMIErr").innerHTML = "";
			filter[3]=1;
		}
		else
		{
			document.getElementById("BMIErr").innerHTML = "<sup>Enter BMI between 13 to 55!</sup>";
			filter[3]=0;
		}
	}
	else
	{
		document.getElementById("BMIErr").innerHTML = "<sup>Enter valid BMI!</sup>";
		filter[3]=0;
	}
	verify();
}

function checkPass()
{
	var p1 = document.getElementById("signupPassword").value;
	var p2 = document.getElementById("signupPasswordRe").value;
	if((!isNotNull(p1))||(!isNotNull(p2)))
	{
		document.getElementById("passwordErr").innerHTML = "<sup>password/s can't be empty!</sup>";
		filter[4]=0;
	}
	else
	{
		if(p1 != p2)
		{	
			document.getElementById("passwordErr").innerHTML = "<sup>passwords doesn't match!</sup>";
			filter[4]=0;
		}
		else
		{
			if(p1.length>=8)
			{
				document.getElementById("passwordErr").innerHTML = "";
				filter[4]=1;
			}
			else
			{
				document.getElementById("passwordErr").innerHTML = "<sup>min. 8 characters required!</sup>";
				filter[4]=0;
			}
		}
	}
	verify();
}

function verify()
{
	var filterVal=1;
	var i=0;
	for(i=0;i<5;i++)
	{
		filterVal = (filterVal && filter[i]); 
	}
	
	if(filterVal)
	{
		pass();
	}
	else
	{
		block();
	}
	return filterVal;
}

function getFilter()
{
	for(i=0;i<5;i++)
	{
		console.log(filter[i]); 
		alert(filter[i]);
	}
}

function clrStats()
{
	filter = [0,0,0,0,0];
	document.getElementById("signupForm").reset();
	block();
}

function finalVerification()
{
	isName();
	isEmail();
	isDOB();
	isBMI();
	checkPass();
	var d=verify();
	if(d)
	{	
		var n=document.getElementById("signupName").value;
		var e=document.getElementById("signupEmail").value;
		var d=document.getElementById("signupDOB").value;
		var g=document.getElementById("signupGender").value;
		var b=document.getElementById("signupBMI").value;
		var p=document.getElementById("signupPassword").value;
		var xmlhttp1= new XMLHttpRequest();
		xmlhttp1.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				alert(this.responseText)
				if(this.responseText=="no")
				{
					alert("Signup failed,please try again!");
			 	}
			 	else
			 	{
			 		alert(this.responseText);
			 	}				
				clrStats();
			}
	  	}
	  	xmlhttp1.open("POST","insertIntoDB.php", true);
	  	xmlhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  	xmlhttp1.send("n="+n+"&e="+e+"&d="+d+"&g="+g+"&b="+b+"&p="+p);
	}
	return d;
}

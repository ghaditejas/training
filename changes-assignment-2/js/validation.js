var phone=document.getElementById("phoneno");
var password0=document.getElementById("pass");
var password1=document.getElementById("cnfpas");
var email=document.getElementById("emailid");
var office=document.getElementById("officeno");

/*
	   * Calculates the age of the user from his Birthdate 
	   * @return boolean 
*/
function ageBdae(){
	var day=document.getElementById("day").value;
	var month=document.getElementById("month").value;
	var year=document.getElementById("year").value;
	var bday=month+day+","+year;
	var bday_msec=Date.parse(bday);
	var current=new Date();
	var current_msec=Date.parse(current);
	var age_msec = current_msec - bday_msec;
	var age = (age_msec / (86400000 * 365));
	age = Math.floor(age);
	document.getElementById("age").value=age;
	
}
/*
	   * Checks whether the  phone_no. is 10 digit and does not contain alphabets
	   * @return boolean 
*/
//function palceError(msg,elem){
//	msg.insertAfter(elem);
//}
function phoneNumber()
{
  
  var phone_no=phone.value;
  	if( isNaN(phone_no) )
  	{
  		//palceError("<span class='error'>Invalid Phone No: Phone no. consist of alphabets</spna>",phone);
  		alert("Invalid Phone No: Phone no. consist of alphabets");
  		return false;
  	}
   else if( phone_no > 9999999999)
	{
		alert("Invalid Phone No: phone consist digits more than 10");
		return false;
	}
	else if(phone_no < 1000000000)
	{
		alert("Invalid Phone No: phone consist digits less than 10");
		return false;
	}
	else 
	{
		return true;
	}
}
/*
	   * Checks whether the  offic_no. entered contains alphabets  
	   * @return boolean 
*/
function officeNumber()
{
	var phone_no=office.value;
	if(/[a-z]/.test(phone_no))
	{
		alert("Invalid Office No:Given Office no. contains alphabets ");
		return false;
	}
	else 
	{
		return true;
	}
}
/*
	   * Validates the entered Password with respect to its length and whether it contains digiit and 
	   	 special character 
	   * @return boolean 
*/

function passEnter()
{
	var password1=password0.value;
	var password_length=password1.length;
	if(password_length <8)
	{	
		alert("Input does not match the specificaton: Inputed Password is less than 8 characters");
		return false;
	}
	else if(password_length > 12)
	{	
		alert("Input does not match the specificaton: Inputed Password is more than 12 characters");
		return false;
	}
	else if(/[0-9\!@#$%&*()]/.test(password1))
	{	
		alert("Input does not match the specificaton: Password inputed contains number and special characters");
		return false;
	}
	else
	{
		return true;
	}
}
/*
	   * Confirms that the passwords entered are same  
*/
function confirmPassword()
{
	var givenpass=password0.value;
	var confirmpass=password1.value;
	if (givenpass != confirmpass)
	{
		alert("Password does not match");
		return false;
	}
	else 
		return true;
}
/*
	   * Validates the entered email
	   * @return boolean   
*/
function mailId()
{	
	var email_Id=email.value;
	var at=email_Id.indexOf("@");
	var dot=email_Id.indexOf(".");
	var lastDot=email_Id.lastIndexOf(".");
	if(at<1)
	{
		alert("Invalid Email Id: Entered Id does not contain @ or id starts wth '@' ");
		return false;
	}
	else if(dot < 1 )
	{
		alert("Invalid Email ID:Entered Id starts with '.' ");
		return false;
	}
	else if(email_Id.charAt(dot+1) == "." || email_Id.charAt(at+1) == ".")
	{
		alert("Invalid Email Id:Entered Id consist of '.' after '@' or '.' ");
		return false;
	}
	else if(lastDot+2 >=email_Id.length)
	{
		alert("inavlid Email Id:Domain(TLD) not proper")
		return false;
	}
	else 
	{
		return true;
	}
}
/*
	   * Checks whether all the Required fields are filled or not
	   * @return boolean 
*/
function compulsory()
{
	var found = 0;
	var i = 0;
	var fName=document.getElementById("fname")
	var firstName=fName.value;
	var lName=document.getElementById("lname")
	var lastName=lName.value;
	var phone_number=phone.value;
	var email_Id=email.value;
	var pass=password0.value;
	var confirm_pass=password1.value;
	var about=document.getElementById("aboutu");
	var about_you=about.value;
	var age=document.getElementById("age").value;
	var radio1=document.getElementsByName("radio")[0].checked;
    var radio2=document.getElementsByName("radio")[1].checked;
    var checkbox1=document.getElementById("checkbox_sample18").checked;
    var checkbox2=document.getElementById("checkbox_sample19").checked;
    var checkbox3=document.getElementById("checkbox_sample20").checked; 
		if (firstName == null || firstName == "") 		
		{																	
			found = 1;
			fName.style.borderColor = "red";
			if(i==0)
			{
				i=1;
				fName.focus();
			}
		}
		else
		{
				fName.style.border = "1px solid #e1e1e1";
		} 
		if(lastName == null || lastName == "")
		{																	
			found = 1;
			lName.style.borderColor = "red";
			if(i==0)
			{
				i=1;
				lName.focus();
			}
		}
		else
		{
				lName.style.border = "1px solid #e1e1e1";
		}
		if(phone_number== null || phone_number == "")
		{
			found = 1;
			phone.style.borderColor = "red";
			if(i==0)
			{
				i=1;
				phone.focus();
			}
		}
		else if(!phoneNumber())
		{
			found = 1;
			phone.style.borderColor = "red";
			if(i==0)
			{
				i=1;
				phone.focus();
			}
		}
		else
		{
				phone.style.border = "1px solid #e1e1e1";
		} 
		if (!officeNumber())
		{
			found = 1;
			office.style.borderColor = "red";
			if(i==0)
			{
				i=1;
				office.focus();
			}
		}
		else
		{
			office.style.border = "1px solid #e1e1e1";
		} 
		if(email_Id == null || email_Id == "")
   		{
   			
   			found = 1;
			email.style.borderColor = "red";
			if(i==0)
			{
				i=1;
				email.focus();
			}
   		}
   		else if(!mailId())
   		{
   			found = 1;
			email.style.borderColor = "red";
			if(i==0)
			{
				i=1;
				email.focus();
			}
			//return false
   		}
   		else
   		{
   			email.style.border = "1px solid #e1e1e1";
   		}
   		if (pass == null || pass == "") 
   		{
   			
   			found = 1;
			password0.style.borderColor = "red";
			if(i==0)
			{
				i=1;
				password0.focus();
			}
   		}
   		else if(!passEnter())
   		{
   			found = 1;
			password0.style.borderColor = "red";
			if(i==0)
			{
				i=1;
				password0.focus();
			}
			//return false;
   		}
   		else
   		{
   			password0.style.border = "1px solid #e1e1e1";
   		}
   		if(confirm_pass == null || confirm_pass == "")
   		{
   			
   			found = 1;
			password1.style.borderColor = "red";
			if(i==0)
			{
				i=1;
				password1.focus();
			}

   		}
   		else if(!confirmPassword())
   		{
   			found = 1;
			password1.style.borderColor = "red";
			if(i==0)
			{
				i=1;
				password1.focus();
			}
			//return false;
   		}
   		else
   		{
   			password1.style.border = "1px solid #e1e1e1";
   		}
   		if (about_you == null || about_you == "")
   		{	
   			found = 1;
			about.style.borderColor = "red";
			if(i==0)
			{
				i=1;
				email.focus();
			}
   		}
   		if(!radio1 && !radio2 )
   		{
			
   			found = 1;
   			document.getElementById("gender").innerHTML = "Please Select Your Gender";
   			//document.getElementsByName("radio")[1].style.background = "red";

   		}
   		else 
   		{
   			document.getElementById("gender").innerHTML = "Gender";
   		}
   		if (!checkbox1 && !checkbox2 && !checkbox3)
   		{
   			
   			found = 1;
   			document.getElementById("interest").innerHTML = "Atleast 1 Interest Required ";
   		}
   		else
   		{
			document.getElementById("interest").innerHTML = "Interest";
   		}
   		if (age == "")
   		{
   			
   			found = 1;
   			document.getElementById("birthdate").innerHTML = "Please Select Your Birthdate";
   		}
   		else
   		{
   			document.getElementById("birthdate").innerHTML = "My Birthdate is";	
   		}
   		if(found == 1)
   		{
   			return false;
   			
   		}
   		else 
   		{
   			return true;
   		}
}

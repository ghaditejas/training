/*
 * Calculates the age of the user from his Birthdate 
 */
function age() {
    var day = document.getElementsByClassName("select day")[0];
    var bday_date = day.options[day.selectedIndex].value;
    var month = document.getElementsByClassName("select month")[0];
    var bday_month = month.options[month.selectedIndex].value;
    var year = document.getElementsByClassName("select year")[0];
    var bday_year = year.options[year.selectedIndex].value;
    var bday = bday_month + bday_date + "," + bday_year
    var bday_msec = Date.parse(bday);
    var current = new Date();
    var current_msec = Date.parse(current);
    var age_msec = current_msec - bday_msec;
    var age = (age_msec / (86400000 * 365));
    age = age.toFixed(1);
    var a = document.getElementsByName("age")[0];
    a.value = age;
}
/*
 * Checks whether the  phone_no. is 10 digit and does not contain alphabets
 */
function phone()
{
    var phone_no = document.getElementsByName("phone")[0].value;
    if (isNaN(phone_no) || phone_no > 9999999999)
        alert("Invalid Phone No.");
}
/*
 * Checks whether the  offic_no. entered contains alphabets  
 */
function office()
{
    var phone_no = document.getElementsByName("office")[0].value;
    if (/[a-z]/.test(phone_no))
        alert("Invalid Office No.");
}
/*
 * Validates the entered Password with respect to its length and whether it contains digiit and 
 special character 
 */

function password()
{
    var password1 = document.getElementsByName("password")[0].value;
    var password_length = password1.length;
    if (password_length < 8 || password_length > 12 || /[0-9\!@#$%&*()]/.test(password1))
    {
        alert("Input does not match the specificaton");
    }
}
/*
 * Confirms that the passwords entered are same  
 */
function confirmPassword()
{
    var password1 = document.getElementsByName("password")[0].value;
    var password2 = document.getElementsByName("password")[1].value;
    if (password1 != password2)
    {
        alert("Password does not match");
    }
}
/*
 * Validates the entered email   
 */
function email()
{
    var emailId = document.getElementsByName("email")[0].value;
    var at = emailId.indexOf("@");
    var dot = emailId.indexOf(".");
    var lastDot = emailId.lastIndexOf(".");
    if (at < 1 || dot < 1 || emailId.charAt(dot + 1) == "." || emailId.charAt(at + 1) == "." || at + 2 > lastDot || lastDot + 2 >= emailId.length)
        alert("Invalid Email ID");
}
/*
 * Calls the   partners_preference_form.html after recieving input from compulsory function
 */
function validator()
{
    var result = compulsory();
    if (result)
        window.location.assign("partners_preference_form.html");
}
/*
 * Checks whether all the Required fields are filled or not
 * @return boolean 
 */
function compulsory()
{
    var found = 0;
    var i = 0;
    var firstName = document.getElementsByName("firstname")[0].value;
    var lastName = document.getElementsByName("lastname")[0].value;
    var phone_number = document.getElementsByName("phone")[0].value;
    var email_Id = document.getElementsByName("email")[0].value;
    var pass = document.getElementsByName("password")[0].value;
    var confirm_pass = document.getElementsByName("password")[1].value;
    var about_you = document.getElementsByTagName("textarea")[0].value;
    var age = document.getElementsByName("age")[0].value;
    var radio1 = document.getElementsByName("radio")[0].checked;
    var radio2 = document.getElementsByName("radio")[1].checked;
    var checkbox1 = document.getElementById("checkbox_sample18").checked;
    var checkbox2 = document.getElementById("checkbox_sample19").checked;
    var checkbox3 = document.getElementById("checkbox_sample20").checked;
    while (i <= 10)
    {
        if ((firstName == null || firstName == "") && i < 1)
        {
            i++;
            found = 1;
            document.getElementsByName("firstname")[0].style.borderColor = "red";
        } else if ((lastName == null || lastName == "") && i < 2)
        {
            i++;
            found = 1;
            document.getElementsByName("lastname")[0].style.borderColor = "red";
        } else if ((phone_number == null || phone_number == "") && i < 3)
        {
            i++;
            found = 1;
            document.getElementsByName("phone")[0].style.borderColor = "red";
        } else if ((email_Id == null || email_Id == "") && i < 4)
        {
            i++;
            found = 1;
            document.getElementsByName("email")[0].style.borderColor = "red";
        } else if ((pass == null || pass == "") && i < 5)
        {
            i++;
            found = 1;
            document.getElementsByName("password")[0].style.borderColor = "red";
        } else if ((confirm_pass == null || confirm_pass == "") && i < 6)
        {
            i++;
            found = 1;
            document.getElementsByName("password")[1].style.borderColor = "red"
        } else if ((about_you == null || about_you == "") && i < 7)
        {
            i++;
            found = 1;
            document.getElementsByTagName("textarea")[0].style.borderColor = "red";
        } else if (!radio1 && !radio2 && i < 8)
        {
            i++;
            found = 1;
            document.getElementById("gender").innerHTML = "Please Select Your Gender";
            //document.getElementsByName("radio")[1].style.background = "red";

        } else if (!checkbox1 && !checkbox2 && !checkbox3 && i < 9)
        {
            i++;
            found = 1;
            document.getElementById("interest").innerHTML = "Atleast 1 Interest Required ";
        } else if (age == "" && i < 10)
        {
            i++;
            found = 1;
            document.getElementById("birthdate").innerHTML = "Please Select Your Birthdate";
        } else if (found == 1)
        {
            i++;
            alert("Fill the required fields");
        } else
        {
            i++;
        }
    }
    if (found == 1)
    {
        return false;
    } else
    {
        return true;
    }
}

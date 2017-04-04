/*
 * Sets the border and next span tag of an element  
 * @param1 It consist the element we are now on
 * @param2 It consist the boolean values true or false depending on which the borders are set
 */
function set_border(elem, flag) {
    if (flag) {
        elem.css("borderColor", "red");
    } else {
        elem.css("border", "1px solid #e1e1e1");
        elem.next("span").text("");
    }

}
$(document).ready(function () {
   $("#frm_registeration").validate();
    /*$('#btn_submit').click(function(e){
     //e.preventDefault();
     var found = 0;
     //console.log($('#frm_regstraton').get(0));
     $('#frm_regstraton').find('.required').each(function(){
     if($(this).val() == ''){
     $(this).closest('.name_fileds').find('span').html('Required');
     found = 1;
     }else if($(this).hasClass('email')){
     var pp = mailId($(this));
     if(!pp){
     found = 1;
     }
     }	
     
     });
     
     if(!found){
     $('#frm_regstraton').submit();
     }
     
     });*/
   /* $("#day,#month,#year").change(function () {
        var $bday = $("#month").val() + $("#day").val() + "," + $("#year").val();
        var $bday_msec = Date.parse($bday);
        var current = new Date();
        var current_msec = Date.parse(current);
        var age_msec = current_msec - $bday_msec;
        var age = (age_msec / (86400000 * 365));
        age = Math.floor(age);
        $("#age").val(age);
    });
    $("form").submit(function () {
        var found = 0;
        var i = 0;
        var firstName = $("#fname").val();
        var lastName = $("#lname").val();
        var phone_number = $("#phoneno").val();
        var office_number = $("#officeno").val();
        var email_Id = $("#emailid").val();
        var at = email_Id.indexOf("@");
        var dot = email_Id.indexOf(".");
        var lastDot = email_Id.lastIndexOf(".");
        var pass = $("#pass").val();
        password_length = pass.length;
        var confirm_pass = $("#cnfpas").val();
        var about_you = $("#aboutu").val();
        var age = $("#age").val();
        if (firstName == null || firstName == "")
        {
            found = 1;
            set_border($("#fname"), true);
            $("#fname").next("span").text("Required*");
            if (i == 0)
            {
                i = 1;
                $("#fname").focus();
            }
        } else
        {
            set_border($("#fname"), false);
        }

        if (lastName == null || lastName == "")
        {
            found = 1;
            set_border($("#lname"), true);
            $("#lname").next("span").text("Required*");
            if (i == 0)
            {
                i = 1;
                $("#lname").focus();
            }
        } else
        {
            set_border($("#lname"), false);
        }

        if (phone_number == null || phone_number == "")
        {
            found = 1;
            $("#phoneno").css("borderColor", "red");
            $("#phoneno").next("span").text("Required*");
            if (i == 0)
            {
                i = 1;
                $("#phoneno").focus();
            }
        } else if (isNaN(phone_number))
        {
            found = 1;
            $("#phoneno").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#phoneno").focus();

            }
            $("#phoneno").next("span").text("Invalid Phone No: Phone no. consist of alphabets");

        } else if (phone_number > 9999999999)
        {
            found = 1;
            $("#phoneno").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#phoneno").focus();
            }
            $("#phoneno").next("span").text("Invalid Phone No: phone consist digits more than 10");
        } else if (phone_number < 1000000000)
        {
            found = 1;
            $("#phoneno").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#phoneno").focus();
            }
            $("#phoneno").next("span").text("Invalid Phone No: phone consist digits less than 10");
        } else
        {
            set_border($("#phoneno"), false);
        }

        if (/[a-z]/.test(office_number))
        {
            found = 1;
            $("#officeno").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#officeno").focus();
            }
            $("#officeno").next("span").text("Invalid Office No:Given Office no. contains alphabets ");

        } else
        {
            set_border($("#officeno"), false);
        }

        if (email_Id == null || email_Id == "")
        {
            found = 1;
            $("#emailid").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#emailid").focus();
            }
            $("#emailid").next("span").text("Required*");

        } else if (at < 1)
        {
            found = 1;
            $("#emailid").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#emailid").focus();
            }
            $("#emailid").next("span").text("Invalid Email Id: Entered Id does not contain @ or id starts wth '@' ");
        } else if (dot < 1)
        {
            found = 1;
            $("#emailid").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#emailid").focus();
            }
            $("#emailid").next("span").text("Invalid Email ID:Entered Id starts with '.' ");
        } else if (email_Id.charAt(dot + 1) == "." || email_Id.charAt(at + 1) == ".")
        {
            found = 1;
            $("#emailid").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#email").focus();
            }
            $("#emailid").next("span").text("Invalid Email Id:Entered Id consist of '.' after '@' or '.' ");
        } else if (lastDot + 2 >= email_Id.length)
        {
            found = 1;
            $("#emailid").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#emailid").focus();
            }
            $("#emailid").next("span").text("inavlid Email Id:Domain(TLD) not proper");
        } else
        {
            set_border($("#emailid"), false);
        }
        if (pass == null || pass == "")
        {

            found = 1;
            $("#pass").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#pass").focus();
            }
            $("#pass").next("span").text("Required*");
        } else if (password_length < 8)
        {
            found = 1;
            $("#pass").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#pass").focus();
            }
            $("#pass").next("span").text("Input does not match the specificaton: Inputed Password is less than 8 characters");
        } else if (password_length > 12)
        {
            found = 1;
            $("#pass").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#pass").focus();
            }
            $("#pass").next("span").text("Input does not match the specificaton: Inputed Password is more than 12 characters");
        } else if (/[0-9\!@#$%&*()]/.test(pass))
        {
            found = 1;
            $("#pass").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#pass").focus();
            }
            $("#pass").next("span").text("Input does not match the specificaton: Password inputed contains number and special characters");
        } else
        {
            set_border($("#pass"), false);
        }

        if (confirm_pass == null || confirm_pass == "")
        {

            found = 1;
            $("#cnfpas").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#cnfpas").focus();
            }
            $("#cnfpas").next("span").text("Required*");

        } else if (pass != confirm_pass)
        {
            found = 1;
            $("#cnfpas").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#cnfpas").focus();
            }
            $("#cnfpas").next("span").text("Password does not match");

        } else
        {
            set_border($("#cnfpas"), false);
        }
        if (about_you == null || about_you == "")
        {
            found = 1;
            $("#aboutu").css("borderColor", "red");
            if (i == 0)
            {
                i = 1;
                $("#aboutu").focus();
            }
            $("#aboutu").next("span").text("Required*");
        } else
        {
            set_border($("#aboutu"), false);
        }
        if (!$('#residence1').prop('checked') && !$('#residence2').prop('checked'))
        {
            found = 1;
            $("#gender").html("<b style='color:red'>Please Select Your Gender</b>");
        } else
        {
            $("#gender").text("Gender");
        }
        if (!$("#checkbox_sample18").prop('checked') && !$("#checkbox_sample19").prop('checked') && !$("#checkbox_sample20").prop('checked'))
        {

            found = 1;
            $("#interest").html("<b style='color:red'>Atleast 1 Interest Required</b>");
        } else
        {
            $("#interest").text("Interest");
        }
        if (age == "")
        {

            found = 1;
            $("#birthdate").html("<b style='color:red'>Please Select Your Birthdate</b>");
        } else
        {
            $("#birthdate").text("My birthdate is");
        }

        if (found == 1)
        {
            return false;

        } else
        {
            return true;
        }
    });*/
});



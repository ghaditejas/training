$("#day,#month,#year").change(function () {
    if ($("#month").val() != '' && $("#day").val() != '' && $("#year").val() != "") {
        var $bday = $("#month").val() + $("#day").val() + "," + $("#year").val();
        var $bday_msec = Date.parse($bday);
        var current = new Date();
        var current_msec = Date.parse(current);
        var age_msec = current_msec - $bday_msec;
        var age = (age_msec / (86400000 * 365));
        age = parseInt(Math.floor(age));

        $("#age").val(age);
    } else {
        $("#age").val('');
    }

});


/*
 * Sets the border and next span tag of an element  
 * @param1 It consist the element we are now on
 * @param2 It consist the boolean values true or false depending on which the borders are set
 */
$(document).ready(function () {
    $("#frm_registeration").validate({
        rules: {
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            email: {
                required: true,
                email: true,
                email_val:true
            },
            password: {
                required: true,
                pass: true,
                minlength: 8,
                maxlength: 12
            },
            phone: {
                required: true,
                number: true,
                maxlength: 10,
                minlength: 10
            },
            office: {
                number: true
            },
            cnfpassword: {
                required: true,
                equalTo: "#pass"
            },
            about_you: {
                required: true
            },
            age: {
                required: true
            },
            radio:{
                required : true
            }
        },
        messages: {
            firstname: " This field is Required",
            lastname: "This field is Required",
            email: {
                required: "This field is Required",
                email: "Enter a Valid Email ID"
            },
            password: {
                minlength: "Invalid Password : Less than 8 characters",
                maxlength: "Invalid Password : More Than 12 characters"
            },
            phone: {
                required: "This field is Required",
                number: "Entered Phone number consist of Alphabets",
                maxlength: "Invalid Phone Number : More than 10 digits",
                minlength: "Invalid Phone Number : Less than 10 digits"

            },
            office: {
                number: "Entered office number consist of Alphabets"
            },
            cnfpassword: {
                required: "This field is Required",
                equalTo: "Password don't match"
            },
            about_you: {
                required: "This field is Required"
            },
            age: {
                required: "This field is Required"
            },
            radio:{
              required:"Please Select Your Gender"  
            }
        },
        submitHandler: function (form) {
            
            if (!$('#residence1').prop('checked') && !$('#residence2').prop('checked')){
                    $('#genderError').css('display','block');
                     return false;
            }
            else if (!$("#checkbox_sample18").prop('checked') && !$("#checkbox_sample19").prop('checked') && !$("#checkbox_sample20").prop('checked'))
            {
                $('#interestError').css('display','block');
                return false;
            }
            else{
                $('#genderError').hide();
                form.submit();
            }
        }
    });
});



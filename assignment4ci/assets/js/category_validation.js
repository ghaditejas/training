/*
 * Validates the Catergory field , if proper sumbits the  form
 */
$(document).ready(function () {
//            (!empty($success)) 
//            alert('<?php echo $success; ?>');
    $("#category").validate({
        rules: {
            category_name: {
                required: true,
                pass: true
            }
        },
        messages: {
            category_name: {
                required: 'This field is Required*'
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});



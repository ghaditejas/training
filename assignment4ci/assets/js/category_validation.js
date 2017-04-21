/*
 * Validates the Catergory field and Prodouct fields, if proper sumbits the  form
 */
$(document).ready(function () {
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
    $("#add_product").validate({
        rules: {
            product_name: {
                required: true,
                pass1: true
            },
            price: {
                required: true,
                money: true
            },
            category: {
                required: true
            },
            upload: {
                accept: "image/jpeg, image/png"
            }
        },
        messages: {
            product_name: {
                required: 'This field is Required*'
            },
            price: {
                required: 'This field is Required*'
            },
            category: {
                required: 'Please Select a Category*'
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});



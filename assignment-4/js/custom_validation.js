
$.validator.addMethod("pass", function (value, element) {
    return this.optional(element) || !(/[0-9\!@#$%&*()]/.test(value));
}, 'Invalid Name: Name should contain only Alphabets');

$.validator.addMethod("money",function(value, element) {
        return(/^\d{0,9}(\.\d{0,2})?$/.test(value));
    },
    "Invald Price:Insert valid Price");

$.validator.addMethod("pass1", function (value, element) {
    return !(/[\!@#$%&*()~]/.test(value));
}, 'Invalid Name: Name should contain only Alphabets');


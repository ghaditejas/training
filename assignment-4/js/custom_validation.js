$.validator.addMethod("pass", function (value,element) {
   return(/[a-zA-Z]/.test(value));
}, 
'Invalid Name: Name should contain only Alphabets');



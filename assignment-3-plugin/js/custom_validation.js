$.validator.addMethod("pass", function (value,element) {
   return this.optional(element) ||!(/[0-9\!@#$%&*()]/.test(value));
}, 
'Invalid Password: Password cannot contain numbers and special characters');


$.validator.addMethod("email_val", function (value){
   var exp= /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
   return exp.test(value);
},
  'Invalid Email ID');


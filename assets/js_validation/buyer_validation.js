$(document).ready(function() {
    
    "use strict";
    
    var $validator = $("#buyer_validation").validate({
        rules: {
            first_name: {
                required: true
            },
		    email: {
                required: true,
                email: true
            },
            mobile_no: {
                required: true,
                number: true,
            },
            address_1: {
                required: true
		    },
		    password: {
                required: true
		    },
		    confirm_password: {
                required: true,
                equalTo: '#password'
		    },
		    
        }
    });
 
});
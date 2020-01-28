$(document).ready(function() {
    
    "use strict";
    
    var $validator = $("#settings_validation").validate({
        rules: {
            store_name: {
                required: true
            },
            store_owner: {
                required: true
            },
		    email: {
                required: true,
                email: true
            },
            telephone: {
                required: true,
                number: true,
            },
            logo: {
                required: true
		    },
		    meta_key_word: {
                required: true
            },
            meta_title: {
                required: true
            },
            geocode: {
                required: true
            },
            maintenance_mode: {
                required: true
            },
            address: {
                required: true
            },
            meta_tag_description: {
                required: true
            },
            mail_protocol: {
                required: true
            },
            mail_perameter: {
                required: true
            },
            smtp_hostname: {
                required: true
            },
            smtp_username: {
                required: true
            },
            smtp_password: {
                required: true
            },
            smtp_port: {
                required: true
            },
            smtp_timeout: {
                required: true
            },
            per_page_limit: {
                required: true
            },
        }
    });
 
});
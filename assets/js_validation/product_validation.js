$(document).ready(function() {
    
    "use strict";
    
    var $validator = $("#validate_product").validate({
        rules: {
            seller_id: {
                required: true
            },
            category_id: {
                required: true
            },		    
		    product_name: {
                required: true,
            },
            product_model: {
                required: true,
            },
            seo_keyword: {
                required: true,
            },
        }
    });

    
 
});
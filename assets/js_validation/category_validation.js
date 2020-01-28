$(document).ready(function() {
    
    "use strict";
    
    var $validator = $("#validate_category").validate({
        rules: {
            category_name: {
                required: true
            },
            seo_keyword: {
                required: true
            },		    
		    category_description: {
                required: true,
		    },
        }
    });
 
    CKEDITOR.replace('category_description');
		$("#validate_category").submit(function(e) {
			var messageLength = CKEDITOR.instances['category_description'].getData().replace(/<[^>]*>/gi, '').length;
			if (!messageLength) {
				// alert("alert");
				$("#cosError").remove();
				let mail_content_desc = document.getElementById("category_desc");
				$('#category_desc > div:last').after("<p class='error' id='cosError' style='color:#EC5E69;font-size: 12px;'>This field is required</p>");
				//stop form to get submit
				e.preventDefault();
				return false;
			} else {
				//editor is not empty, proceed to submit the form
				return true;
			}
		});
});
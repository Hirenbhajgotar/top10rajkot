$(document).ready(function() {
    
    "use strict";
    
    var $validator = $("#validate_cms_page").validate({
        rules: {
            seller: {
                required: true
            },
		    title: {
                required: true,
            },
            seo_keyword: {
                required: true,
            },
            description: {
                required: true
		    },
        }
    });

    CKEDITOR.replace('description');

		$("#validate_cms_page").submit(function(e) {
			var messageLength = CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;
			if (!messageLength) {
				
				$("#cosError").remove();
				let mail_content_desc = document.getElementById("cms_page_desc");
				$('#cms_page_desc > div:last').after("<p class='error' id='cosError' style='color:#EC5E69;font-size: 12px;'>This field is required</p>");
				//stop form to get submit
				e.preventDefault();
				return false;
			} else {
				//editor is not empty, proceed to submit the form
				return true;
			}
		});
 
});
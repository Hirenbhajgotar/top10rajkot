$(document).ready(function() {
	'use strict';

	var $validator = $('#validate_mail_template').validate({
		// ignore: [],
		rules: {
			mail_title: {
				required: true
            },
			// mail_content: {
			// 	required: true
			// }
		}
    });
    
    CKEDITOR.replace('mail_content');
		$("#validate_mail_template").submit(function(e) {
			var messageLength = CKEDITOR.instances['mail_content'].getData().replace(/<[^>]*>/gi, '').length;
			if (!messageLength) {
				
				$("#cosError").remove();
				let mail_content_desc = document.getElementById("mail_content_desc");
				$('#mail_content_desc > div:last').after("<p class='error' id='cosError' style='color:#EC5E69;font-size: 12px;'>This field is required</p>");
				//stop form to get submit
				e.preventDefault();
				return false;
			} else {
				//editor is not empty, proceed to submit the form
				return true;
			}
		});

});

﻿
var projectValidatorOptions = {
		feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'data[title]': {
				trigger: 'focus blur keyup',
				validators: {
					notEmpty: {
						message: 'The project title is required.'
					}
				}
			},
			'data[email]': {
				emailAddress: {
					message: 'The email address is not valid.'
				}
			},
			'data[website]': {
				uri: {
					message: 'The URL is not valid.'
				}
			}/*,
			'data[start]': {
				validators: {
					date: {
						format: 'MM/DD/YYYY',
						message: 'The value is not a valid date'
					}
				}
			}*//*,
			'data[phone]': {
				validators: {
					phone: {
						message: 'The phone number is not valid.'
					}
				}
			}*/
		}
	};


$('#projects-add').ready(function(){
	//console.log('projects-add ready!');
	$('#form-add-project').bootstrapValidator(projectValidatorOptions)
	.on('success.field.bv', function(e, data) {
			if (data.bv.isValid()) {
					data.bv.disableSubmitButtons(false);
			}
	});
});

$('#map-project-info').load(function(){
	//console.log('map-project-info ready!');
	$('#form-edit-project').bootstrapValidator(projectValidatorOptions)
	.on('success.field.bv', function(e, data) {
			if (data.bv.isValid()) {
					data.bv.disableSubmitButtons(false);
			}
	});
});
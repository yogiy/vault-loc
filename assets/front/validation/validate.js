$(document).ready(function() {
		// validate the comment form when it is submitted
		

		// validate signup form on keyup and submit

/**************Brief Module********/

$("#add_briefModule").validate({
    errorPlacement: function(error, element) {         
       error.insertAfter(element);
   },
   rules: {
            client_id: { required: true },
            brand_id: { required: true },
			category_id: { required: true },
			project_name: { required: true },
			theme_id: { required: true },
			project_duration_from: { required: true },
			project_duration_to: { required: true },
			"team_id[]": { required: true },
			"assisted_by_id[]": { required: true },
			budget: { required: true, number:true },
			operational_deadline: { required: true },
			client_submission_deadline: { required: true },
			"metro_id[]": { require_from_group: [1, ".market"]},
			"tier1_id[]": { require_from_group: [1, ".market"]},
			"tier2_id[]": { require_from_group: [1, ".market"]},
			"tier3_id[]": { require_from_group: [1, ".market"]},
			"tier4_id[]": { require_from_group: [1, ".market"]},
			filename: { acceptCsv:true }
        },

        messages: {
       }
  });

/************end**************/

/**************Edit Brief Module********/

$("#edit_briefModule").validate({
    errorPlacement: function(error, element) {         
       error.insertAfter(element);
   },
   rules: {
            client_id: { required: true },
            brand_id: { required: true },
			category_id: { required: true },
			project_name: { required: true },
			theme_id: { required: true },
			project_duration_from: { required: true },
			project_duration_to: { required: true },
			"team_id[]": { required: true },
			"assisted_by_id[]": { required: true },
			budget: { required: true, number:true },
			operational_deadline: { required: true },
			client_submission_deadline: { required: true },
			metro_id: { require_from_group: [1, ".market"]},
			tier1_id: { require_from_group: [1, ".market"]},
			tier2_id: { require_from_group: [1, ".market"]},
			tier3_id: { require_from_group: [1, ".market"]},
			tier4_id: { require_from_group: [1, ".market"]},
			filename: { acceptCsv:true }
        },

        messages: {
       }
  });

/************End**************/

/*************************Rework*******************************/
$("#uploadRework").validate({
		errorPlacement: function(error, element) {         
			error.insertAfter(element);
		},
		rules: { 
			baseline: { required: true, acceptReport:true }
		},
		messages: {
		}
  });
/************************End*************************/

/*************************Report*******************************/
$("#uploadReport").validate({
		errorPlacement: function(error, element) {         
			error.insertAfter(element);
		},
		rules: { 
			baseline: { require_from_group: [1, ".report"], acceptReport:true},
			assessment: { require_from_group: [1, ".report"], acceptReport:true},
			monitoring: { require_from_group: [1, ".report"], acceptReport:true},
			finalReport: { require_from_group: [1, ".report"], acceptReport:true}
		},
		messages: {
			baseline: { require_from_group: "Please choose at least one of these fields"},
			assessment: { require_from_group: "Please choose at least one of these fields"},
			monitoring: { require_from_group: "Please choose at least one of these fields"},
			finalReport: { require_from_group: "Please choose at least one of these fields"}
		}
  });
/************************End*************************/

/*************************Search Planninge*******************************/
$("#searchPlanning").validate({
		errorPlacement: function(error, element) {         
			error.insertAfter(element);
		},
		rules: { 
			pdid: { require_from_group: [1, ".search"]},
			client_id: { require_from_group: [1, ".search"]},
			brand_id: { require_from_group: [1, ".search"]},
			zone_id: { require_from_group: [1, ".search"]},
			state_id: { require_from_group: [1, ".search"]},
			status: { require_from_group: [1, ".search"]}
		},
		messages: {
			baseline: { require_from_group: "Please choose at least one of these fields"},
			assessment: { require_from_group: "Please choose at least one of these fields"},
			monitoring: { require_from_group: "Please choose at least one of these fields"},
			finalReport: { require_from_group: "Please choose at least one of these fields"}
		}
  });
/************************End*************************/
/*****************************Partener Identification******************************/
$("#savePartnerIdentification").validate({
    errorPlacement: function(error, element) {         
       error.insertAfter(element);
   },
   rules: {
           
           	legal_compliance: { require_from_group: [1, ".parameter"]},
		sustainability_index: { require_from_group: [1, ".parameter"]},
		measurable_results: { require_from_group: [1, ".parameter"]},
		long_impact: { require_from_group: [1, ".parameter"]},
		scalability: { require_from_group: [1, ".parameter"]},
		government_ngo: { required: true, accept:true }
        },

        messages: {
       }
  });
/*************************************End*****************************************/

/***********************************************/
	jQuery.validator.addMethod("lettersonly", function(value, element) {
	return this.optional(element) || /^[a-zA-Z1-9. ]*$/i.test(value);
	}, "Special characters are not allowed."); 

	jQuery.validator.addMethod("accept", function(value, element) {
	return this.optional(element) || /\.(xlsx|csv)$/i.test(value);
	}, "Invalid file format, Please upload a xlsx|csv."); 
	
	jQuery.validator.addMethod("acceptCsv", function(value, element) {
	return this.optional(element) || /\.(csv)$/i.test(value);
	}, "Invalid file format, Please upload a csv."); 
	
	jQuery.validator.addMethod("acceptReport", function(value, element) {
	return this.optional(element) || /\.(xlsx|csv|ppt|pptx|pps|png|PNG|jpg|JPG|jpeg|JPEG|doc|docx)$/i.test(value);
	}, "Invalid file format, Please upload a xlsx | csv | ppt | pptx | pps | png | PNG | jpg | JPG | jpeg | JPEG | doc | docx file format."); 
	
	jQuery.validator.addMethod("zipFormat", function(value, element) {
	return this.optional(element) || /\.(zip)$/i.test(value);
	}, "Invalid file format, Please upload a zip."); 
	
	jQuery.validator.addMethod("acceptPdf", function(value, element) {
	return this.optional(element) || /\.(pdf)$/i.test(value);
	}, "Invalid file format, Please upload a pdf."); 
	
	jQuery.validator.addMethod("acceptVid", function(value, element) {
	return this.optional(element) || /\.(mp4|avi|mpg|mpeg|3gp)$/i.test(value);
	}, "Invalid video format, Please upload a mp4|avi|mpg|mpeg|3gp.");

});


$(document).ready(function() {


    // validate signup form on keyup and submit
    $("#masters").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
		ignore: [],
        rules: {
            title: {
                required: true,
            }

        },
        messages: {

            title: {
                required: "Please enter title",
            }
        }
    });
    /**************Add Project ********/

    $("#add_common").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
		ignore: [],
        rules: {
            title: {
                required: true,
            }

        },
        messages: {
        }
    });

    /************end**************/
    /**************Change_password  ********/

    $("#change_password").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
		ignore: [],
        rules: {
            opass: {
                required: true,
            },

            npass: {
                required: true,
            },
            cnpass: {
                required: true,
                equalTo: "#npass"
            }

        },
        messages: {

            opass: {
                required: "Please enter valid password",
            },
            npass: {
                required: "Please enter new password",
            },
            cnpass: {
                required: "Please enter confirm password",
                equalTo: "Password mismatch"
            }
        }
    });
    /************end**************/
	 /***************User section*****************/
    $("#add_archieve").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
		ignore: [],
        rules: {

            title: {
                required: true,
			},
			
			thematic_area_id: {
                required: true,
            },
			
            theme_id: {
                required: true,
            },
			
            images: {
                required: true,
				acceptImg: true
            },
			
            utube: {
                required: true,
				url: true
            },
			
            presentation: {
                required: true,
				acceptPpt: true
            }

        },
        messages: {
        }
    });
    /************end**************/

    /***************User section*****************/
    $("#add_user").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
		ignore: [],
        rules: {

            fname: {
                required: true,
				lettersonly:true
            },
			
			username: {
                required: true,
            },
			
            email: {
                required: true,
                email:true
            },
			
			phone: {
                required: true,
                number:true
            },
			
			brand_id: {
                required: true,
            },
			
			industry_name: {
                required: true,
            },
			
			category_id: {
                required: true,
            },
			
			mobile: {
                required: true,
                number:true
            },
			
			designation: {
                required: true,
            },
			
			valid_from: {
                required: true,
            },
			
			valid_to: {
                required: true,
            },
			
			role_id: {
                required: true,
            },

            pass: {
                required: true,
            },
			
            cpass: {
                required: true,
                equalTo: "#pass"
            }

        },
        messages: {

            fname: {
                required: "Please enter first name",
            },
            email: {
                required: "Please enter email Id",
                required: "Please enter valid email Id"
            },
            pass: {
                required: "Please enter password",
            },
            c_pass: {
                required: "Please enter confirm password",
                equalTo: "Password mismatch"
            }
        }
    });

    $("#edit_user").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        ignore: [],
        rules: {

            fname: {
                required: true,
                lettersonly:true
            },

            phone: {
                required: true,
                number:true
            },

            brand_id: {
                required: true,
            },

            industry_name: {
                required: true,
            },

            category_id: {
                required: true,
            },

            mobile: {
                required: true,
                number:true
            },

            designation: {
                required: true,
            },

            valid_from: {
                required: true,
            },

            valid_to: {
                required: true,
            },

            role_id: {
                required: true,
            },

            cpass: {
                equalTo: "#pass"
            }

        },
        messages: {

            fname: {
                required: "Please enter first name",
            },
            c_pass: {
                equalTo: "Password mismatch"
            }
        }
    });
    /************end**************/
   
	 /***************NGO section*****************/
    $("#add_ngo").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
		ignore: [],
        rules: {

            "sector_id[]": {
                required: true,
            },
			
			title: {
                required: true,
            },
			
			ngo_type: {
                required: true,
            },
			
			unique_id: {
                required: true,
            },
			
			registeration_no: {
                required: true,
            },
			
			registeration_date: {
                required: true,
            },
			
			annual_turnover: {
                number: true,
            },
			
			experience: {
                number: true,
            },
			
			ngo_ranking: {
                number: true,
            },
			
			trustee: {
                number: true,
            },
			
			address: {
                required: true,
            },
			
			state: {
                required: true,
            },
			
			city: {
                required: true,
            },
			
			email: {
                email: true,
            },
			
			contact_person: {
                required: true,
            }

        },
        messages: {
        }
    });
    /************end**************/
	
	/***************NGO section*****************/
    $("#add_tier_town").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
		ignore: [],
        rules: {
			
			title: {
                required: true,
				lettersonly:true
            },
			
			zone: {
                required: true,
				lettersonly:true
            },
			
			state: {
                required: true,
				lettersonly:true
            },
			
			tier_town: {
                required: true,
            },
			
			longitude: {
                required: true,
				numberWithDot:true
            },
			
			latitude: {
                required: true,
				numberWithDot:true
            }

        },
        messages: {
        }
    });
    /************end**************/

    /**************Login Form ********/

    $("#login").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        rules: {
            username: {
                required: true,
            },
            pass: {
                required: true,
            },
            role: {
                required: true,
            }

        },
        messages: {
            username: {
                required: "Please enter username ",
            },

            pass: {
                required: "Please enter Password",
            },
            role: {
                required: "Please select your role",

            }
        }
    });

    /************end**************/


    /************************End******************************/
	
	jQuery.validator.addMethod("numberWithDot", function(value, element) {
        return this.optional(element) || /^[0-9.]*$/i.test(value);
    }, "Only numbers are allowed.");
	
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/i.test(value);
    }, "Special characters are not allowed");

    jQuery.validator.addMethod("lettersonly1", function(value, element) {
        return this.optional(element) || /^[a-zA-Z1-9.& ]*$/i.test(value);
    }, "Only (&) special characters are allowed with letters and digit");

    jQuery.validator.addMethod("accept", function(value, element) {
        return this.optional(element) || /\.(jpe?g|gif|png)$/i.test(value);
    }, "Invalid image format, Please upload a png, jpeg, jpg, gif");

    jQuery.validator.addMethod("zipFormat", function(value, element) {
        return this.optional(element) || /\.(zip)$/i.test(value);
    }, "Invalid image format, Please upload a zip");

    jQuery.validator.addMethod("acceptPdf", function(value, element) {
        return this.optional(element) || /\.(pdf)$/i.test(value);
    }, "Invalid file format, Please upload a pdf");
	
	jQuery.validator.addMethod("acceptPpt", function(value, element) {
        return this.optional(element) || /\.(pptx|ppt)$/i.test(value);
    }, "Invalid file format, Please upload a pptx");
	
	jQuery.validator.addMethod("acceptImg", function(value, element) {
        return this.optional(element) || /\.(jpg|JPG|png|PNG|jpeg|JPEG)$/i.test(value);
    }, "Invalid file format, Please upload a pptx");

    jQuery.validator.addMethod("acceptVid", function(value, element) {
        return this.optional(element) || /\.(mp4|avi|mpg|mpeg|3gp)$/i.test(value);
    }, "Invalid image format, Please upload a mp4|avi|mpg|mpeg|3gp");

});
/**
 *	Neon Login Script
 *
 *	Developed by Arlind Nushi - www.laborator.co
 */

var neonLogin = neonLogin || {};

;(function($, window, undefined)
{
    "use strict";

    $(document).ready(function()
    {
        neonLogin.$container = $("#login");


        // Login Form & Validation
        neonLogin.$container.validate({
            rules: {
                name: {
                    required: true
                },

                pass: {
                    required: true
                },

            },

            highlight: function(element){
                $(element).closest('.input-group').addClass('validate-has-error');
            },


            unhighlight: function(element)
            {
                $(element).closest('.input-group').removeClass('validate-has-error');
            },
        });
        // Login Form Setup
        neonLogin.$body = $(".login-page");
        if(neonLogin.$body.hasClass('login-form-fall'))
        {
            var focus_set = false;

            setTimeout(function(){
                neonLogin.$body.addClass('login-form-fall-init')

                setTimeout(function()
                {
                    if( !focus_set)
                    {
                        neonLogin.$container.find('input:first').focus();
                        focus_set = true;
                    }

                }, 550);

            }, 0);
        }
        else
        {
            neonLogin.$container.find('input:first').focus();
        }

    });

})(jQuery, window);
$(document).ready(function () {
    $('.checkout-form fieldset:first-child').fadeIn('slow');

    $('.checkout-form input[type="text"],input[type="email"],input[type="tel"],select').on('focus', function () {
        $(this).removeClass('input-error');
    });
    $(document).on('click', '.checkout-form .btn-next', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;
        parent_fieldset.find('.req_class, #billing_state, #billing_city, #state, #city').each(function () {
            if ($(this).val() == "") {

                if ($(this).data("selector_type") == "select") {
                    $(".highlight_select .bs-placeholder").addClass('give_border_color');
                } else {
                    $(this).addClass('input-error');
                }
                next_step = false;
            } else {
                if ($(this).data("selector_type") == "select") {
                    $(".highlight_select .dropdown-toggle").removeClass('give_border_color');
                } else {
                    $(this).removeClass('input-error');
                }

            }
        });

        // alert(next_step);


        if (next_step) {
            parent_fieldset.fadeOut(400, function () {
                $(this).next().fadeIn();
            });
        }
    });

    // previous step 42424242424242
    $('.checkout-form .btn-previous').on('click', function () {
        $(this).parents('fieldset').fadeOut(400, function () {
            $(this).prev().fadeIn();
        });
    });

    $('.checkout-form-class').on('submit', function (e) {
        var payment_type_id = $(".payment_type_id").val();
        var parent_fieldset = $('.checkout-field-row');
        var error = false;

        //Paypal
        if (payment_type_id == 4) {
            parent_fieldset.find('.req_class,#billing_state,#billing_city,#state,#city').each(function () {
                if ($(this).val() == "") {
                    if ($(this).data("selector_type") == "select") {
                        $(".highlight_select").addClass('give_border_color');
                    } else {
                        $(this).addClass('input-error');
                    }
                   error = true;
                    console.warn($(this).attr('name'));
                   return false;
                } 
                else {
                    if ($(this).data("selector_type") == "select") {
                        $(".highlight_select").removeClass('give_border_color');
                    } else {
                        $(this).removeClass('input-error');
                    }

                }
            });
            // END FOR EACH
        }
        else {
            //Stripe
            parent_fieldset.find('.req_class,.req_class_stripe, #billing_state, #billing_city, #state, #city,#cardNumber,#ccv,#exp-month,#exp-year').each(function () {
                if ($(this).val() == "") {
                    if ($(this).data("selector_type") == "select") {
                        $(".highlight_select").addClass('give_border_color');
                    } else {
                        $(this).addClass('input-error');
                    }
                    error = true;
                    return false;
                } else {

                    if ($(this).data("selector_type") == "select") {

                        $(".highlight_select").removeClass('give_border_color');
                        if ($(this).data("stripe") == "exp-month") {
                            var expMonth = $(this).val();
                            var expYear = $("#exp-year").val();
                            const d = new Date();
                            const currentMonth = d.getMonth() + 1;	// Month	[mm]	(1 - 12)
                            const currentYear = d.getFullYear();
                            if ((expMonth < currentMonth) && (expYear <= currentYear)) {
                                $(".highlight_select").addClass('give_border_color');
                                error = true;
                                return false;
                            }
                        }
                    } else {
                        $(this).removeClass('input-error');
                    }

                }
            });// END FOR EACH
        }
 
        if (error == true) {
            return false;
        }

        e.preventDefault();

        if ($('.coupon_discount').val() == 0) {
            $('#coupon_code').val('');
        }

        if ($('input[name=payment_type]').is(':checked')) {
            error = false;
            $("#payment_type_div").removeClass('highlight-border');
        } else {
            error = true;
            $("#payment_type_div").addClass('highlight-border');
            return false;

        }

        if (payment_type_id == 1) {
            $(this).find('.validation_of_card').each(function () {
                if ($(this).val() == "") {
                    error = true;
                    $(this).addClass('input-error');
                } else {
                    error = false;
                    $(this).removeClass('input-error');
                }
            });
        }

        if (error == true) {
            return false;
        } else {

            var $form = $(this);
            $form.parsley().subscribe('parsley:form:validate', function (formInstance) {
                formInstance.submitEvent.preventDefault();
                return false;
            });
            $.ajax({
                method: "get",
                url: full_path + "check-order",
                dataType: "json",
                // data: datastring + '&stripeToken=' + token,
                beforeSend: function () {
                    $('#authorize_waiting_modal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $("#authorize_waiting_modal").modal('show');

                }, //END Before Send
                success: function (data) {
                    $("#authorize_waiting_modal").modal('hide');
                    if (data.error == true && data.error_type == 1) {
                        var response_string = "Error! Customer subscription already exists\n";
                        swal({
                            title: "Error!",
                            text: response_string,
                            type: "error",
                            closeOnClickOutside: false
                        },
                            function () {
                                window.location.href = full_path + "orders/my-subscriptions";
                                //window.location.reload();
                            });

                    }
                    else {
                        $form.find('#place_order_button').prop('disabled', true);
                        if (payment_type_id == 4) {
                            paypalPayment();
                        }else{
                            Stripe.card.createToken($form, stripeResponseHandler);
                        }
                    }
                }
            });
            return false;
        } // END ELSE
    });

    function stripeResponseHandler(status, response) { //42424242424242
        var $form = $('#payment-form');
        if (response.error) {

            swal({
            title: "Error!",
            text: response.error.message,
            type: "error",
            closeOnClickOutside: false
            },
            function () {
                $('#place_order_button').prop('disabled', false);
                return false;
            //window.location.reload();
            });

            /*$form.find('.payment-errors').text(response.error.message);
            $form.find('.payment-errors').addClass('alert alert-danger');
            $form.find('#place_order_button').prop('disabled', false);
            return false;*/
        } 
        else {
            var token = response.id;
            $form.append($('<input type="hidden" name="stripeToken" />').val(token));
            var datastring = $(".checkout-form-class").serialize();

            $.ajax({
                method: "post",
                url: full_path + "place-order",
                dataType: "json",
                data: datastring + '&stripeToken=' + token,
                beforeSend: function () {
                    $('#authorize_waiting_modal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $("#authorize_waiting_modal").modal('show');

                }, //END Before Send
                success: function (data) {
                    $("#authorize_waiting_modal").modal('hide');
                    if (data.error == true && data.error_type == 1) {
                        var c_c_p_r_get_code = data.c_c_p_r_get_code;
                        var c_c_p_r_get_text = data.c_c_p_r_get_text;

                        var response_string = "Error! Customer profile not created successfully\n" + "Response: " + c_c_p_r_get_code + " " + c_c_p_r_get_text;
                        swal({
                            title: "Error!",
                            text: response_string,
                            type: "error",
                            closeOnClickOutside: false
                        },
                            function () {
                                window.location.reload();
                            });


                    }
                    else if (data.error == true && data.error_type == 2) {
                        if (data.error_code == 8) {
                            var response_string = "Payment failed. Credit card has expired!";
                            swal({
                                title: "Error!",
                                text: response_string,
                                type: "error",
                                closeOnClickOutside: false
                            },
                                function () {
                                    window.location.reload();
                                });
                        } else {

                            var error_code = data.error_code;
                            var error_message = data.error_message;

                            var response_string = "Customer profile not charged successfully\n" + "Response: " + error_code + " " + error_message;
                            swal({
                                title: "Error!",
                                text: response_string,
                                type: "error",
                                closeOnClickOutside: false
                            },
                                function () {
                                    window.location.reload();
                                });

                        }


                    }
                    else if (data.error == true && data.error_type == 3) {

                        var msg = data.msg;
                        var response_string = msg;
                        swal({
                            title: "Error!",
                            text: response_string,
                            type: "error",
                            closeOnClickOutside: false
                        },
                            function () {
                                window.location.reload();
                            });

                    }
                    else {
                        swal({
                            title: "Success!",
                            text: 'Order placed successfully',
                            type: "success",
                            closeOnClickOutside: false
                        },
                            function () {
                                $("#from_checkout").val("yes");
                                $("#checkFromCheckOut").submit();
                            });
                    }
                }, // END SUCCESS

                error: function () {
                    alert("Error");
                } // END 


            }); // END AJAX



        }
    };


    function paypalPayment() {
        var datastring = $(".checkout-form-class").serialize();

        $.ajax({
            method: "post",
            url: full_path + "place-order",
            dataType: "json",
            data: datastring,
            beforeSend: function () {
                $('#authorize_waiting_modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $("#authorize_waiting_modal").modal('show');

            }, //END Before Send
            success: function (data) {
                $("#authorize_waiting_modal").modal('hide');
                if (data.error == true && data.error_type == 1) {
                    var c_c_p_r_get_code = data.c_c_p_r_get_code;
                    var c_c_p_r_get_text = data.c_c_p_r_get_text;

                    var response_string = "Error! Customer profile not created successfully\n" + "Response: " + c_c_p_r_get_code + " " + c_c_p_r_get_text;
                    swal({
                        title: "Error!",
                        text: response_string,
                        type: "error",
                        closeOnClickOutside: false
                    },
                        function () {
                            window.location.reload();
                        });


                }
                else if (data.error == true && data.error_type == 2) {
                    if (data.error_code == 8) {
                        var response_string = "Payment failed. Credit card has expired!";
                        swal({
                            title: "Error!",
                            text: response_string,
                            type: "error",
                            closeOnClickOutside: false
                        },
                            function () {
                                window.location.reload();
                            });
                    } else {

                        var error_code = data.error_code;
                        var error_message = data.error_message;

                        var response_string = "Customer profile not charged successfully\n" + "Response: " + error_code + " " + error_message;
                        swal({
                            title: "Error!",
                            text: response_string,
                            type: "error",
                            closeOnClickOutside: false
                        },
                            function () {
                                window.location.reload();
                            });

                    }


                }
                else if (data.error == true && data.error_type == 3) {

                    var msg = data.msg;
                    var response_string = msg;
                    swal({
                        title: "Error!",
                        text: response_string,
                        type: "error",
                        closeOnClickOutside: false
                    },
                        function () {
                            window.location.reload();
                        });

                }
                else {
                    swal({
                        title: "Success!",
                        text: 'Order placed. Please continue to PayPal.',
                        type: "success",
                        closeOnClickOutside: false
                    },
                    function () {
                        window.location.href = data.redirect;
                    });
                }
            }, // END SUCCESS

            error: function () {
                //alert("Error");
            } // END 


        }); // END AJAX
    }
});

$("input[name='billShipSame']").click(function (e) {
    $(".billing-fields").toggle();

});
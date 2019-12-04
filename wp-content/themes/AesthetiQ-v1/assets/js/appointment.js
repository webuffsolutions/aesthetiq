var $ = jQuery.noConflict();

$(document).ready(function() {
    // get list of birth months
    $.ajax({
        url: settings.site_url + "/wp-json/aesthetiq-api/v1/birth-details",
        success: function(res) {
            var birthMonthDropdown = $("#birth_month");
            $.each(res.birthMonths, function() {
                birthMonthDropdown.append(
                    $("<option />")
                        .val(this)
                        .text(this)
                );
            });

            var birthDatesDropdown = $("#birth_date");
            $.each(res.birthDates, function() {
                birthDatesDropdown.append(
                    $("<option />")
                        .val(this)
                        .text(this)
                );
            });

            var birthYearsDropdown = $("#birth_year");
            $.each(res.birthYears, function() {
                birthYearsDropdown.append(
                    $("<option />")
                        .val(this)
                        .text(this)
                );
            });
        },
        error: function(err) {
            console.log(err);
        }
    });

    // get list of treatments
    $.ajax({
        url: settings.site_url + "/wp-json/aesthetiq-api/v1/treatments",
        success: function(res) {
            // console.log(res);
            $.each(res.treatments, function(i, optgroups) {
                // populate optgroups
                $.each(optgroups, function(groupName, options) {
                    var $optgroup = $("<optgroup>", { label: groupName });
                    $optgroup.appendTo("#treatment");

                    // populate options
                    $.each(options, function(j, option) {
                        var $option = $("<option>", {
                            text: option.options,
                            value: option.options
                        });
                        $option.appendTo($optgroup);
                    });
                });
            });
        },
        error: function(err) {
            console.log(err);
        }
    });

    // get list of branches
    $.ajax({
        url: settings.site_url + "/wp-json/aesthetiq-api/v1/branches",
        success: function(res) {
            var preferredBranchDropdown = $("#preferred_branch");
            $.each(res.branches, function() {
                preferredBranchDropdown.append(
                    $("<option />")
                        .val(this)
                        .text(this)
                );
            });
        },
        error: function(err) {
            console.log(err);
        }
    });

    // get list of available preferred time
    $.ajax({
        url: settings.site_url + "/wp-json/aesthetiq-api/v1/preferred-time",
        success: function(res) {
            var preferredTimeDropdown = $("#preferred_time");
            $.each(res.allAvailableTime, function() {
                preferredTimeDropdown.append(
                    $("<option />")
                        .val(this)
                        .text(this)
                );
            });
        },
        error: function(err) {
            console.log(err);
        }
    });

    // prepend +63 to input field
    $("#mobile_no").keydown(function(e) {
        var oldvalue = $(this).val();
        var field = this;
        setTimeout(function() {
            if (field.value.indexOf("+63") !== 0) {
                $(field).val(oldvalue);
            }
        }, 1);
    });

    // submit form
    $(".book-appointment-form").validate({
        rules: {
            full_name: {
                required: true,
                minlength: 2
            },
            email: {
                minlength: 2
            },
            gender: "required",
            mobile_no: {
                required: true,
                minlength: 13,
                maxlength: 13
            },
            birth_month: "required",
            birth_date: "required",
            birth_year: "required",
            treatment: "required",
            preferred_branch: "required",
            preferred_date: "required",
            preferred_time: "required"
        },
        messages: {
            full_name: {
                required: "Field is required",
                minlength: "Your full name must consist of atleast 2 characters"
            },
            email: {
                minlength: "Your email must consist of atleast 2 characters"
            },
            gender: "Field is required",
            mobile_no: {
                required: "Please enter your 10 digit mobile no.",
                minlength: "Please enter atleast 10 digits",
                maxlength: "Enter 10 digits only"
            },
            birth_month: "Field is required",
            birth_date: "Field is required",
            birth_year: "Field is required",
            treatment: "Field is required",
            preferred_branch: "Field is required",
            preferred_date: "Field is required",
            preferred_time: "Field is required"
        },
        submitHandler: function() {
            var formData = {
                action: "submitAppointment",
                full_name: $("#full_name").val(),
                email: $("#email").val(),
                gender: $("#gender").val(),
                mobile_no: $("#mobile_no").val(),
                birth_month: $("#birth_month").val(),
                birth_date: $("#birth_date").val(),
                birth_year: $("#birth_year").val(),
                treatment: $("#treatment").val(),
                preferred_branch: $("#preferred_branch").val(),
                preferred_date: $("#preferred_date").val(),
                preferred_time: $("#preferred_time").val(),
                preferred_time_suffix: $("#preferred_time_suffix").val(),
                message: $("#message").val()
            };

            var submitFormBtn = $(".submit-appointment-btn");
            submitFormBtn.attr("disabled", true);
            submitFormBtn.html("Loading..");

            $.post(settings.ajaxurl, formData)
                .done(function(res) {
                    submitFormBtn.attr("disabled", false);
                    submitFormBtn.html("Submit");

                    $(".book-appointment-form")[0].reset();

                    Swal.fire({
                        title: "Success!",
                        html:
                            "Your booking has been processed. <br/> Please wait for further instructions. <br/><br/>",
                        icon: "success",
                        showConfirmButton: false,
                        animation: false,
                        timer: 6000
                    });
                })
                .fail(function(xhr, status, error) {
                    console.log(xhr, status, error);
                    submitFormBtn.attr("disabled", false);
                    submitFormBtn.html("Submit");
                });
        },
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                // console.log(errors);
            }
        }
    });
});

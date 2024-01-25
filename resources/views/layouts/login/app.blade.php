<!doctype html>
<html>

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Easy Office</title>

    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/demo_1/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />

</head>

<body>

    @yield('content')


    <!--**********************************
        Scripts
    ***********************************-->

    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>

    <!-- form - validation -->
    <script src="{{ asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>

    <!-- form - validation -->
    <!-- <script src="{{ asset('js/form-validation.js') }}"></script> -->
    <script src="{{ asset('js/bt-maxLength.js') }}"></script>

    <script>
    // validate signup form validation and submit
    $("#signupForm").validate({
        rules: {
            companyperson1: {
                required: true,
            },
            companyemail1: {
                required: true,
                email: true
            },
            companycontact1: {
                required: true,
            },
            designation1: {
                required: true,
            },
            dob1: {
                required: true,
            },
            companyperson2: {
                required: true,
            },
            companyemail2: {
                required: true,
                email: true
            },
            companycontact2: {
                required: true,
            },
            designation2: {
                required: true,
            },
            dob2: {
                required: true,
            },
            companyperson3: {
                required: true,
            },
            companyemail3: {
                required: true,
                email: true
            },
            companycontact3: {
                required: true,
            },
            designation3: {
                required: true,
            },
            dob3: {
                required: true,
            },
            companyofficeaddress: {
                required: true,
            },
            companyfactoryaddress: {
                required: true,
            },
            ownername: {
                required: true,
            },
            uploadcertification: {
                required: true,
            },
            ntnno: {
                required: true,
            },
            gstno: {
                required: true,
            },
            password: {
                required: true,
                minlength: 6
            },
            cpassword: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
            tmc: {
                required: true,
            },
        },
        messages: {
            companyperson1: "Please enter company person name 1",
            companyemail1: "Please enter a valid email address 1",
            companycontact1: "Please enter company contact 1",
            designation1: "Please enter designation 1",
            dob1: "Please enter dob 1",
            companyperson2: "Please enter company person name 2",
            companyemail2: "Please enter a valid email address 2",
            companycontact2: "Please enter company contact 2",
            designation2: "Please enter designation 2",
            dob2: "Please enter dob 2",
            companyperson3: "Please enter company person name 3",
            companyemail3: "Please enter a valid email address 3",
            companycontact3: "Please enter company contact 3",
            designation3: "Please enter designation 3",
            dob3: "Please enter dob 3",
            companyofficeaddress: "Please enter company office address",
            companyfactoryaddress: "Please enter company factory address",
            ownername: "Please enter company owner name",
            uploadcertification: "Please upload certification",
            ntnno: "Please enter ntn no",
            gstno: "Please enter gst no",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            },
            cpassword: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long",
                equalTo: "Please enter the same password as above"
            },
            tmc: "Please enable the terms and conditions",

        },
        errorPlacement: function(label, element) {
            label.addClass('mt-2 text-danger');
            label.insertAfter($(element).parent());
        },
        highlight: function(element, errorClass) {
            $(element).parent().addClass('has-danger')
            $(element).addClass('form-control-danger')
        }
    });

    $('#optionsRadiosBuyer').on('change', function() {

        $('#sellergc').hide();
        // $('#sellerlisting').hide();
        // $('#buyerlisting').show();
    })

    $('#optionsRadiosSeller').on('change', function() {

        $('#sellergc').show();
        // $('#sellerlisting').show();
        // $('#buyerlisting').hide();
    })


    // $('#companyemail1').on('change', function() {
    //     var email = $(this).val();
    //     console.log(email);

    //     $.ajax({
    //         type: "GET",
    //         url: "/check-useremail/" + email,
    //         dataType: "json",

    //         success: function(response) {
    //             console.log(response);
    //             // $('#planname').text(response.planname);
    //         }
    //     });
    // })
    </script>

</body>

</html>
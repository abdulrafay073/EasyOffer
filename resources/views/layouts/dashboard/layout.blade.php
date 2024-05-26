<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Breeze Admin</title>
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />

    <style>
        .form-control,
        .js-example-basic-single {
            border: 2px solid #ebedf2;
            border-radius: 20px;
        }

        .table thead th,
        .table tbody td {
            border: 1.5px solid #d3d3d3;
            padding: 14px 25px;
        }

        select.form-control {
            /* dropdown */
            padding: 0.5375rem 0.75rem;
            outline: 2px solid #ebedf2;
        }

        .form-check-input {
            margin-top: 0.2rem;
        }

        /* .card {
        border-radius: 15px;
    } */
    </style>

</head>

<body>

    <div class="container-scroller">

        @include('layouts.dashboard.sidebar')

        <div class="container-fluid page-body-wrapper">

            @include('layouts.dashboard.header')

            <div class="main-panel">
                @yield('content')

                @include('layouts.dashboard.footer')
            </div>

        </div>

    </div>


    <!--**********************************
        Scripts
    ***********************************-->

    <!-- All plugin -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendors/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('vendors/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('vendors/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('vendors/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('vendors/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('vendors/flot/jquery.flot.pie.js') }}"></script>
    <!-- popup plugin -->
    <script src="{{ asset('vendors/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('vendors/jquery.avgrund/jquery.avgrund.min.js') }}"></script>
    <!-- form validation plugin -->
    <script src="{{ asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <!-- All js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/select2.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>

    <!-- Custom js for datatable this page -->
    <script src="{ asset('js/data-table.js"></script>

    <!-- table checkbox js -->
    <script src="{{ asset('js/simple-checkbox-table.min.js') }}"></script>

    <!-- modal js -->
    <script src="{{ asset('js/modal-demo.js') }}"></script>

    <!-- popup js -->
    <script src="{{ asset('js/alerts.js') }}"></script>
    <script src="{{ asset('js/avgrund.js') }}"></script>

    <!-- form validation js -->
    <script src="{{ asset('js/bt-maxLength.js') }}"></script>

    <script src="{{ asset('js/dashboard.js') }}"></script>




    <!-- *** Registeration And UpdateProfile Form Validation start *** -->
    <script>
        // validate signup form validation and submit
        $("#profileForm").validate({
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
                companyofficeaddress: {
                    required: true,
                },
                companyfactoryaddress: {
                    required: true,
                },
                ownername: {
                    required: true,
                },
                // uploadcertification: {
                //     required: true,
                // },
                ntnno: {
                    required: true,
                },
                gstno: {
                    required: true,
                },
                password: {
                    required: false,
                    minlength: 6
                },
                cpassword: {
                    required: false,
                    minlength: 6,
                    equalTo: "#password"
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
                // uploadcertification: "Please upload certification",
                ntnno: "Please enter ntn no",
                gstno: "Please enter gst no",
            },
            errorPlacement: function(label, element) {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            },
            highlight: function(element, errorClass) {
                $(element).parent().addClass('has-danger')
                $(element).addClass('form-control-danger')
            }
        });
    </script>
    <!-- *** Registeration And UpdateProfile Form Validation end *** -->




    <!-- *** Profile Update Ajax start *** -->
    <script type="text/javascript">
        // current buyer password match ajax
        $('#buyercurrentpassword').on('change', function() {
            var password = $(this).val();
            // console.log(password);

            $.ajax({
                type: "GET",
                url: "/buyer/check-password/" + password,
                dataType: "json",

                success: function(response) {
                    console.log(response.user);

                    if (response.user == "Your Password is incorrect") {
                        $("#pswrd").text(response.user);
                        $("#updateprofilebtn").prop("disabled", true);
                    } else {
                        $("#pswrd").text('');
                        $("#updateprofilebtn").prop("disabled", false);
                    }
                }
            });
        })

        // current seller password match ajax
        $('#sellercurrentpassword').on('change', function() {
            var password = $(this).val();
            // console.log(password);

            $.ajax({
                type: "GET",
                url: "/seller/check-password/" + password,
                dataType: "json",

                success: function(response) {
                    console.log(response.user);

                    if (response.user == "Your Password is incorrect") {
                        $("#pswrd").text(response.user);
                        $("#updateprofilebtn").prop("disabled", true);
                    } else {
                        $("#pswrd").text('');
                        $("#updateprofilebtn").prop("disabled", false);
                    }
                }
            });
        })
    </script>
    <!-- *** Profile Update Ajax end *** -->




    <!-- *** Success Swal Popup Start *** -->
    <!-- sweetalert popup css -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css">
    <!-- sweetalert popup js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.29/sweetalert2.all.js"></script>

    @if (session('createlisting'))
    <!-- iski js or link file uppar mention ha  -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Listing has been added a successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('updatelisting'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Listing has been updated a successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('deletelisting'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Deleted!',
                'Listing has been Deleted a successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('excellisting'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Excel File Uploaded a successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('profileupdate'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Profile has been updated a successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('makerequest'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Make Request has been created a successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('selleraccepted'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Seller request has been accepted a successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('sellerrejected'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Seller request has been rejected a successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('sellerrating'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Seller Rating has been done',
                'success',
            )
        })
    </script>
    @endif

    @if (session('sellerremove'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Seller has been remove by Admin',
                'success',
            )
        })
    </script>
    @endif

    @if (session('buyeraccepted'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Buyer request has been accepted a successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('buyerrejected'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Buyer request has been rejected a successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('buyerrating'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Buyer Rating has been done',
                'success',
            )
        })
    </script>
    @endif

    @if (session('buyerremove'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Buyer has been remove by Admin',
                'success',
            )
        })
    </script>
    @endif

    @if (session('createorderconfirmation'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Order Cnfirmation Form created a successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('currrentrequestrejected'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Request has been Rejected By Admin',
                'success',
            )
        })
    </script>
    @endif

    @if (session('samplerequestrejected'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Request has been Rejected By Admin',
                'success',
            )
        })
    </script>
    @endif

    @if (session('currrentrequestrejected_byseller'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Request has been Rejected Successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('placedbid'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Quotation has been Placed Successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('bidplacedproceed'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'PlacedQuotation has been proceed Successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('buyerdeleterequest'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Request has been deleted Successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('buyerrequestsubmit'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Re-Request has been submitted Successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('buyerbidaccept'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Quotation has been accepted Successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('buyerbidreject'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Quotation has been rejected Successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('buyerrebidsubmit'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Re-Quotation has been submitted Successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('sellerbidcancel'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Quotation has been cancelled Successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('adminbidproceed'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Quotation has been proceed Successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('adminbiddelete'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Quotation has been deleted Successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('adminbidsendresponse'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Quotation response has been send to seller',
                'success',
            )
        })
    </script>
    @endif

    @if (session('saleorder') || session('commercialorder') || session('logisticorder'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Order has been submitted successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('runningdealcancel'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Order Deal has been cancelled successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('sellerpurchaseconfirm'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Purchase Deal has been confirmed successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('sellerpurchasecancel'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Purchase Deal has been cancelled successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('buyersaleconfirm'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Sale Deal has been confirmed successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('buyersalecancel'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Sale Deal has been cancelled successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('lcissue'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'LC has been issued successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('shipmentdocs'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Shipment Docs has been done successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('paymentissue'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Payment Receipt has been issued successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('materialreceived'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Material has been received successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('marginreceived'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Margin has been received successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('feedback'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Feedback has been submitted successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('receivable'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Receivables has been submitted successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('expense'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Expenses has been submitted successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('sellerupdate'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Seller has been updated successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('buyerupdate'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Buyer has been updated successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('creatematter'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Matter has been created successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('updatematter'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Matter has been updated successfully',
                'success',
            )
        })
    </script>
    @endif

    @if (session('deletematter'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // console.log("dddssd");
            Swal.fire(
                'Success!',
                'Matter has been deleted successfully',
                'success',
            )
        })
    </script>
    @endif

    <!-- *** Success Swal Popup End *** -->

</body>

</html>
@extends('admin.layout.layout')
@section('content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style type="text/css">
    .input-group.change-passwords span {
        position: absolute;
        right: 0px;
        z-index: 9;
        padding: 10px;
    }

    .input-group.change-passwords {
        position: relative;
    }
</style>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{$title}}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                                <!-- <li class="breadcrumb-item">{{$title}}</li> -->
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$errors->first()}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                        <form method="post" id="form-data" action="{{ $saveurl }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="role" value="3">
                                <!-- Full Name -->
                                <div class="col-md-6">
                                    <label class="form-label">Short Url <span class="text-danger">*</span></label>
                                    <input type="text" name="title" value="{{ old('title', $getdata->title ?? '') }}" class="form-control" placeholder="Short Url">
                                </div>
                                
                                <!-- Submit -->
                                <div class="col-md-12 mt-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </div>
                        </form>

                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>
    <script>
        $("#form-data").validate({

            onfocusout: function(element) {
                $(element).valid();
            },
            highlight: function(element, errorClass) {

            },

            rules: {
                'name': {
                    required: true
                },
                'email': {
                    required: true
                },
                'mobile': {
                    required: true
                },
                'password': {
                    required: true
                },
                'confirm_password': {
                    required: true,
                    equalTo: '#password-field'
                },

                'e_confirm_password': {
                    equalTo: "#e_password-field",
                },
            },
            messages: {
                'name': "Please Enter state name.",
                'email': "Please Enter email address.",
                'mobile': "Please Enter mobile number.",
                'password': "Please enter password.",
                'confirm_password': {
                    required: "Please enter confirm password.",
                    equalTo: "Confirm password and password are not same."
                },
                'e_confirm_password': "Please enter Valid Password.",
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "data[Payment][phone]") {
                    error.insertAfter(".error-placement");
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {

                if (this.valid()) {
                    var country_code = $('.iti__selected-dial-code').html();
                    $('.country_code').val(country_code);
                    $('.confirm-reservation-cart').attr("disabled", "disabled");

                    form.submit();
                }
            },
        });
    </script>
    <script type="text/javascript">
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>

<script>
    $('#districtSelect').on('change', function () {
        var districtId = $(this).val();
        if (districtId) {
            $.ajax({
                url: '{{ url("get-coaches") }}/' + districtId,
                type: 'GET',
                success: function (data) {
                    $('#coachSelect').empty().append('<option value="">Select Coach</option>');
                    $.each(data, function (key, coach) {
                        $('#coachSelect').append('<option value="' + coach.id + '" data-name="' + coach.name + '" data-contact="' + coach.phone + '">' + coach.name + '</option>');
                    });

                    // Reset fields
                    $('#coachName').val('');
                    $('#coachContact').val('');
                }
            });
        } else {
            $('#coachSelect').html('<option value="">Select Coach</option>');
            $('#coachName').val('');
            $('#coachContact').val('');
        }
    });

    $('#coachSelect').on('change', function () {
        var name = $(this).find(':selected').data('name');
        var contact = $(this).find(':selected').data('contact');

        $('#coachName').val(name || '');
        $('#coachContact').val(contact || '');
    });
</script>
    @endsection
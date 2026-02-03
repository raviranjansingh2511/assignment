@extends('admin.layout.layout')
@section('content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
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
                                <!-- <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li> -->
                                <!-- <li class="breadcrumb-item">{{$title}}</li> -->
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->



<script src="{{ asset('public/admin/') }}/assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="{{ asset('public/admin/') }}/assets/js/pages/saas-dashboard.init.js"></script>

@endsection
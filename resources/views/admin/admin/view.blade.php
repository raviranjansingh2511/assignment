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
                 <div class="col-12">

                     <div class="card">
                         <div class="card-body">
                             <div class="row">
                                 <div class="col-12">
                                     
                                     <div class="d-sm-flex align-items-center justify-content-between">
                                         <h4 class="mb-sm-0 font-size-18"></h4>

                                       
                                        
                                         <div class="page-title-right add_button">
                                             <a href="{{route('admin_add')}}"> <button type="button" class="btn btn-success waves-effect waves-light">Invite Admin</button></a>
                                         </div>
                                        
                                     </div>
                                 </div>
                             </div>
                             <div class="table-responsive">
                                <table class="table table-bordered table_data mb-0 table-bordered">
                                <thead>
                                    <tr>
                                        
                                        
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th data-orderable="false">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>


                            </div>

                         </div>
                     </div>
                 </div> <!-- end col -->
             </div>
             <!-- end row -->
         </div>
         <!-- container-fluid -->
     </div>
     <!-- End Page-content -->
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

     <script>
    $(document).ready(function () {
        var table = $('.table_data').DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [
                  [10, 25, 50, 100, 500, 1000, -1],
                  [10, 25, 50, 100, 500, 1000, "All"]
                ],
            "bFilter": false,
            ajax: {
                url: "{{ url('/admin/admin-data') }}",
                data: function (d) {
                    d.title = $('input[name="title"]').val();
                    d.status = $('select[name="status"]').val();
                }
            },
            
            columns: [
                
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'action', name: 'action' }
            ]
        });

        $('#search-form').on('submit', function (e) {
            table.draw();
            e.preventDefault();
        });

        $('#filter').click(function () {
            table.ajax.reload();
        });

        $('#clearBtn').click(function () {
            $('#search-form')[0].reset();
            table.ajax.reload();
        });

        // select all checkbox
        $(document).on('click', '#select_all', function () {
            $('.row_checkbox').prop('checked', this.checked);
        });



        // delete action (unchanged)
        $(document).on("click", ".delete-button", function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");

            swal({
                title: "Are you sure you want to delete this?",
                text: "You will not be able to recover this action!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ url('admin/admin/delete') }}",
                        type: 'GET',
                        data: { 'id': id },
                        success: function (res) {
                            if (res.status === "success") {
                                swal({
                                    title: "Deleted!",
                                    text: res.message,
                                    icon: "success",
                                    timer: 1000,
                                    buttons: false
                                }).then(() => {
                                    table.ajax.reload();
                                });
                            } else {
                                swal("Error", "{!!trans('language.delete_already_used') !!}", "error");
                            }
                        }
                    });
                } else {
                    swal("Cancelled", "You cancelled your action", "error");
                }
            });
        });

    });
</script>
@endsection
@extends('backend.layouts.app')
@section('content')
    @include('backend.layouts.navbar')
    @include('backend.layouts.sidebar')
    @section('style')


<link href="{{ asset('assets/plugins/highcharts/css/highcharts.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
@endsection
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light ">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h3 my-2">
                        Admins<small
                            class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"></small>
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item">Admins</li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a style="color:black" href="">List</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->
        <div class="content">
            <div class="block block-rounded">
                <div class="block-content ">
                    <div class="d-flex justify-content-end">
                    <button id="exportBtn" class="btn btn-primary mb-2">Export Selected Users</button>

                    <a class="btn btn-info btn-sm" href="{{ route('users.create') }}">Add</a>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table table-striped table-bordered payment-table" style="width: 100%;" role="grid" aria-describedby="example_info" id="dataTable">
                        <thead>
                            <tr role="row">
                                <!-- <td class="sorting_asc">Id</td> -->
                                <td class="sorting">Name</td>
                                <td class="sorting">Email</td>
                                <td>First name</td>
                                <td>Address</td>
                                <td >Action</td>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        </div>
        </div>
    </main>
@endsection
@section('script')
<script>

$(function() {
    var table = $('.payment-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('admindatatables') }}",
    columns: [

        {
            data: 'name', //datas from the response
            name: 'name',orderable: true, searchable: true
        },
        {
            data: 'email',
            name: 'email',orderable: true, searchable: true
        },
        {
            data: 'first_name',
            name: 'first_name',orderable: true, searchable: true
        },
        {
            data: 'address',
            name: 'address',orderable: true, searchable: true
        },

        {data: 'action', name: 'action', orderable: false, searchable: false},



        ],

    });
});
    $('#exportBtn').click(function() {
alert("button clicked");
        var selectedUsers = [];
        $('.row-checkbox:checked').each(function() {
            alert("selectedUsers");

            alert(selectedUsers.push($(this).val()));
        });
        $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        // Send selected user IDs for export
        // Implement AJAX call to export endpoint
        // Example:
        $.ajax({
            url: 'export-users',
            type: 'POST',
            data: { selectedUsers: selectedUsers },
            success: function(response) {
                // Handle success, e.g., show download link
                console.log('Export success:', response);
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('Export error:', error);
            }
        });

    });



</script>
@endsection

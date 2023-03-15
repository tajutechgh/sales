@extends('user.layouts.master')

@section('show-head')

<link href="{{ asset('admin/plugins/bower_components/datatables/jquery.dataTables.min.css') }} " rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css') }} " rel="stylesheet" type="text/css" />
<!-- animation CSS -->
<link href="{{ asset('admin/css/animate.css') }} " rel="stylesheet">
<!-- Custom CSS -->
<link href="{{ asset('admin/css/style.css') }} " rel="stylesheet">
<!-- color CSS -->
<link href="{{ asset('admin/css/colors/default.css') }} " id="theme" rel="stylesheet">

@endsection

@section('page-title','Users')

@section('active','Users')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            @include('include.message')
            <div class="table-responsive"> 

                {{-- button to trigger modal --}}
                <button type="button" class="col-md-offset-5 btn btn-success fa fa-plus-circle" data-toggle="modal" data-target="#myModal">
                  Add user
                </button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <form method="post" action="{{ route('user.store') }}">
                        {{csrf_field()}}
                        <div class="modal-content">
                          <div class="modal-header" align="center">
                            <h4 class="modal-title" id="myModalLabel">Add user</h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                               <label>User Name</label>
                               <input type="text" placeholder="Enter user name" name="name" class="form-control" required="">
                            </div>
                            <div class="form-group">
                               <label>Contact</label>
                               <input type="text" placeholder="Enter contact" name="phone" class="form-control" required="">
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" placeholder="example@example.com" name="email" class="form-control" required="">
                            </div>
                            <div class="form-group">
                               <label>Password</label>
                               <input type="password" placeholder="Enter password" name="password" class="form-control" required="">
                            </div>
                            <div class="form-group">
                               <label>Confirm Password</label>
                               <input type="password" placeholder="Confirm password" name="password_confirmation" 
                               class="form-control" required="">
                            </div>
                            <div class="form-group">
                               <label><input type="checkbox" name="status" value="1"> Status</label>
                            </div>
                            <label>Assign Role</label>
                            <div class="row">
                                @foreach($roles as $role)
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="checkbox" name="role[]" value="{{$role->id}}"> {{$role->name}}
                                        </div>  
                                    </div>
                                @endforeach
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>

                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>User Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                      {{$role->name}},
                                    @endforeach
                                </td>
                                <td>
                                    @if ($user->status==1)
                                      <button class="btn btn-success btn-xs">Active</button>
                                    @else
                                      <button class="btn btn-danger btn-xs">Not Active</button>
                                    @endif
                                </td>
                                <td>
                                    {{-- button to trigger edit modal --}}
                                    <button type="button" class="btn btn-success fa fa-edit" data-toggle="modal" 
                                    data-target="#{{$user->id}}"> </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                        <form method="post" action="{{ route('user.update',$user->id) }}">
                                            {{csrf_field()}}
                                            {{method_field('PUT')}}
                                            <div class="modal-content">
                                              <div class="modal-header" align="center">
                                                <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                                              </div>
                                              <div class="modal-body">
                                                <div class="form-group">
                                                   <label>User Name</label>
                                                   <input type="text" placeholder="Enter student name" name="name" class="form-control" 
                                                   value="{{$user->name}}">
                                                </div>
                                                <div class="form-group">
                                                   <label>Contact</label>
                                                   <input type="text" placeholder="Enter contact" name="phone" class="form-control" 
                                                   value="{{$user->phone}}">
                                                </div>
                                                <div class="form-group">
                                                  <label>Email</label>
                                                  <input type="email" placeholder="example@example.com" name="email" class="form-control" 
                                                  value="{{$user->email}}">
                                                </div>
                                                <div class="form-group">
                                                    <label><input type="checkbox" name="status" value="1" @if($user->status == 1) checked 
                                                    @endif> Status</label>
                                                </div>
                                                <label>Assign Role</label>
                                                <div class="row">
                                                    @foreach($roles as $role)
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <input type="checkbox" name="role[]" value="{{$role->id}}" 
                                                                    @foreach($user->roles as $user_role)
                                                                        @if($user_role->id == $role->id)
                                                                          checked
                                                                        @endif
                                                                    @endforeach
                                                                > {{$role->name}}
                                                            </div>  
                                                        </div>
                                                    @endforeach
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                              </div>
                                            </div>
                                        </form>
                                      </div>
                                    </div>

                                    {{-- delete button --}}
                                    <form method="post" id="delete-form-{{$user->id}}" action="{{route('user.destroy', $user->id)}}" 
                                    style="display: none;">
                                    
                                    {{csrf_field()}}

                                    {{method_field('DELETE')}}

                                    </form>
                                    
                                    <a href="" onclick="
                                    if(confirm('Are yoy sure, You want to delete this data?')){
                                      event.preventDefault();document.getElementById('delete-form-{{$user->id}}').submit();
                                    }else{
                                      event.preventDefault();
                                    }" class="fa fa-trash-o btn btn-danger"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('show-footer')

<script src="{{ asset('admin/plugins/bower_components/datatables/jquery.dataTables.min.js') }} "></script>
<!-- start - This is for export functionality only -->
<script src="{{ asset('admin/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js') }} "></script>
<script src="{{ asset('admin/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js') }} "></script>
<script src="{{ asset('admin/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js') }} "></script>
<script src="{{ asset('admin/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js') }} "></script>
<script src="{{ asset('admin/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js') }} "></script>
<script src="{{ asset('admin/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js') }} "></script>
<script src="{{ asset('admin/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js') }} "></script>
<!-- end - This is for export functionality only -->
<script>
$(document).ready(function() {
    $('#myTable').DataTable();
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "columnDefs": [{
                "visible": false,
                "targets": 2
            }],
            "order": [
                [2, 'asc']
            ],
            "displayLength": 25,
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
        // Order by the grouping
        $('#example tbody').on('click', 'tr.group', function() {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                table.order([2, 'desc']).draw();
            } else {
                table.order([2, 'asc']).draw();
            }
        });
    });
});
$('#example23').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'pdf', 'print'
    ]
});
</script>

@endsection
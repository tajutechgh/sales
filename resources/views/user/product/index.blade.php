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

@section('page-title','Products')

@section('active','Products')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            @include('include.message')
            <div class="table-responsive"> 
                
                {{-- button to trigger add item modal --}}
                <button type="button" class="col-md-offset-5 btn btn-success fa fa-plus-circle" data-toggle="modal" data-target="#myModal">
                  Add Item
                </button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <form method="post" action="{{ route('product.store') }}" 
                    enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="modal-content">
                          <div class="modal-header" align="center">
                            <h4 class="modal-title" id="myModalLabel">Add Item</h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                                <label>Item Name</label>
                                <input type="text" class="form-control" name="name" required="" placeholder="Enter item's name">
                            </div>
                            <div class="form-group">
                                <label>Item Price</label>
                                <input type="number" class="form-control" name="price" required="" placeholder="Enter item's price">
                            </div>
                            <div class="form-group">
                                <label>Item Brand</label>
                                <input type="text" class="form-control" name="brand" required="" placeholder="Enter item's brand">
                            </div>
                            <div class="form-group">
                                <label>Item Quantity</label>
                                <input type="number" class="form-control" name="quantity" required="" placeholder="Enter item's quantity">
                            </div>
                            <div class="form-group">
                                <label>Item Description</label>
                                <input type="text" class="form-control" name="description" required="" placeholder="Enter item's description">
                            </div>
                            <div class="form-group">
                               <label><input type="checkbox" name="status" value="1"> Status</label>
                            </div>
                            <div class="form-group">
                               <input type="file" name="image" required>
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
                            <th width="10%">Image</th>
                            <th>Product Name</th>
                            <th>Price(GH₵)</th>
                            <th>Brand Name</th>
                            <th>Quantity</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th width="10%">
                                @can('action', Auth::user())
                                    Action
                                @endcan
                            </th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="10%">Image</th>
                            <th>Product Name</th>
                            <th>Price(GH₵)</th>
                            <th>Brand Name</th>
                            <th>Quantity</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th width="10%">
                                @can('action', Auth::user())
                                    Action
                                @endcan
                            </th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td><img src="{{Storage::disk('local')->url($product->image)}}" width="100%" height="50cm"></td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->brand}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->description}}</td>
                                <td>
                                    @if ($product->status==1)
                                      <button class="btn btn-success btn-xs">Available</button>
                                    @else
                                      <button class="btn btn-danger btn-xs">Finished</button>
                                    @endif
                                </td>
                                <td>
                                    {{-- button to trigger edit modal --}}
                                    <button type="button" class="btn btn-success fa fa-edit" data-toggle="modal" 
                                    data-target="#{{$product->id}}"> </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                        <form method="post" action="{{ route('product.update',$product->id) }}">
                                            {{csrf_field()}}
                                            {{method_field('PUT')}}
                                            <div class="modal-content">
                                              <div class="modal-header" align="center">
                                                <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
                                              </div>
                                              <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Item Name</label>
                                                    <input type="text" class="form-control" name="name" required="" 
                                                    value="{{$product->name}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Item Price</label>
                                                    <input type="number" class="form-control" name="price" required="" 
                                                    value="{{$product->price}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Item Brand</label>
                                                    <input type="text" class="form-control" name="brand" required="" 
                                                    value="{{$product->brand}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Item Quantity</label>
                                                    <input type="number" class="form-control" name="quantity" required="" 
                                                    value="{{$product->quantity}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Item Description</label>
                                                    <input type="text" class="form-control" name="description" required="" 
                                                    value="{{$product->description}}">
                                                </div>
                                                <div class="form-group">
                                                    <label><input type="checkbox" name="status" value="1" @if($product->status == 1) checked 
                                                        @endif> Status</label>
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
                                    <form method="post" id="delete-form-{{$product->id}}" action="{{route('product.destroy', $product->id)}}" 
                                    style="display: none;">
                                    
                                    {{csrf_field()}}

                                    {{method_field('DELETE')}}

                                    </form>
                                    
                                    <a href="" onclick="
                                    if(confirm('Are yoy sure, You want to delete this data?')){
                                      event.preventDefault();document.getElementById('delete-form-{{$product->id}}').submit();
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
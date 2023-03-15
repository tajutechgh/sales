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

@section('page-title','Sales Report')

@section('active','Sales Report')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <form method="post" action="{{ route('searchsalesreport') }}">
                {{csrf_field()}} 
                <label>Start Date:</label>
                <input type="date" name="startdate" required="">
                <label>End Date:</label>
                <input type="date" name="enddate" required="">
                <button class="btn-success btn-xs">Generate Report</button>  
            </form><br>

            @if (isset($details))
                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <th>Invoice Number</th>
                        <th>Date</th>
                        <th>Total Sale Amount(GH₵)</th>
                        <th width="5%">Action</th>
                    </thead>
                    <tfoot>
                        <th>Invoice Number</th>
                        <th>Date</th>
                        <th>Total Sale Amount(GH₵)</th>
                        <th width="5%">Action</th>
                    </tfoot> 
                    <tbody>
                        <?php 
                          $total = 0;
                        ?>
                        @foreach ($details as $sale)
                            <tr>
                                <td>{{$sale->invoice_number}}</td>
                                <td>{{Carbon\Carbon::parse($sale->created_at)->format('d-m-y')}}</td>
                                <td>{{$sale->total}}</td>
                                <td>
                                    <a href="{{ route('salesdetails', $sale->id) }}" class="btn btn-info fa fa-print" title="Print Invoice"></a>
                                </td>
                            </tr>
                            <?php $total = $total + $sale->total ?>
                        @endforeach
                    </tbody>
                </table>
                <h4 align="center" style="color: red;">Total Sales: GH₵ {{$total}}</h4>
            @elseif(isset($message))
               <h3>{{$message}}</h3>
            @endif
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
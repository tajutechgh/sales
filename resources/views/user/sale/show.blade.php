@extends('user.layouts.master')

@section('show-head')

@endsection

@section('page-title','Invoice')

@section('active','Invoice')

@section('content')

<!-- /.row -->
<div class="row">
  <div class="col-md-12">
    <div class="white-box">
      <div class="row">
        <div class="printableArea">
          <div class="col-md-12">
            <div class="pull-left">
              <address>
                <h3> &nbsp;<b class="text-danger">Abdul Aziz Enterprise Ltd</b></h3>
                <p class="text-muted m-l-5"><b>Contact:</b> 0241760337,
                  <br /><b>Address:</b> St. Peters-Asoreden,
                  <br /><b>Date:</b> {!! Carbon\Carbon::parse($saleInfo->created_at)->format('d-m-y') !!},
                  <br /><b>Attendant:</b> {!! $saleInfo->user['name'] !!},
                  <br /><b>Invoice #:</b> {!! $saleInfo->invoice_number !!}
                </p>
              </address>
            </div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive m-t-40" style="clear: both;">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Product</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Unit Cost(GH₵)</th>
                    <th class="text-right">Sub-Total(GH₵)</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($sales as $item)
                  <tr>
                    <td class="text-center">{!! $loop->index + 1 !!}</td>
                    <td>{!! $item->name !!}</td>
                    <td class="text-right">{!! $item->qty !!}</td>
                    <td class="text-right">{!! $item->price !!}</td>
                    <td class="text-right">{!! $item->total_amount !!}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-12">
            <div class="pull-right m-t-30 text-right">
              <h3><b>Total :</b> GH₵ {!! $saleInfo->total !!}</h3>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="text-center">
          <button id="print" class="btn btn-info" type="button"><span>
              <i class="fa fa-print"></i>Print</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- .row -->

@endsection

@section('show-footer')

{{-- print area --}}
<script src="{{ asset('admin/js/jquery.PrintArea.js') }}" type="text/JavaScript"></script>
<script>
  $(document).ready(function () {
    $("#print").click(function () {
      var mode = 'iframe'; //popup
      var close = mode == "popup";
      var options = {
        mode: mode,
        popClose: close
      };
      $("div.printableArea").printArea(options);
    });
  });
</script>

@endsection
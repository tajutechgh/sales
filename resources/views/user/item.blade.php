@extends('user.layouts.master')

@section('show-head')

@endsection

@section('page-title','Point of Sale')

@section('active','Point of Sale')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            @include('include.message')
            <div class="table-responsive">
                <div class="pull-right">
                    <a href="{{ route('showcart') }}" class="fa fa-cart-plus" style="font-size: x-large;"> {{$numitems}}</a>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" id="search" name="search" placeholder="Search by item's name">
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <th>Item Name</th>
                            <th>Brand</th>
                            <th>Item Price(GH₵)</th>
                            <th width="15%">Quantity</th>
                        </thead>
                        
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('show-footer')

<script type="text/javascript">

    $('#search').on('keyup',function(){

        $value = $(this).val();

        $.ajax({

            type : 'get',

            url  : '{{URL::to('searchitem')}}',

            data : {'search':$value},

            success:function(data){

                $('tbody').html(data);
            }
        });
     
    });

</script>

@endsection 
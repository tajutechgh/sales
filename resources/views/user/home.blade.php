@extends('user.layouts.master')

@section('show-head') 

<link rel="stylesheet" href="{{ asset('css/demo.css') }} "/>
<link rel="stylesheet" href="{{ asset('css/theme2.css') }} "/>

@endsection

@section('page-title','Dashboard')

@section('active','Dashboard')

@section('content')

<div class="row">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Total Items Available</h3>
            <ul class="list-inline two-part">
                <li>
                    <div><i class="fa fa-shopping-basket"></i></div>
                </li>
                <li class="text-right"><span class="counter text-success">{{$productsAvailable}}</span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info"> 
            <h3 class="box-title">Total Items Finished</h3>
            <ul class="list-inline two-part">
                <li>
                    <div><i class="fa fa-shopping-basket"></i></div>
                </li>
                <li class="text-right"><span class="counter text-success">{{$productsFinished}}</span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Total Daily Sales</h3>
            <ul class="list-inline two-part">
                <li>
                    <div><i class="fa fa-money"></i></div>
                </li>
                <li class="text-right"><span class="counter text-purple">{{$totalesales}}</span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Time</h3>
            <ul class="list-inline two-part">
                <li>
                    <div><i class="fa fa-clock-o"></i></div>
                </li>
                <li class="text-right"><span class="counter text-info">{{Carbon\carbon::now()->format('h:i:s')}}</span></li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="white-box">
            <h3 class="box-title">Finished Items</h3>
            <table class="table table-striped color-table default-table">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Product Name</th>
                    <th>Status</th>
                </tr>

                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            @if ($item->status==0)
                              <button class="btn btn-danger btn-xs">Finished</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="white-box">
            <div id="caleandar">

            </div>
        </div>
    </div>
</div>

@endsection

@section('show-footer')
  
<script type="text/javascript" src="{{ asset('js/caleandar.js') }} "></script>
<script type="text/javascript" src="{{ asset('js/demo.js') }} "></script>

@endsection
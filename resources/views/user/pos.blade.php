@extends('user.layouts.master')

@section('show-head')

@endsection

@section('page-title','Point of Sale')

@section('active','Point of Sale')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-lg-10">
                    <form action="{{ route('pos') }}" method="get">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" name="s" placeholder="Search by item's name" value="{{ isset($s) ? $s : '' }}">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-2">
                    <div class="pull-right">
                        <a href="{{ route('showcart') }}" class="fa fa-cart-plus" style="font-size: x-large;"> {{$numitems}}</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                @foreach ($products as $product)
                <div class="col-lg-2">
                    <form action="{{ route('addtocart') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="productId" value="{{ $product->id }}">
                        <input type="hidden" name="qty" value="1">
                        <button type="submit">
                            <img src="{{Storage::disk('local')->url($product->image)}}" style="width:100%; height:100px;"
                                class="thumbnail">
                            <h6 align="center">
                                {{ $product->name }} / {{ $product->brand }} / GH₵{{ $product->price }}
                            </h6>
                        </button>
                    </form><br> 
                </div>
                @endforeach
            </div>
            <div align="center">
                {{ $products->appends(['s'=>$s])->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('show-footer')

@endsection
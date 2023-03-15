@extends('user.layouts.master')

@section('show-head')

@endsection

@section('page-title','Issue Sale')

@section('active','Issue Sale')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            @include('include.message')
            <div class="table-responsive" id="div-id-name">
                <div class="col-md-8 col-md-offset-2">
                    <form method="post" action="{{ route('sale.store') }}">
                        {{csrf_field()}}
                        <input type="hidden" name="invoice_number" value="<?php echo rand(1,1000); ?>">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>S. No</th>
                                    <th>Item Name</th>
                                    <th>Price(GH₵)</th>
                                    <th width="15%">Quantity</th>
                                    <th>SubTotal(GH₵)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                   $total=0; 
                                ?>
                                @foreach ($cartProducts as $cartProduct)
                                <tr> 
                                    <td>{{$loop->index + 1}}</td>
                                    <td><input type="hidden" name="name[]" value="{{$cartProduct->name}}">{{$cartProduct->name}}</td>
                                    <td><input type="hidden" name="price[]" value="{{$cartProduct->price}}">{{$cartProduct->price}}</td>
                                    <td><input type="hidden" name="qty[]" value="{{$cartProduct->qty}}">{{$cartProduct->qty}}</td>
                                    <?php 
                                       $subTotal = $cartProduct->qty * $cartProduct->price;
                                    ?>
                                    <td><input type="hidden" name="total_amount[]" value="{{$subTotal}}">{{$subTotal}}</td>
                                    <td>
                                        <a href="{{ route('delete', $cartProduct->rowId) }}" class="btn btn-danger btn-xs fa fa-trash-o"></a>
                                    </td>
                                </tr>
                                <?php $total = $total + $subTotal ?>
                                @endforeach
                            </tbody>

                            <footer>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <th><b>Total:</b></th>
                                    <td>
                                        <input type="hidden" name="total" value="{{$total}}">
                                        <b>GH₵ {{$total}}</b>
                                    </td>
                                    <td></td>
                                </tr>
                            </footer>
                        </table>
                        <div class="text-center">
                            <a href="{{ route('pos') }}" class="btn btn-primary btn-sm">Continue Sale</a>
                            <button type="submit" class="btn btn-success btn-sm">Issue Sale</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('show-footer')

@endsection
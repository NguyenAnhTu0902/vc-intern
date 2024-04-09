@extends('layouts.admin')
@section('content')
    <!-- Basic datatable -->
    <div class="datatable-scroll">
        <table class="table datatable-basic">
            <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá tiền</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order as $key => $value)
                <tr>
                    <td>{{$value->product->name}}</td>
                    <td>
                        <img style="width: 60px; height: 60px;" src="{{ asset('storage/products/images/'.$value->product->image) }}" alt="" title="">
                    </td>
                    <td>{{$value->product->price}} đ</td>
                    <td>{{$value->qty}}</td>
                    <td>{{$value->total}} đ</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- /basic datatable -->
    </div>
@endsection

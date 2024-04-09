@extends('layouts.admin')
@php
    $listOrder = $result['listOrder'];
    $itemStart = $result['itemStart'];
@endphp
@section('content')
    <!-- Basic datatable -->
    <div class="datatable-scroll">
        <table class="table datatable-basic">
            <thead>
            <tr>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Tổng tiền</th>
                <th>Trạng thái đơn hàng</th>
                <th class="text-center">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listOrder as $key => $value)
                <tr>
                    <td>{{$key + $itemStart}}</td>
                    <td>{{$value->code}}</td>
                    <td>{{$value->address}}</td>
                    <td>{{$value->phone}}</td>
                    <td>{{$value->subtotal}} đ</td>
                    <td>{!! $value->status !!}</td>
                    <td class="text-center">
                        <form action="{{route('order.delete', ['id' => $value->id])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            @if(auth()->user()->can('View-orders'))
                                <a class="btn btn-info btn-sm mr-3 open-edit-modal" href="{{route('order.detail', ['id' => $value->id])}}"><i class="glyphicon glyphicon-eye-open"></i></a>
                            @endif
                            @if(auth()->user()->can('Delete-orders'))
                                <button type="submit" style="border: 2px solid #ef3030;" class="btn btn-default btn-sm open-print-modal">
                                    <i style="color: #ec2c2c; " class="icon-trash-alt"></i></button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- /basic datatable -->
    </div>
@endsection

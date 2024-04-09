@extends('layouts.admin')
@php
    $listOrder = $result['orders'];
    $itemStart = $result['itemStart'];
@endphp
@section('content')
        <div class="datatable-header">
            <form action="{{route('order.index')}}" class="main-search">
                <div class="input-group content-group">
                    <div class="has-feedback has-feedback-left">
                        <input name="search" placeholder="Nhập tên khách hàng, mã đơn hàng" type="text" class="form-control input-xlg" value="{{request('search')}}">
                        <div class="form-control-feedback">
                            <i class="icon-search4 text-muted text-size-base"></i>
                        </div>
                    </div>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-xlg">Search</button>
                    </div>
                </div>
            </form>
        </div>
    <!-- Basic datatable -->
    <div class="datatable-scroll">
        <table class="table datatable-basic">
            <thead>
            <tr>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Tổng tiền</th>
                <th>Trạng thái đơn hàng</th>
                <th class="text-center">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listOrder as $key => $v)
                <tr>
                    <td>{{$key + $itemStart}}</td>
                    <td>{{$v->code}}</td>
                    <td>{{$v->client->name}}</td>
                    <td>{{$v->address}}</td>
                    <td>{{$v->phone}}</td>
                    <td>{{$v->subtotal}} đ</td>
                    @if(auth()->user()->can('Edit-orders'))
                        <td>
                            <form action="{{route('order.update', ['id' => $v->id])}}" method="POST">
                                @method('PUT')
                                @csrf
                                <select  onchange="this.form.submit();" class="select" name="status">
                                    <option value="{{$v->status}}">
                                        {!! $v->status !!}
                                    </option>
                                    @if (!empty(\App\Models\Order::$type))
                                        @foreach(\App\Models\Order::$type as $key => $value)
                                            <option {{request('status') == $key ? 'selected' : ''}}  value="{{ $key }}">
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </form>
                        </td>
                    @else
                    <td>{!! $v->status !!}</td>
                    @endif
                    <td class="text-center">
                        <form action="{{route('order.delete', ['id' => $v->id])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            @if(auth()->user()->can('View-orders'))
                                <a class="btn btn-info btn-sm mr-3 open-edit-modal" href="{{route('order.detail', ['id' => $v->id])}}"><i class="glyphicon glyphicon-eye-open"></i></a>
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

@extends('layouts.admin')

@php
    $users = $result['users'];
    $itemStart = $result['itemStart'];
@endphp
@section('content')
    @if(auth()->user()->can('Create-users'))
        <a href="{{route('user.add')}}" style="" class="btn bg-teal-400 btn-labeled btn-rounded">
            <b><i class="glyphicon glyphicon-plus"></i></b>
            Thêm mới
        </a>
    @endif
    <div class="datatable-header">
        <form action="{{route('user.index')}}" class="main-search">
            <div class="input-group content-group">
                <div class="has-feedback has-feedback-left">
                    <input name="search" placeholder="Nhập tên người dùng" type="text" class="form-control input-xlg" value="{{request('search')}}">
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
                <th class=" u-width45">STT</th>
                <th class=" u-width100">Họ tên</th>
                <th class="u-width100">Email</th>
                <th class="u-width100">Địa chỉ</th>
                <th class="u-width100">Số điện thoại</th>
                <th class=" u-width100">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $value)
                <tr>
                    <td>{{$key + $itemStart}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->address}}</td>
                    <td>{{$value->phone}}</td>
                    <td>
                        <form action="{{route('user.delete',['id'=>$value->id])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            @if(auth()->user()->can('Edit-users'))
                            <a class="btn btn-info btn-sm mr-3 open-edit-modal" href="{{route('user.detail',['id'=>$value->id])}}"><i class="icon-pencil"></i></a>
                            @endif
                            @if(auth()->user()->can('Delete-users'))
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
    <div class="datatable-footer">
        {{$users->links()}}
    </div>
@endsection

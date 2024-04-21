@extends('layouts.admin')
@php
    $permission = $result['permissions'];
    $itemStart = $result['itemStart'];
@endphp
@section('content')

    <div class="datatable-header">
        <form action="{{route('permission.index')}}" class="main-search">
            <div class="input-group content-group">
                <div class="has-feedback has-feedback-left">
                    <input name="search" placeholder="Nhập tên quyền" type="text" class="form-control input-xlg" value="{{request('search')}}">
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
                <th class="text-center u-width45">STT</th>
                <th class="text-center u-width200">Tên quyền/ Chức vụ</th>
                <th class="text-center u-width100">Phân loại</th>
                <th class="text-center u-width100">Ngày tạo</th>
                <th class="text-center u-width100">Ngày cập nhật</th>
                <th class="text-center u-width100">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permission as $key => $value)
                <tr>
                    <td>{{$key + $itemStart}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{ \App\Models\Permission::$type[1] }}</td>
                    <td>{{$value->created_at}}</td>
                    <td>{{$value->updated_at}}</td>
                    <td class="text-center">
                        <a class="btn btn-info btn-sm mr-3 open-edit-modal" href="{{route('permission.detail', ['id' => $value->id])}}"><i class="icon-pencil"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- /basic datatable -->
    </div>
    <div class="datatable-footer">
    </div>
@endsection

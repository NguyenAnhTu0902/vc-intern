@extends('layouts.admin')

@php
    $products = $result['products'];
    $itemStart = $result['itemStart'];
@endphp
@section('content')
    <a href="" style="" class="btn bg-teal-400 btn-labeled btn-rounded">
        <b><i class="glyphicon glyphicon-plus"></i></b>
       Thêm mới
    </a>
    <div class="datatable-header">
        <form action="{{route('product.index')}}" class="main-search">
            <div class="input-group content-group">
                <div class="has-feedback has-feedback-left">
                    <input name="search" placeholder="Nhập tên sản phẩm" type="text" class="form-control input-xlg" value="{{request('search')}}">
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
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th class="text-center">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $key => $value)
                <tr>
                    <td>{{$key + $itemStart}}</td>
                    <td>{{$value->name}}</td>
                    <td>
                        <img style="width: 60px; height: 60px;" src="{{ asset('storage/products/'.$value->image) }}" alt="" title="">
                    </td>
                    <td>{{$value->category->name}}</td>
                    <td>{{$value->price}}</td>
                    <td>{{$value->description}}</td>
                    <td class="text-center">
                        <form action="" method="POST">
                            @method('DELETE')
                            @csrf
                            <a class="btn btn-info btn-sm mr-3 open-edit-modal" href=""><i class="icon-pencil"></i></a>
                            <button style="border: 2px solid #ef3030;" class="btn btn-default btn-sm open-print-modal">
                                <i style="color: #ec2c2c; " class="icon-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- /basic datatable -->
    </div>
    <div class="datatable-footer">
        {{$products->links()}}
    </div>
@endsection

@extends('layouts.admin')
@section('content')<!-- Vertical form options -->
<div class="row">
    <form action="{{route('category.update',['id' => $category->id])}}" method="POST">
        @method('PUT')
        @csrf
        <div class="panel panel-flat">

            <div class="panel-body">
                <div class="form-group">
                    <label>Tên danh mục<span class="text-red">(*)</span>:</label>
                    <input name="name" type="text" class="form-control" placeholder="Nhập tên danh mục" value="{{$category->name}}">
                    @error('name')
                    <span class="error validate-error">{{$message}}</span>
                    @enderror
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Cập nhật <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </form>
    <!-- /basic layout -->
</div>
<!-- /vertical form options -->

@endsection

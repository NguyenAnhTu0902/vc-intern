@extends('layouts.admin')
@section('content')<!-- Vertical form options -->
<div class="row">
    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__('label.product.name')}}
                        <span class="text-red">(*)</span>:</label>
                    <input name="name" type="text" class="form-control" placeholder="Nhập tên sản phẩm" value="{{old('name')}}">
                    @error('name')
                    <span class="error validate-error">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{__('label.product.category_id')}}<span class="text-red">(*)</span>:</label>
                    <select class="select" name="category_id">
                        <option value="{{old('category_id')}}">
                            --- Chọn danh mục ---
                        </option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="error validate-error">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{__('label.product.price')}}<span class="text-red">(*)</span>:</label>
                    <input name="price" type="text" class="form-control" placeholder="Nhập giá sản phẩm" value="{{old('price')}}">
                    @error('price')
                    <span class="error validate-error">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{__('label.product.image')}}<span class="text-red">(*)</span>:</label>
                    <input type="file" name="image" class="file-styled">
                    <span class="help-block">Accepted formats: jpeg, png, jpg. Max file size 2Mb</span>
                    @error('image')
                    <span class="error validate-error">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{ __('label.product.description')}}</label>
                    <textarea name="description" rows="5" cols="5" class="form-control" placeholder="Nhập mô tả sản phẩm"></textarea>
                    @error('description')
                    <span class="error validate-error">{{$message}}</span>
                    @enderror
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Thêm mới <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </form>
    <!-- /basic layout -->
</div>
<!-- /vertical form options -->

@endsection

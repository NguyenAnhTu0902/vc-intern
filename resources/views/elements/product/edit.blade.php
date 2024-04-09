@extends('layouts.admin')
@section('content')<!-- Vertical form options -->
<div class="row">
    <form action="{{route('product.update', ['id' => $product->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__('label.product.name')}}<span class="text-red">(*)</span>:</label>
                    <input name="name" type="text" class="form-control" placeholder="Nhập tên sản phẩm" value="{{$product->name}}">
                </div>
                <div class="form-group">
                    <label>{{__('label.product.category_id')}}<span class="text-red">(*)</span>:</label>
                    <select class="select" name="category_id">
                        <option value="{{old('category_id')}}">
                            --- Chọn danh mục ---
                        </option>
                        @foreach($categories as $category)
                            <option
                                @if ($product->category_id == $category->id)
                                    {{"selected"}}
                                @endif
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{__('label.product.price')}}<span class="text-red">(*)</span>:</label>
                    <input name="price" type="text" class="form-control" placeholder="Nhập giá sản phẩm" value="{{$product->price}}">
                </div>
                <img style="width: 100px; height: 100px;" src="{{ asset('storage/products/images/'.$product->image) }}" alt="" title="">
                <div class="form-group">
                    <label>{{__('label.product.image')}}:</label>
                    <input type="file" name="image" class="file-styled">
                    <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                </div>

                <div class="form-group">
                    <label>{{__('label.product.description')}}</label>
                    <textarea name="description" rows="5" cols="5" class="form-control" placeholder="Nhập mô tả sản phẩm">{{$product->description}}</textarea>
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

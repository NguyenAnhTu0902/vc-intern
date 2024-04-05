@extends('layouts.admin')
@section('content')<!-- Vertical form options -->
<div class="row">
    <form action="{{route('category.store')}}" method="POST">
        @csrf
        <div class="panel panel-flat">

            <div class="panel-body">
                <div class="form-group">
                    <label>Tên danh mục:</label>
                    <input name="name" type="text" class="form-control" placeholder="Nhập tên danh mục">
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Tạo mới <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </form>
    <!-- /basic layout -->
</div>
<!-- /vertical form options -->

@endsection

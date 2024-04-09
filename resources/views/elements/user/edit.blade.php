@extends('layouts.admin')
@section('content')<!-- Vertical form options -->
<div class="row">
    <form action="{{route('user.update', ['id' => $user->id])}}" method="POST">
        @method('PUT')
        @csrf
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__('label.user.name')}}
                        <span class="text-red">(*)</span>:</label>
                    <input name="name" type="text" class="form-control" placeholder="Nhập tên nhân viên" value="{{$user->name}}">
                    @error('name')
                    <span class="error validate-error">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{__('label.user.email')}}<span class="text-red">(*)</span>:</label>
                    <input name="email" type="text" class="form-control" placeholder="Nhập email" value="{{$user->email}}">
                    @error('email')
                    <span class="error validate-error">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{__('label.user.phone')}}<span class="text-red">(*)</span>:</label>
                    <input name="phone" type="text" class="form-control" placeholder="Nhập só điện thoại" value="{{$user->phone}}">
                    @error('phone')
                    <span class="error validate-error">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{__('label.user.address')}}<span class="text-red">(*)</span>:</label>
                    <input name="address" type="text" class="form-control" placeholder="Nhập địa chỉ" value="{{$user->address}}">
                    @error('address')
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

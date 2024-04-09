@extends('layouts.admin')
@section('content')<!-- Vertical form options -->
<div class="row">
    <form action="{{route('user.store')}}" method="POST">
        @csrf
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__('label.user.name')}}
                        <span class="text-red">(*)</span>:</label>
                    <input name="name" type="text" class="form-control" placeholder="Nhập tên nhân viên" value="{{old('name')}}">
                    @error('name')
                    <span class="error validate-error">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{__('label.user.email')}}<span class="text-red">(*)</span>:</label>
                    <input name="email" type="text" class="form-control" placeholder="Nhập email" value="{{old('email')}}">
                    @error('email')
                    <span class="error validate-error">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{__('label.user.password')}}<span class="text-red">(*)</span>:</label>
                    <input name="password" type="password" class="form-control" placeholder="Nhập mật khẩu">
                    @error('password')
                    <span class="error validate-error">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{__('label.user.confirm-pass')}}<span class="text-red">(*)</span>:</label>
                    <input name="confirm-pass" type="password" class="form-control" placeholder="Nhập lại mật khẩu">
                    @error('confirm-pass')
                    <span class="error validate-error">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{__('label.user.phone')}}<span class="text-red">(*)</span>:</label>
                    <input name="phone" type="text" class="form-control" placeholder="Nhập só điện thoại" value="{{old('phone')}}">
                    @error('phone')
                    <span class="error validate-error">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{__('label.user.address')}}<span class="text-red">(*)</span>:</label>
                    <input name="address" type="text" class="form-control" placeholder="Nhập địa chỉ" value="{{old('address')}}">
                    @error('address')
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

@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form id="profile" action="{{route('profile')}}" method="POST">
                @method('PUT')
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Họ tên<span class="text-red">(*)</span>:</label>
                            <input type="text" class="form-control" placeholder="Nhập họ tên" name="name" value="{{auth()->user()->name}}">
                            @error('name')
                            <span class="error validate-error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email<span class="text-red">(*)</span>:</label>
                            <input type="text" class="form-control" placeholder="Nhập email" name="email" value="{{auth()->user()->email}}">
                            @error('email')
                            <span class="error validate-error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại<span class="text-red">(*)</span>:</label>
                            <input type="text" class="form-control" placeholder="Nhập số điện thoại" name="phone" value="{{auth()->user()->phone}}">
                            @error('phone')
                            <span class="error validate-error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ<span class="text-red">(*)</span>:</label>
                            <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="address" value="{{auth()->user()->address}}">
                            @error('address')
                            <span class="error validate-error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->

        </div>

        <div class="col-md-6">
            <!-- Static mode -->
            <form id="change-password" action="{{route('change-password')}}" method="POST">
                @method('PUT')
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="text-semibold">Mật khẩu hiện tại<span class="text-red">(*)</span>:</label>
                            <input name="password_old" type="password" class="form-control">
                            @error('password_old')
                            <span class="error validate-error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-semibold">Mật khẩu mới<span class="text-red">(*)</span>:</label>
                            <input name="password" type="password" class="form-control">
                            @error('password')
                            <span class="error validate-error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-semibold">Xác nhận mật khẩu<span class="text-red">(*)</span>:</label>
                            <input name="password_confirm" type="password" class="form-control">
                            @error('password_confirm')
                            <span class="error validate-error">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /static mode -->

        </div>
    </div>
@endsection

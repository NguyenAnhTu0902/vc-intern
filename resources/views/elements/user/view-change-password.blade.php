@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Static mode -->
            <form action="{{route('change-password')}}" method="POST">
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

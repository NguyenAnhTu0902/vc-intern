@extends('layouts.admin')

@section('content')
    <!-- Tokenfield basic -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    @foreach($permissions as $permission)
                        <div class="form-group">
                            <form action="{{route('permission.setPermission',$permission->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <label style="font-size: 16px;">{{ $permission->default_name }}</label>
                                <select multiple="multiple" class="select" name="role_id[]" onchange="this.form.submit();">
                                    <option value="" disabled="disabled">
                                        --- Chọn một chức vụ ---
                                    </option>
                                    @foreach($roles as $v)
                                        <option {{request('role_id[]') == $v->id ? 'selected' : ''}} value="{{ $v->id }}"
                                                @if ($permission->roles->contains(
                                                    'id', $v->id)
                                                ) selected @endif
                                        >
                                            {{ $v->default_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="group_id" value="{{$group_id}}">
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- /tokenfield basic -->
@endsection

@push('scripts')
@endpush

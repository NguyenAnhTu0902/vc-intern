@extends('layouts.admin')

@section('content')
<!-- Dashboard content -->
<div class="row">
    <div class="col-lg-4">

        <!-- Members online -->
        <div class="panel bg-teal-400">
            <div class="panel-body">
                <h3 class="no-margin">{{$totalClient}}</h3>
                Khách hàng
                <div class="text-muted text-size-small"><i class="icon-users"></i> </div>
            </div>

            <div class="container-fluid">
                <div id="members-online"></div>
            </div>
        </div>
        <!-- /members online -->

    </div>

    <div class="col-lg-4">

        <!-- Current server load -->
        <div class="panel bg-pink-400">
            <div class="panel-body">
                <h3 class="no-margin">{{$totalOrder}}</h3>
                Đơn hàng đã hoàn tất
                <div class="text-muted text-size-small"><i class="glyphicon glyphicon-shopping-cart"></i> </div>
            </div>

            <div id="server-load"></div>
        </div>
        <!-- /current server load -->

    </div>

    <div class="col-lg-4">

        <!-- Today's revenue -->
        <div class="panel bg-blue-400">
            <div class="panel-body">
                <h3 class="no-margin">{{$totalRevenue}} đ</h3>
                Doanh thu
                <div class="text-muted text-size-small"><i class="glyphicon glyphicon-usd"></i> </div>
            </div>
        </div>
        <!-- /today's revenue -->

    </div>
</div>
<div class="row">
    <div class="table-responsive">
        <table class="table text-nowrap">
            <tbody>
            <tr class="active border-double">
                <td colspan="5">Danh sách đơn hàng mới nhất </td>
                <td class="text-right">
                    <span class="progress-meter" id="today-progress" data-progress="30"></span>
                </td>
            </tr>
            @foreach($listOrder as $order)
                <tr>
                    <td>
                        <div class="media-left media-middle">
                            <a href="{{route('order.detail', ['id'=>$order->id])}}"><img src="{{asset('images/dashboard/order.jpg')}}" class="img-circle img-xs" alt=""></a>
                        </div>
                        <div class="media-left">
                            <div class=""><a href="{{route('order.detail', ['id'=>$order->id])}}" class="text-default text-semibold">{{$order->code}}</a></div>
                            <div class="text-muted text-size-small">
                                <span class="status-mark border-blue position-left"></span>
                                {{$order->created_at}}
                            </div>
                        </div>
                    </td>
                    <td><h6 class="text-semibold">{{$order->client->name}}</h6></td>
                    <td><h6 class="text-semibold">{{$order->address}} đ</h6></td>
                    <td><h6 class="text-semibold">{{$order->subtotal}} đ</h6></td>
                    <td><span class="label">{!! $order->status !!}</span></td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
                                    <li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
                                    <li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-gear"></i> Settings</a></li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach


            <tr class="active border-double">
                <td colspan="5">Danh sách khách hàng mới nhất</td>
                <td class="text-right">
                    <span class="progress-meter" id="yesterday-progress" data-progress="65"></span>
                </td>
            </tr>
            @foreach($listClient as $client)
                <tr>
                    <td>
                        <div class="media-left media-middle">
                            <a href="{{route('client.detail',['id' => $client->id])}}"><img src="{{asset('images/dashboard/client.png')}}" class="img-circle img-xs" alt=""></a>
                        </div>
                        <div class="media-left">
                            <div class=""><a href="{{route('client.detail',['id' => $client->id])}}" class="text-default text-semibold">{{$client->name}}</a></div>
                            <div class="text-muted text-size-small">
                                <span class="status-mark border-success position-left"></span>
                                {{$client->created_at}}
                            </div>
                        </div>
                    </td>
                    <td><h6 class="text-semibold">{{$client->email}}</h6></td>
                    <td><h6 class="text-semibold">{{$client->phone}}</h6></td>
                    <td><h6 class="text-semibold">{{$client->address}}</h6></td>
                    <td><span class="label bg-success-400">Pending</span></td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropup">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- /dashboard content -->
@endsection

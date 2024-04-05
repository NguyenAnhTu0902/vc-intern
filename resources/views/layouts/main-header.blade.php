<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('images/logo_light.png')}}" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li>
                <a class="sidebar-control sidebar-main-toggle hidden-xs">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('images/placeholder.jpg')}}" alt="">
                    <span>{{ auth()->user()->name }}</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
                    <li>
                        <a href="{{route('logout')}}">
                            <i class="icon-switch2"></i> Logout
                            <form action="{{ route('logout') }}" method="post" id="form-logout" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>

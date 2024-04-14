@php
    use App\Helpers\RoleHelper;
@endphp
<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">
        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Danh mục quản lý</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li class="{{ request()->routeIs('order.index') ? 'active': '' }}"><a href="{{route("order.index")}}"><i class="glyphicon glyphicon-shopping-cart"></i> <span>Quản lý đơn hàng</span></a></li>
                    <li class="{{ request()->routeIs('client.index') ? 'active': '' }}" ><a href="{{route("client.index")}}"><i class="icon-user"></i> <span>Quản lý khách hàng</span></a></li>
                    <li  class="{{ request()->routeIs('user.index') ? 'active': '' }}"><a href="{{route("user.index")}}"><i class="icon-users"></i> <span>Quản lý nhân sự</span></a></li>
                    <li>
                        <a href="#"><i class="glyphicon glyphicon-lock"></i> <span>Quản lý công ty</span></a>
                        <ul>
                            <li class="{{ request()->routeIs('product.index') ? 'active': '' }}"><a href="{{route("product.index")}}">Quản lý sản phẩm</a></li>
                            <li class="{{ request()->routeIs('category.index') ? 'active': '' }}"><a href="{{route("category.index")}}">Quản lý danh mục</a></li>
                        </ul>
                    </li>
                    @if(RoleHelper::getByRole(['Supper-admin']))
                    <li class="{{ request()->routeIs('permission.index') ? 'active': '' }}"><a href="{{route('permission.index')}}"><i class="glyphicon glyphicon-th"></i> <span>Quản lý phân quyền</span></a></li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->

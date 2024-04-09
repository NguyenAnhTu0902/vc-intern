<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('Trang chủ'), route('home'));
});
Breadcrumbs::for('client.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Khách hàng'), route('client.index'));
});
Breadcrumbs::for('client.detail', function ($trail) {
    $trail->parent('client.index');
    $trail->push(__('Thông tin đơn hàng'), route('client.detail'));
});
Breadcrumbs::for('category.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Danh mục'), route('category.index'));
});
Breadcrumbs::for('category.add', function ($trail) {
    $trail->parent('category.index');
    $trail->push(__('Thêm danh mục'), route('category.add'));
});
Breadcrumbs::for('category.detail', function ($trail) {
    $trail->parent('category.index');
    $trail->push(__('Cập nhật danh mục'), route('category.detail'));
});
Breadcrumbs::for('product.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Sản phẩm'), route('product.index'));
});
Breadcrumbs::for('product.add', function ($trail) {
    $trail->parent('product.index');
    $trail->push(__('Thêm sản phẩm'), route('product.add'));
});
Breadcrumbs::for('product.detail', function ($trail) {
    $trail->parent('product.index');
    $trail->push(__('Cập nhật sản phẩm'), route('product.detail'));
});

Breadcrumbs::for('order.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Đơn hàng'), route('order.index'));
});
Breadcrumbs::for('order.detail', function ($trail) {
    $trail->parent('order.index');
    $trail->push(__('Chi tiết đơn hàng'), route('order.detail'));
});

Breadcrumbs::for('user.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Nhân viên'), route('user.index'));
});
Breadcrumbs::for('user.detail', function ($trail) {
    $trail->parent('user.index');
    $trail->push(__('Chi tiết nhân viên'), route('user.detail'));
});
Breadcrumbs::for('user.add', function ($trail) {
    $trail->parent('user.index');
    $trail->push(__('Thêm nhân viên'), route('user.add'));
});

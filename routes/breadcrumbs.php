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


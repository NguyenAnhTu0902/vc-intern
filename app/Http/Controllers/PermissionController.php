<?php

namespace App\Http\Controllers;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionService;

    protected $roleService;

    public function __construct(PermissionService $permissionService, RoleService $roleService)
    {
        $this->permissionService = $permissionService;
        $this->roleService = $roleService;
    }
    public function index(Request $request)
    {
        $param = $request->all();
        $result = $this->permissionService->list($param);
        return view('elements.permission.index', compact('result'));
    }

    public function detail($id)
    {
        $roles = $this->roleService->index();
        $group_id = $id;
        $permissions = $this->permissionService->getListPermissionByGroup($id);
        return view('elements.permission.get_permission', compact('roles', 'permissions', 'group_id'));
    }

    public function setPermission(Request $request, $id)
    {
        $group_id = $request->group_id;
        $permissions = $this->permissionService->setPermission($request, $id);

        return isset($permissions)
            ? redirect()->route('permission.detail', ['id'=> $group_id])->with('alert', 'Cập nhật thành công!')
            : redirect()->refresh()->with('alert', 'Xảy ra lỗi!');
    }
}

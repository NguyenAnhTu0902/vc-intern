<?php

namespace App\Http\Controllers;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    public function index(Request $request)
    {
        $param = $request->all();
        $result = $this->permissionService->list($param);
        return view('elements.permission.index', compact('result'));
    }
}

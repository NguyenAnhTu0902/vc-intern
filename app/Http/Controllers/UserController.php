<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    protected $userRepository;

    public function __construct(UserService $userService, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $data = $request->all();

        $result = $this->userService->listUser($data);
        return view('elements.user.index', compact('result'));
    }

    public function create()
    {
        return view('elements.user.add');
    }

    public function store(UserRequest $request)
    {
        $param = $request->only(
                'name',
                'email',
                'password',
                'phone',
                'address',
        );
        return $this->userService->createUser($param) ?
               redirect()->route('user.index')->with('alert', 'Thêm mới thành công!') :
               redirect()->refresh()->with('alert', 'Xảy ra lỗi!');

    }

    public function detail($id)
    {
        $user = $this->userRepository->findOrFail($id);
        return view('elements.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        return $this->userService->updateUser($request, $id)?
                redirect()->route('user.index')->with('alert', 'Cập nhật thành công!'):
                redirect()->refresh()->with('alert', 'Xảy ra lỗi!');
    }

    public function delete($id)
    {
        return $this->userService->deleteUser($id) ?
            redirect()->route('user.index')->with('alert', 'Xóa thành công!') :
            redirect()->refresh()->with('alert', 'Xảy ra lỗi!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\RoleHelper;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    protected $userRepository;

    protected $authService;

    public function __construct(UserService $userService, UserRepository $userRepository, AuthService $authService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->authService = $authService;
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

    public function view()
    {
        return view('elements.user.view');
    }

    public function profile(UpdateUserRequest $request)
    {
        return $this->userService->profile($request)
            ? redirect()->refresh()->with('alert', 'Thay đổi thông tin cá nhân thành công!')
            : redirect()->refresh()->with('alert', 'Xảy ra lỗi!');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $param = array_merge(
            $request->only(
                'password_old',
                'password',
                'password_confirm',
            ),
            ['email' => RoleHelper::getEmail()]
        );
        return $this->authService->resetPassword($param)
            ? redirect()->route('profile')->with('alert', 'Thay đổi mật khẩu thành công!')
            : redirect()->route('profile')->with('alert', 'Xảy ra lỗi!');
    }
}

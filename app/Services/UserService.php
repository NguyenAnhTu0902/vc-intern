<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }

    public function listUser($data, $select = '*')
    {
        $users = $this->userRepository->list($data, $select);
        return [
            'users' => $users,
            'itemStart' => $users->firstItem(),
        ];
    }

    public function createUser($param)
    {
        DB::beginTransaction();
        try {
            $param['password'] = Hash::make($param['password']);
            $user = $this->userRepository->create($param);
            // Assign role for user
            $user->assignRole('admin');
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return false;
        }
    }

    public function updateUser($request, $id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->findOrFail($id);
            if($user) {
                $user->update($request->only(
                    'name',
                    'email',
                    'phone',
                    'address'
                ));
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return false;
        }
    }

    public function deleteUser($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->findOrFail($id);
            if($user){
                $this->userRepository->deleteById($id);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return false;
        }
    }

    public function profile($request)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->findOrFail(auth()->user()->id);
            if($user) {
                $user->update($request->only(
                    'name',
                    'email',
                    'phone',
                    'address'
                ));
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return false;
        }
    }
}

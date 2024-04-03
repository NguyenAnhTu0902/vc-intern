<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Throwable;

class UserService
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(array $credentials): array
    {
        try {
            $user = $this->userRepository->exist('email', $credentials['email']);

            if ($user && $token = auth()->attempt($credentials)) {
               return [
                   'user' => $user,
                   'code' => Response::HTTP_OK,
                   'data' => [
                       'token' => 'Bearer ' . $token,
                       'expires_in' => time() + env('EXPIRED_TOKEN', 604800)
                   ]
               ];
            } else {
                return ['code' => Response::HTTP_UNAUTHORIZED, 'data' => null];
            }
        } catch (Throwable) {
            return ['code' => false];
        }
    }

    //Check email exist
    public function createUser($param)
    {
        try {
            $user = $this->userRepository->exist('email', $param['email']);
            if($user) {
                return [
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' => __('messages.EM-016')
                ];
            }
            $password = Str::random(10);
            $param['password'] = Hash::make($password);
            $user = $this->userRepository->create($param);
            DB::commit();
            return [
                'status' => Response::HTTP_OK,
                'message' => __('messages.EM-001'),
                'data' => $user
            ];
        } catch (Throwable $e) {
            DB::rollBack();
            report($e);
            return [
                'status' => Response::HTTP_BAD_REQUEST,
                'message' => __('messages.EM-000'),
            ];
        }
    }

    public function updateUser($param, $id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->exist('email', $param['email']);
            if($user) {
                return [
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' => __('messages.EM-016')
                ];
            }
            $this->userRepository->findOrFail($id);
            $response = $this->userRepository->update($id, $param);
            DB::commit();
            return [
                'status' => Response::HTTP_OK,
                'message' => __('messages.SM-002'),
                'data' => $response
            ];
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return [
                'status' => Response::HTTP_BAD_REQUEST,
                'message' => __('messages.EM-000'),
            ];
        }
    }
}


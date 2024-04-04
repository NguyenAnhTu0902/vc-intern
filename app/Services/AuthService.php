<?php

namespace App\Services;

use App\Constants\Constant;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;

class AuthService
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Login.
     *
     * @param array $credentials
     * @param int $device
     * @return array
     */
    public function login(array $credentials): array
    {
        try {
            // Is user exist
            $user = $this->userRepository->exist('email', $credentials['email']);

            return ($user && auth()->attempt($credentials))
                ? ['code' => true, 'route' => route('home')]
                : ['code' => false, 'route' => route('login')];
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return ['code' => false, 'route' => route('login')];
        }
    }

    /**
     * Inherited document
     *
     * @return void
     */
    public function logout(): void
    {
        $guard = auth()->getDefaultDriver();

        auth($guard)->logout();
    }

}

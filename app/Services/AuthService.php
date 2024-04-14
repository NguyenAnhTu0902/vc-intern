<?php

namespace App\Services;

use App\Constants\Constant;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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

    public function resetPassword(array $params)
    {
        try {
            $model = $this->userRepository;
            // User
            $user = $model->where('email', $params['email'])->first();

            $params['token'] = $params['token'] ?? app(PasswordBroker::class)->createToken($user);

            Password::setDefaultDriver($model->getTable());

            $status = Password::reset(
                $params,
                function ($model) use ($params) {
                    $model->forceFill([
                        'password' => Hash::make($params['password']),
                        'remember_token' => Str::random(60),
                    ])->save();

                    event(new PasswordReset($model));
                }
            );
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return false;
        }
        if($status == Password::PASSWORD_RESET)
        {
            return true;
        } else return false;
    }

}

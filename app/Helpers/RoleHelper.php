<?php

namespace App\Helpers;

class RoleHelper
{
    /**
     * Get by role
     *
     * @param array $role
     * @return bool
     */
    public static function getByRole(array $role): bool
    {
        if (auth()->user()->hasRole($role)) {
            return true;
        }
        return false;
    }

    /**
     * Set array of the query input.
     *
     * @param string $guard
     * @return ?string
     */
    public static function getEmail(string $guard = 'web'): ?string
    {
        if (auth($guard)->check()) {
            return auth($guard)->user()->email;
        }
        return null;
    }
}

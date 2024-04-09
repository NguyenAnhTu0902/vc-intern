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
}

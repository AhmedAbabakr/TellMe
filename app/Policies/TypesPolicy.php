<?php

namespace App\Policies;

use App\Admins;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypesPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(Admins $user,$role)
    {
        
        return $role === 1;
    }

    public function create(Admins $user,$role)
    {
        return $role === 1;
    }

    public function update(Admins $user,$role)
    {
        return $role === 1;
    }

    public function delete(Admins $user,$role)
    {
        return $role === 1;
    }
}

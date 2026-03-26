<?php

namespace App\Policies;

use App\Models\School;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SchoolPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to view schools.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, School $school): Response
    {
        if ($user->hasRole('sdo_admin')) {
            return Response::allow();
        }

        if ($user->school_id === $school->id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this school.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to create schools.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, School $school): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to update schools.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, School $school): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to delete schools.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, School $school): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to restore schools.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, School $school): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to permanently delete schools.');
    }
}

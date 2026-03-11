<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vaccination;
use Illuminate\Auth\Access\Response;

class VaccinationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to view vaccinations.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vaccination $vaccination): Response
    {
        if ($user->hasRole('sdo_admin')) {
            return Response::allow();
        }

        // Check if the vaccination belongs to the user's school
        if ($vaccination->student->school_id === $user->school_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this vaccination.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vaccination $vaccination): Response
    {
        if ($user->hasRole('sdo_admin')) {
            return Response::allow();
        }

        // Check if the vaccination belongs to the user's school
        if ($vaccination->student->school_id === $user->school_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to update this vaccination.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vaccination $vaccination): Response
    {
        if ($user->hasRole('sdo_admin')) {
            return Response::allow();
        }

        // Check if the vaccination belongs to the user's school
        if ($vaccination->student->school_id === $user->school_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to delete this vaccination.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vaccination $vaccination): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to restore vaccinations.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vaccination $vaccination): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to permanently delete vaccinations.');
    }
}

<?php

namespace App\Policies;

use App\Models\Absence;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AbsencePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to view absences.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Absence $absence): Response
    {
        if ($user->hasRole('sdo_admin')) {
            return Response::allow();
        }

        // Check if the absence belongs to the user's school
        if ($absence->student->school_id === $user->school_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this absence.');
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
    public function update(User $user, Absence $absence): Response
    {
        if ($user->hasRole('sdo_admin')) {
            return Response::allow();
        }

        // Check if the absence belongs to the user's school
        if ($absence->student->school_id === $user->school_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to update this absence.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Absence $absence): Response
    {
        if ($user->hasRole('sdo_admin')) {
            return Response::allow();
        }

        // Check if the absence belongs to the user's school
        if ($absence->student->school_id === $user->school_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to delete this absence.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Absence $absence): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to restore absences.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Absence $absence): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to permanently delete absences.');
    }
}

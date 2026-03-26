<?php

namespace App\Policies;

use App\Models\HealthProgram;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HealthProgramPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to view health programs.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, HealthProgram $healthProgram): Response
    {
        if ($user->hasRole('sdo_admin')) {
            return Response::allow();
        }

        // Check if the health program belongs to the user's school
        if ($healthProgram->school_id === $user->school_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this health program.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if ($user->hasRole('sdo_admin')) {
            return Response::allow();
        }

        // Health Coordinators can create programs for their school
        if ($user->hasRole('health_coordinator')) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to create health programs.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, HealthProgram $healthProgram): Response
    {
        if ($user->hasRole('sdo_admin')) {
            return Response::allow();
        }

        // Check if the health program belongs to the user's school
        if ($healthProgram->school_id === $user->school_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to update this health program.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, HealthProgram $healthProgram): Response
    {
        if ($user->hasRole('sdo_admin')) {
            return Response::allow();
        }

        // Check if the health program belongs to the user's school
        if ($healthProgram->school_id === $user->school_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to delete this health program.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, HealthProgram $healthProgram): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to restore health programs.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, HealthProgram $healthProgram): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to permanently delete health programs.');
    }
}

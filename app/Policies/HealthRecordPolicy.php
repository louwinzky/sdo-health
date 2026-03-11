<?php

namespace App\Policies;

use App\Models\HealthRecord;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HealthRecordPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to view health records.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, HealthRecord $healthRecord): Response
    {
        if ($user->hasRole('sdo_admin')) {
            return Response::allow();
        }

        // Check if the health record belongs to the user's school
        if ($healthRecord->student->school_id === $user->school_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this health record.');
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
    public function update(User $user, HealthRecord $healthRecord): Response
    {
        if ($user->hasRole('sdo_admin')) {
            return Response::allow();
        }

        // Check if the health record belongs to the user's school
        if ($healthRecord->student->school_id === $user->school_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to update this health record.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, HealthRecord $healthRecord): Response
    {
        if ($user->hasRole('sdo_admin')) {
            return Response::allow();
        }

        // Check if the health record belongs to the user's school
        if ($healthRecord->student->school_id === $user->school_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to delete this health record.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, HealthRecord $healthRecord): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to restore health records.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, HealthRecord $healthRecord): Response
    {
        return $user->hasRole('sdo_admin')
            ? Response::allow()
            : Response::deny('You do not have permission to permanently delete health records.');
    }
}

<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use App\Notifications\NewUserWaitingApproval;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Spatie\Permission\Models\Role;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            ...$this->profileRules(),
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'school_id' => $input['school_id'],
            'role' => 'health_coordinator', // Set default role column (matches database enum)
            'is_approved' => false, // Require admin approval
        ]);

        // Assign default Spatie role
        $role = Role::where('name', 'health_coordinator')->first();
        if (! $role) {
            $role = Role::create(['name' => 'health_coordinator']);
        }
        $user->assignRole($role);

        // Notify SDO Admins that a new user is waiting for approval
        $admins = User::role('sdo_admin')->get();
        Notification::send($admins, new NewUserWaitingApproval($user));

        return $user;
    }
}

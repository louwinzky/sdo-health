<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, HasRoles, HasPermissions, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'school_id',
        'is_approved',
    ];

    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_approved' => 'boolean',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function healthRecords(): HasMany
    {
        return $this->hasMany(HealthRecord::class, 'recorded_by');
    }

    public function vaccinations(): HasMany
    {
        return $this->hasMany(Vaccination::class, 'recorded_by');
    }

    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class, 'recorded_by');
    }

    public function healthPrograms(): HasMany
    {
        return $this->hasMany(HealthProgram::class, 'coordinator_id');
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_approved && $this->email_verified_at;
    }

    public function canViewPanel(Panel $panel): bool
    {
        return $this->hasRole(['sdo_admin', 'health_coordinator', 'principal']);
    }
}

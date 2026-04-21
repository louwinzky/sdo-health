<?php

namespace App\Filament\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $resource = StudentResource::class;

    public function getHeaderWidgets(): array
    {
        // Return different widgets based on user role
        if (auth()->user()->hasRole('health_coordinator')) {
            return [
                // Coordinator-specific widgets
            ];
        }

        // Admin widgets
        return [
            // Admin-specific widgets
        ];
    }
}

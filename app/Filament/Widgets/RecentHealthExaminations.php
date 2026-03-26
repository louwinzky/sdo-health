<?php

namespace App\Filament\Widgets;

use App\Helpers\HealthLegend;
use App\Models\HealthExamination;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class RecentHealthExaminations extends TableWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $user = Auth::user();
        $isSdoAdmin = $user->hasRole('sdo_admin');
        $schoolId = $user->school_id;

        return $table
            ->query(
                HealthExamination::query()
                    ->latest('date_of_examination')
                    ->when(! $isSdoAdmin && $schoolId, function (Builder $query) use ($schoolId) {
                        $query->whereHas('student', fn ($q) => $q->where('school_id', $schoolId));
                    })
                    ->limit(10)
            )
            ->columns([
                TextColumn::make('student.full_name')
                    ->label('Student')
                    ->searchable(),
                TextColumn::make('height_cm')
                    ->label('Height')
                    ->numeric(2),
                TextColumn::make('weight_kg')
                    ->label('Weight')
                    ->numeric(2),
                TextColumn::make('ns_bmi_for_age')
                    ->label('BMI-for-Age')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => HealthLegend::label('ns_bmi', $state))
                    ->color(fn (string $state): string => match ($state) {
                        'c' => 'danger',
                        'a' => 'success',
                        'd' => 'warning',
                        'e' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('date_of_examination')
                    ->date()
                    ->sortable(),
                TextColumn::make('examinedBy.name')
                    ->label('Examined By'),
            ]);
    }
}

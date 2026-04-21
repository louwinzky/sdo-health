<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HealthExaminations\Pages\CreateHealthExamination;
use App\Filament\Resources\HealthExaminations\Pages\EditHealthExamination;
use App\Filament\Resources\HealthExaminations\Pages\ListHealthExaminations;
use App\Filament\Resources\HealthExaminations\Pages\ViewHealthExamination;
use App\Filament\Resources\HealthExaminations\Schemas\HealthExaminationForm;
use App\Filament\Resources\HealthExaminations\Tables\HealthExaminationsTable;
use App\Models\HealthExamination;
use App\Policies\HealthExaminationPolicy;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class HealthExaminationResource extends Resource
{
    protected static ?string $model = HealthExamination::class;

<<<<<<< Updated upstream
    protected static ?string $policy = \App\Policies\HealthExaminationPolicy::class;
=======
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $policy = HealthExaminationPolicy::class;
>>>>>>> Stashed changes

    protected static UnitEnum|string|null $navigationGroup = 'Health Services';

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $label = 'Health Examination';

    protected static ?string $pluralLabel = 'Health Examinations';

    public static function form(Schema $schema): Schema
    {
        return HealthExaminationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HealthExaminationsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()->hasRole('health_coordinator') || auth()->user()->hasRole('principal')) {
            $query->whereHas('student', function ($q) {
                $q->where('school_id', auth()->user()->school_id);
            });
        }

        return $query;
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHealthExaminations::route('/'),
            'create' => CreateHealthExamination::route('/create'),
            'view' => ViewHealthExamination::route('/{record}'),
            'edit' => EditHealthExamination::route('/{record}/edit'),
        ];
    }
}

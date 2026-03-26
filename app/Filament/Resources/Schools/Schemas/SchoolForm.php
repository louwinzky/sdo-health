<?php

namespace App\Filament\Resources\Schools\Schemas;

use App\Enums\SchoolCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SchoolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('school_id')
                    ->label('School ID')
                    ->required()
                    ->unique(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('address')
                    ->required(),
                Select::make('category')
                    ->options([
                        SchoolCategory::ELEMENTARY->value => SchoolCategory::ELEMENTARY->label(),
                        SchoolCategory::JUNIOR_HIGH->value => SchoolCategory::JUNIOR_HIGH->label(),
                        SchoolCategory::SENIOR_HIGH->value => SchoolCategory::SENIOR_HIGH->label(),
                        SchoolCategory::OTHER->value => SchoolCategory::OTHER->label(),
                    ])
                    ->required(),
                TextInput::make('contact_number'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('principal_name'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}

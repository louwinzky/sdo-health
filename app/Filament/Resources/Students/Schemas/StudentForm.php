<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('school_id')
                    ->relationship('school', 'name')
                    ->required()
                    ->hidden(fn () => auth()->user()->hasRole('health_coordinator'))
                    ->default(fn () => auth()->user()->hasRole('health_coordinator') ? auth()->user()->school_id : null),
                TextInput::make('lrn')
                    ->label('LRN')
                    ->required(),
                TextInput::make('first_name')
                    ->label('Name')
                    ->required(),
                TextInput::make('middle_name'),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('suffix'),
                DatePicker::make('birth_date')
                    ->required(),
                Select::make('sex')
                    ->options(['male' => 'Male', 'female' => 'Female'])
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}

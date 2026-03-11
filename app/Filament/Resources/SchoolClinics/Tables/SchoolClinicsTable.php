<?php

namespace App\Filament\Resources\SchoolClinics\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchoolClinicsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('school.name')
                    ->label('SCHOOL')
                    ->searchable(),
                TextColumn::make('clinic_name')
                    ->label('CLINIC NAME')
                    ->searchable(),
                TextColumn::make('location')
                    ->label('LOCATION')
                    ->searchable(),
                TextColumn::make('head_nurse_name')
                    ->label('HEAD NURSE NAME')
                    ->searchable(),
                TextColumn::make('nurse_contact')
                    ->label('NURSE CONTACT')
                    ->searchable(),
                TextColumn::make('bed_count')
                    ->label('BED COUNT')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('IS ACTIVE')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('CREATED AT')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('UPDATED AT')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

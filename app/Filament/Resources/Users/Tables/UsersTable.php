<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('NAME')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('EMAIL')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('ROLES')
                    ->badge()
                    ->listWithLineBreaks(),
                TextColumn::make('email_verified_at')
                    ->label('EMAIL VERIFIED AT')
                    ->dateTime()
                    ->sortable()
                    ->hidden(fn () => ! auth()->user()->hasRole('sdo_admin')),
                TextColumn::make('two_factor_confirmed_at')
                    ->label('2FA CONFIRMED AT')
                    ->dateTime()
                    ->sortable()
                    ->hidden(fn () => ! auth()->user()->hasRole('sdo_admin')),
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
                TextColumn::make('school.name')
                    ->label('SCHOOL')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('is_approved')
                    ->label('Status')
                    ->options([
                        '0' => 'Pending',
                        '1' => 'Approved',
                    ]),
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

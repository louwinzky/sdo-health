<?php

namespace App\Filament\Resources\Students\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use App\Filament\Resources\HealthRecords\Schemas\HealthRecordForm;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;

class HealthRecordsRelationManager extends RelationManager
{
    protected static string $relationship = 'healthRecords';

    public static function getTitle(\Illuminate\Database\Eloquent\Model $ownerRecord, string $pageClass): string
    {
        return 'Health Records';
    }

    public function form(Schema $schema): Schema
    {
        HealthRecordForm::configure($schema);

        // Hide student_id and set default as it's already linked
        $studentIdField = $schema->getComponent('student_id');
        if ($studentIdField) {
            $studentIdField->hidden()
                ->default(fn (RelationManager $livewire) => $livewire->getOwnerRecord()->id);
        }

        // Auto-fill recorded_by with current user and hide it
        $recordedByField = $schema->getComponent('recorded_by');
        if ($recordedByField) {
            $recordedByField->hidden()
                ->default(auth()->id());
        }

        return $schema;
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('record_date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('height_cm')
                    ->label('Height (cm)')
                    ->numeric(),
                Tables\Columns\TextColumn::make('weight_kg')
                    ->label('Weight (kg)')
                    ->numeric(),
                Tables\Columns\TextColumn::make('bmi')
                    ->label('BMI')
                    ->numeric(),
                Tables\Columns\TextColumn::make('bmi_category')
                    ->label('Category'),
                Tables\Columns\TextColumn::make('medical_conditions')
                    ->label('Medical Conditions')
                    ->limit(50),
                Tables\Columns\TextColumn::make('allergies')
                    ->label('Allergies')
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

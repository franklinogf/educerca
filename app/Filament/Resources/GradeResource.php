<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParentsResource\RelationManagers\StudentsRelationManager;
use Filament\Forms;
use Filament\Tables;
use App\Models\Grade;
use App\Models\Teacher;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\GradeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GradeResource\RelationManagers;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;
    protected static ?string $modelLabel = 'grado';

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Grado')->required()->unique(ignoreRecord: true),
                Select::make('teacher_id')->label('Asignar a un profesor')->required()
                    ->relationship(name: 'teacher')
                    ->getOptionLabelFromRecordUsing(fn(Teacher $record) => "{$record->name} {$record->last_name}")
                    ->searchable()
                    ->preload()->unique()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Grado'),
                TextColumn::make('teacher.full_name')->label('Profesor asignado')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            StudentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGrades::route('/'),
            'create' => Pages\CreateGrade::route('/create'),
            'edit' => Pages\EditGrade::route('/{record}/edit'),
        ];
    }
}

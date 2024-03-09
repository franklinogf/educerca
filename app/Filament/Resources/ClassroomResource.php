<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Teacher;
use Filament\Forms\Form;
use App\Models\Classroom;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\ClassroomResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClassroomResource\RelationManagers;

class ClassroomResource extends Resource
{
    protected static ?string $model = Classroom::class;
    protected static ?string $modelLabel = 'curso';

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('teacher_id')->label('Asignar a un profesor')->required()
                    ->relationship(name: 'teacher')
                    ->getOptionLabelFromRecordUsing(fn(Teacher $record) => "{$record->name} {$record->last_name}")
                    ->searchable()
                    ->preload(),
                Select::make('grade_id')->label('Grado')->required()
                    ->relationship(name: 'grade', titleAttribute: 'name')
                    ->searchable()
                    ->preload(),
                Select::make('subject_id')->label('Materia')->required()
                    ->relationship(name: 'subject', titleAttribute: 'name')
                    ->searchable()
                    ->preload()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('teacher.full_name')->label('Profesor')->sortable(['name', 'last_name'])->searchable(['name', 'last_name']),
                TextColumn::make('grade.name')->label('Grado')->sortable(),
                TextColumn::make('subject.name')->label('Materia')->sortable()
            ])
            ->filters([
                SelectFilter::make('subject')->label('Materia')->relationship('subject', 'name'),
                SelectFilter::make('grade')->label('Grado')->relationship('grade', 'name')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClassrooms::route('/'),
            'create' => Pages\CreateClassroom::route('/create'),
            'edit' => Pages\EditClassroom::route('/{record}/edit'),
        ];
    }
}

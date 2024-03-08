<?php

namespace App\Filament\Resources\TeacherResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ClassroomRelationManager extends RelationManager
{
    protected static string $relationship = 'classrooms';
    protected static ?string $title = 'Cursos';
    public function form(Form $form): Form
    {
        return $form
            ->schema([
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('classroom')
            ->columns([
                Tables\Columns\TextColumn::make('grade.name'),
                Tables\Columns\TextColumn::make('subject.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

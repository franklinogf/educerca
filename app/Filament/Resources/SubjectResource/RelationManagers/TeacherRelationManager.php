<?php

namespace App\Filament\Resources\SubjectResource\RelationManagers;

use App\Filament\Resources\TeacherResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherRelationManager extends RelationManager
{
    protected static string $relationship = 'teachers';
    protected static ?string $title = 'Profesores';

    public function form(Form $form): Form
    {
        return TeacherResource::form($form);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('full_name')->label('Nombre'),
            ]);

    }
}

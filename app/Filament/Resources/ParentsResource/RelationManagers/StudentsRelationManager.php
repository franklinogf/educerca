<?php

namespace App\Filament\Resources\ParentsResource\RelationManagers;

use App\Filament\Resources\StudentResource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'children';
    protected static ?string $title = 'Estudiantes';

    public function form(Form $form): Form
    {
        return StudentResource::form($form);
    }

    public function table(Table $table): Table
    {
        return StudentResource::table($table);
    }
}

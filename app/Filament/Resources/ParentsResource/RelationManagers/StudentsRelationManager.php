<?php

namespace App\Filament\Resources\ParentsResource\RelationManagers;

use App\Filament\Resources\StudentResource;
use Filament\Forms;
use Filament\Tables;
use App\Models\Parents;
use Filament\Forms\Form;
use App\Enums\GenderEnum;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';
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

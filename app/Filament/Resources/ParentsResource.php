<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParentsResource\RelationManagers\StudentsRelationManager;
use Filament\Forms;
use Filament\Tables;
use App\Models\Parents;
use Filament\Forms\Form;
use App\Enums\GenderEnum;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\ParentsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ParentsResource\RelationManagers;

class ParentsResource extends Resource
{
    protected static ?string $model = Parents::class;
    protected static ?string $modelLabel = 'padre';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nombre')->required(),
                TextInput::make('last_name')->label('Apellido')->required(),
                TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
                TextInput::make('password')->label('Contraseña')->password()->required()->visibleOn('create'),
                Select::make('gender')->label('Genero')->options([
                    GenderEnum::Male->value => GenderEnum::Male->label(),
                    GenderEnum::Female->value => GenderEnum::Female->label(),
                ])->required(),
                TextInput::make('phone')->label('Teléfono')->tel()->required()->unique(ignoreRecord: true),
                DatePicker::make('dob')->label('Fecha de nacimiento')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')->label('Nombre')->searchable(['name', 'last_name'])->sortable(['name', 'last_name']),
                TextColumn::make('email')->label('Correo')->searchable(),
                TextColumn::make('phone')->label('Teléfono'),
                TextColumn::make('gender')->label('Genero')->formatStateUsing(fn(string $state): string => match ($state) {
                    GenderEnum::Male->value => GenderEnum::Male->label(),
                    GenderEnum::Female->value => GenderEnum::Female->label(),
                })->sortable()->alignCenter(),
                TextColumn::make('students_count')->badge()->label('Estudiantes')->counts('students')->alignCenter()

            ])
            ->filters([
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
            'index' => Pages\ListParents::route('/'),
            'create' => Pages\CreateParents::route('/create'),
            'edit' => Pages\EditParents::route('/{record}/edit'),
        ];
    }
}

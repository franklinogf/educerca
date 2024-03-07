<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Teacher;
use Filament\Forms\Form;
use App\Enums\GenderEnum;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TeacherResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TeacherResource\RelationManagers;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

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
                TextColumn::make('grade.name')->label('Grado')->sortable(),
                TextColumn::make('email')->label('Correo')->searchable(),
                TextColumn::make('phone')->label('Teléfono'),
                TextColumn::make('gender')->label('Genero')->formatStateUsing(fn(string $state): string => match ($state) {
                    GenderEnum::Male->value => GenderEnum::Male->label(),
                    GenderEnum::Female->value => GenderEnum::Female->label(),
                })->sortable(),
                // fn(string $state): string => match ($state) {
                //     GenderEnum::Male->value => GenderEnum::Male->label(),
                //     GenderEnum::Female->value => GenderEnum::Female->label(),
                // }
            ])
            ->filters([
                Filter::make('grade')->label('Con grado')
                    ->query(fn(Builder $query): Builder => $query->whereHas('grade')),
                SelectFilter::make('gender')->label('Genero')
                    ->options([
                        GenderEnum::Male->value => GenderEnum::Male->label(),
                        GenderEnum::Female->value => GenderEnum::Female->label(),
                    ])

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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}

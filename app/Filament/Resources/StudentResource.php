<?php

namespace App\Filament\Resources;

use App\Models\Parents;
use Filament\Forms;
use Filament\Tables;
use App\Models\Student;
use Filament\Forms\Form;
use App\Enums\GenderEnum;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\StudentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static ?string $modelLabel = 'estudiante';

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
                Select::make('grade_id')->label('Grado')->relationship(name: 'grade', titleAttribute: 'name')->required(),
                Select::make('parents_id')->searchable()->label('Padre del estudiante')
                    ->relationship(name: 'parent')
                    ->getOptionLabelFromRecordUsing(fn(Parents $record) => "{$record->name} {$record->last_name}")
                    ->required(),
                Toggle::make('is_enrroled')->label('Matriculado')->hiddenOn('create')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')->label('Nombre')->searchable(),
                TextColumn::make('grade.name')->label('Grado')->alignCenter(),
                TextColumn::make('phone')->label('Teléfono'),
                TextColumn::make('gender')->label('Genero')->formatStateUsing(fn(string $state): string => match ($state) {
                    GenderEnum::Male->value => GenderEnum::Male->label(),
                    GenderEnum::Female->value => GenderEnum::Female->label(),
                })->sortable(),
                IconColumn::make('is_enrroled')->label('Matriculado')
                    ->boolean()->alignCenter()
            ])
            ->filters([
                SelectFilter::make('grade')->label('Grado')->relationship('grade', 'name'),
                SelectFilter::make('gender')->label('Genero')
                    ->options([
                        GenderEnum::Male->value => GenderEnum::Male->label(),
                        GenderEnum::Female->value => GenderEnum::Female->label(),
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make()->modalHeading('Editar estudiante')
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}

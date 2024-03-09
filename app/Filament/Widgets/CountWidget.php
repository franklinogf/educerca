<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\GradeResource;
use App\Filament\Resources\ParentsResource;
use App\Filament\Resources\StudentResource;
use App\Filament\Resources\TeacherResource;
use App\Models\Grade;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CountWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Profesores', Teacher::all()->count())->icon('heroicon-o-academic-cap')
                ->extraAttributes([
                    'class' => 'cursor-pointer'
                ])->url(TeacherResource::getUrl()),

            Stat::make('Padres', Parents::all()->count())->icon('heroicon-o-users')
                ->extraAttributes([
                    'class' => 'cursor-pointer'
                ])->url(ParentsResource::getUrl()),

            Stat::make('Estudiantes', Student::all()->count())->icon('heroicon-o-identification')
                ->extraAttributes([
                    'class' => 'cursor-pointer'
                ])->url(StudentResource::getUrl()),

            Stat::make('Grados', Grade::all()->count())->icon('heroicon-o-list-bullet')
                ->extraAttributes([
                    'class' => 'cursor-pointer'
                ])->url(GradeResource::getUrl()),
        ];
    }
}

<?php
namespace App\Enums;

enum GuardsEnum: string
{
    case Teacher = 'teacher';
    case Parent = 'parent';
    case Admin = 'admin';
    case Student = 'student';
    public function label(): string
    {
        return match ($this) {
            static::Teacher => 'Profesor',
            static::Parent  => 'Padres',
            static::Admin   => 'Administrador',
            static::Student => 'Estudiante',
        };
    }
}
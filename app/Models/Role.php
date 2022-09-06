<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ADMIN = 1;
    const PARTICIPANTE = 2;
    const EDITOR = 3;
    const CORRETOR = 4;

    const NAMES = [
        self::ADMIN => "Administrador",
        self::PARTICIPANTE => "Participante",
        self::EDITOR => "Editor",
        self::CORRETOR => "Corretor",
    ];

    const INITIAL_ROUTES = [
        self::ADMIN => "admin-dashboard",
        self::PARTICIPANTE => "participante-dashboard",
        self::EDITOR => "editor-dashboard",
        self::CORRETOR => "corretor-dashboard",
    ];
}

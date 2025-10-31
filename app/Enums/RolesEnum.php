<?php

namespace App\Enums;

enum RolesEnum: string
{
    case Admin      = 'admin';
    case Commenter  = 'commenter';
    case User       = 'user';
    
    public static function labels(): array
    {
        return [
            self::Admin->value      => 'Admin',
            self::Commenter->value  => 'Commenter',
            self::User->value       => 'User',
        ];
    }

    public function label(): string
    {
        return self::labels()[$this->value];
    }
}

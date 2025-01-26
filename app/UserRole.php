<?php

namespace App;

enum UserRole: string
{
    case SuperAdmin = 'superadmin';
    case Admin = 'admin';
    case Sekbid = 'sekbid';
    case Pengunjung = 'pengunjung';

    /**
     * Get all values of the enum.
     *
     * @return array
     */
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}

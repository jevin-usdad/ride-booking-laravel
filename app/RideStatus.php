<?php

namespace App;

enum RideStatus: string
{
    case PENDING = 'pending';
    case DRIVER_REQUESTED = 'driver_requested';
    case APPROVED = 'approved';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    public function badge(): string
    {
        return match ($this) {
            self::PENDING => 'bg-yellow-100 text-yellow-800',
            self::DRIVER_REQUESTED => 'bg-blue-100 text-blue-800',
            self::APPROVED => 'bg-indigo-100 text-indigo-800',
            self::IN_PROGRESS => 'bg-purple-100 text-purple-800',
            self::COMPLETED => 'bg-green-100 text-green-800',
        };
    }

    public function label(): string
    {
        return ucfirst(str_replace('_', ' ', $this->value));
    }
}



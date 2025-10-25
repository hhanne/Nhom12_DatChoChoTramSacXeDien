<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DatCho;

class DatChoPolicy
{
    public function cancel(User $user, DatCho $datCho): bool
    {
        // User model uses a custom primary key (user_id). Use getKey() to
        // reliably obtain the primary key value regardless of its name.
        return $user->getKey() == $datCho->user_id;
    }
}

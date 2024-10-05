<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    const TYPE_SAVING = 'savings';
    const TYPE_CHECKING = 'checking';

    const TYPE_CREDIT = 'credit';
}

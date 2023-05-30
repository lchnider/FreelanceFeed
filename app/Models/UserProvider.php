<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProvider extends Model
{
    use HasFactory;
    /**
     * Get the user associated with this user provider.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the provider associated with this user provider.
     */
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}

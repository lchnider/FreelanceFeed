<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Work extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable   = ['title', 'description'];
    protected $fillable = [
        'user_id',
        'largeImage',
        'thumbnail',
        'infos',
        'title',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

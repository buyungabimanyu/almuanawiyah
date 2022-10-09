<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FontAwesome extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function footer()
    {
        return $this->hasMany(Setting::class, 'icon', 'id');
    }

    public function alasan()
    {
        return $this->hasMany(Views::class, 'image', 'id');
    }
}

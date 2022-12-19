<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\{ContactMail,ContactSubMail};

  

class Contact extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function boot() {
        parent::boot();
        static::created(function ($item) {
            $adminEmail = Views::contactEmail();
            Mail::to($adminEmail)->send(new ContactMail($item));
            Mail::to($item->email)->send(new ContactSubMail($item));
        });
    }
}